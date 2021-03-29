@component('admin.layouts.content' , ['title' => 'لوحه های مشترکین'])
    @slot('breadcrumb')
        <li class="breadcrumb-item"><a href="{{route('admin.')}}">پنل مدیریت</a></li>
        <li class="breadcrumb-item active">لوحه های مشترکین</li>
    @endslot

    <div class="row">
        <div class="col-12">
            <div class="card">
                <div class="card-header">
                    <h3 class="card-title"> همه لوحه ها</h3>
                    <div class="card-tools d-flex">
                        <div class="btn-group-sm mr-1">
                            @can('create-signboard')
                                <a href="{{route('admin.signboards.create')}}" class="btn btn-info">ثبت لوحه </a>
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
                            <th>تعداد لوحه ها</th>
                            <th>تاریخ ثبت</th>
                            <th>تنظیمات</th>
                        </tr>

                        <?php $i=1; ?>
                      @foreach($signboards as $signboard)
                          @if(in_array($signboard['provincial_zone_id'],($user->provincialZones->pluck('id')->toArray())))
                          <tr>
                              <td>{{$i++}}</td>
                              <td>{{$signboard->zone->name}}</td>
                              <td>{{$signboard->province->name}}</td>
                              <td>{{$signboard->provincialZone->name}}</td>
                              <td>{{$signboard->total}}</td>
                              <td>{{jdate($signboard->created_at)->format('%A %d %B %y')}}</td>

                              <td class="d-flex ">

                                  <div class="btn-group">
                                      <button type="button" class="btn btn-info btn-sm dropdown-toggle" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                          تنظیمات
                                      </button>
                                      <div class="dropdown-menu">

                                          @can('edit-signboard')
                                              <a href="{{route('admin.signboards.edit',$signboard->id)}}" class="dropdown-item">ویرایش</a>
                                          @endcan
                                              <a href="{{route('admin.signboards.show',$signboard->id)}}" class="dropdown-item">جزییات</a>
                                          @can('delete-signboard')
                                              <form action="{{route('admin.signboards.destroy',$signboard->id)}}" method="POST">
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
                    {{$signboards->render()}}
                </div>
            </div>
            <!-- /.card -->
        </div>
    </div>

@endcomponent
