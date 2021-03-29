@component('admin.layouts.content' , ['title' => 'تست آب'])
    @slot('breadcrumb')
        <li class="breadcrumb-item"><a href="{{route('admin.')}}">پنل مدیریت</a></li>
        <li class="breadcrumb-item active">تست آب</li>
    @endslot

    <div class="row">
        <div class="col-12">
            <div class="card">
                <div class="card-header">
                    <h3 class="card-title">تست آب</h3>
                    <div class="card-tools d-flex">
                        <div class="btn-group-sm mr-1">
                            @can('create-water-test')
                                <a href="{{route('admin.water_tests.create')}}" class="btn btn-info">ثبت تست آب</a>
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
                            <th>تعداد نمونه</th>
                            <th>تعداد پارامتر ها</th>
                            <th>تاریخ ثبت</th>
                            <th>تنظیمات</th>
                        </tr>

                        <?php $i=1; ?>
                      @foreach($water_tests as $water_test)
                          @if(in_array($water_test['provincial_zone_id'],($user->provincialZones->pluck('id')->toArray())))
                          <tr>
                              <td>{{$i++}}</td>
                              <td>{{$water_test->zone->name}}</td>
                              <td>{{$water_test->province->name}}</td>
                              <td>{{$water_test->provincialZone->name}}</td>
                              <td>{{$water_test->count_of_instance}}</td>
                              <td>{{$water_test->parameters}}</td>

                              <td>{{jdate($water_test->created_at)->format('%A %d %B %y')}}</td>

                              <td class="d-flex ">

                                  <div class="btn-group">
                                      <button type="button" class="btn btn-info btn-sm dropdown-toggle" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                          تنظیمات
                                      </button>
                                      <div class="dropdown-menu">

                                          @can('edit-water-test')
                                              <a href="{{route('admin.water_tests.edit',$water_test->id)}}" class="dropdown-item">ویرایش</a>
                                          @endcan
                                              <a href="{{route('admin.water_tests.show',$water_test->id)}}" class="dropdown-item">جزییات</a>
                                          @can('delete-water-test')
                                              <form action="{{route('admin.water_tests.destroy',$water_test->id)}}" method="POST">
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
                    {{$water_tests->render()}}
                </div>
            </div>
            <!-- /.card -->
        </div>
    </div>

@endcomponent
