@component('admin.layouts.content' , ['title' => 'وال کنترولینگ'])
    @slot('breadcrumb')
        <li class="breadcrumb-item"><a href="{{route('admin.')}}">پنل مدیریت</a></li>
        <li class="breadcrumb-item active">وال کنترولینگ</li>
    @endslot

    <div class="row">
        <div class="col-12">
            <div class="card">
                <div class="card-header">
                    <h3 class="card-title">وال کنترولینگ</h3>
                    <div class="card-tools d-flex">
                        <div class="btn-group-sm mr-1">
                            @can('create-wall-controlling')
                                <a href="{{route('admin.wall_controllings.create')}}" class="btn btn-info">ثبت وال کنترولینگ</a>
                            @endcan
                        </div>
                    </div>
                </div>
                <!-- /.card-header -->
                <div class="card-body table-responsive-md p-0">
                    <table class="table table-hover">
                        <tbody>
                        <tr>
                            <th>#</th>
                            <th>زون</th>
                            <th>ولایت</th>
                            <th>زون ولایتی</th>
                            <th>تعداد</th>
                            <th>فعال</th>
                            <th>تاریخ ثبت</th>
                            <th>تنظیمات</th>
                        </tr>

                        <?php $i=1; ?>
                      @foreach($wall_controllings as $wall_controlling)
                          @if(in_array($wall_controlling['provincial_zone_id'],($user->provincialZones->pluck('id')->toArray())))
                          <tr>
                              <td>{{$i++}}</td>
                              <td>{{$wall_controlling->zone->name}}</td>
                              <td>{{$wall_controlling->province->name}}</td>
                              <td>{{$wall_controlling->provincialZone->name}}</td>
                              <td>{{$wall_controlling->number}}</td>
                              <td>
                                  @if($wall_controlling->active==1)
                                       بلی
                                  @else
                                      نخیر
                                  @endif
                              </td>

                              <td>{{jdate($wall_controlling->created_at)->format('%A %d %B %y')}}</td>

                              <td class="d-flex ">

                                  <div class="btn-group">
                                      <button type="button" class="btn btn-info btn-sm dropdown-toggle" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                          تنظیمات
                                      </button>
                                      <div class="dropdown-menu">

                                          @can('edit-wall-controlling')
                                              <a href="{{route('admin.wall_controllings.edit',$wall_controlling->id)}}" class="dropdown-item">ویرایش</a>
                                          @endcan
                                              <a href="{{route('admin.wall_controllings.show',$wall_controlling->id)}}" class="dropdown-item">جزییات</a>
                                          @can('delete-wall-controlling')
                                              <form action="{{route('admin.wall_controllings.destroy',$wall_controlling->id)}}" method="POST">
                                                  @csrf
                                                  @method('DELETE')
                                                  <button type="submit" class="dropdown-item">حذف</button>
                                              </form>
                                          @endcan

                                      </div>
                                  </div>

                              </td>
                          </tr>
                          @endif
                      @endforeach
                        </tbody>
                    </table>
                </div>
                <!-- /.card-body -->
                <div class="card-footer">
                    {{$wall_controllings->render()}}
                </div>
            </div>
            <!-- /.card -->
        </div>
    </div>

@endcomponent
