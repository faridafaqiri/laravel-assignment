@component('admin.layouts.content' , ['title' => 'وال چمبر'])
    @slot('breadcrumb')
        <li class="breadcrumb-item"><a href="{{route('admin.')}}">پنل مدیریت</a></li>
        <li class="breadcrumb-item active">وال چمبر</li>
    @endslot

    <div class="row">
        <div class="col-12">
            <div class="card">
                <div class="card-header">
                    <h3 class="card-title">وال چمبر</h3>
                    <div class="card-tools d-flex">
                        <div class="btn-group-sm mr-1">
                            @can('create-wall-chamber')
                                <a href="{{route('admin.wall_chambers.create')}}" class="btn btn-info">ثبت وال چمبر</a>
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
                      @foreach($wall_chambers as $wall_chamber)
                          @if(in_array($wall_chamber['provincial_zone_id'],($user->provincialZones->pluck('id')->toArray())))
                          <tr>
                              <td>{{$i++}}</td>
                              <td>{{$wall_chamber->zone->name}}</td>
                              <td>{{$wall_chamber->province->name}}</td>
                              <td>{{$wall_chamber->provincialZone->name}}</td>
                              <td>{{$wall_chamber->number}}</td>
                              <td>
                                  @if($wall_chamber->active==1)
                                      بلی
                                  @else
                                      نخیر
                                  @endif
                              </td>

                              <td>{{jdate($wall_chamber->created_at)->format('%A %d %B %y')}}</td>

                              <td class="d-flex ">

                                  <div class="btn-group">
                                      <button type="button" class="btn btn-info btn-sm dropdown-toggle" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                          تنظیمات
                                      </button>
                                      <div class="dropdown-menu">

                                          @can('edit-wall-chamber')
                                              <a href="{{route('admin.wall_chambers.edit',$wall_chamber->id)}}" class="dropdown-item">ویرایش</a>
                                          @endcan
                                              <a href="{{route('admin.wall_chambers.show',$wall_chamber->id)}}" class="dropdown-item">جزییات</a>
                                          @can('delete-wall-chamber')
                                              <form action="{{route('admin.wall_chambers.destroy',$wall_chamber->id)}}" method="POST">
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
                    {{$wall_chambers->render()}}
                </div>
            </div>
            <!-- /.card -->
        </div>
    </div>

@endcomponent
