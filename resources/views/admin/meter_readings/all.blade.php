@component('admin.layouts.content' , ['title' => ' میتر خوانی ها'])
    @slot('breadcrumb')
        <li class="breadcrumb-item"><a href="{{route('admin.')}}">پنل مدیریت</a></li>
        <li class="breadcrumb-item active"> میتر خوانی ها</li>
    @endslot

    <div class="row">
        <div class="col-12">
            <div class="card">
                <div class="card-header">
                    <h3 class="card-title"> میتر خوانی ها</h3>
                    <div class="card-tools d-flex">
                        <div class="btn-group-sm mr-1">
                            @can('create-meter-reading')
                                <a href="{{route('admin.meter_readings.create')}}" class="btn btn-info">ثبت  میتر خوانی </a>
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
                            <th>میتر های خوانده شده</th>
                            <th>میتر خوان</th>
                            <th>تاریخ ثبت</th>
                            <th>تنظیمات</th>
                        </tr>
                        <?php $i=1; ?>
                      @foreach($meter_readings as $meter_reading)
                          @if(in_array($meter_reading['provincial_zone_id'],($user->provincialZones->pluck('id')->toArray())))
                          <tr>
                              <td>{{$i++}}</td>
                              <td>{{$meter_reading->zone->name}}</td>
                              <td>{{$meter_reading->province->name}}</td>
                              <td>{{$meter_reading->provincialZone->name}}</td>
                              <td>{{$meter_reading->total_read}}</td>
                              <td>{{$meter_reading->meter_reader->name}}</td>
                              <td>{{jdate($meter_reading->created_at)->format('%A %d %B %y')}}</td>

                              <td class="d-flex ">

                                  <div class="btn-group">
                                      <button type="button" class="btn btn-info btn-sm dropdown-toggle" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                          تنظیمات
                                      </button>
                                      <div class="dropdown-menu">

                                          @can('edit-meter-reading')
                                              <a href="{{route('admin.meter_readings.edit',$meter_reading->id)}}" class="dropdown-item">ویرایش</a>
                                          @endcan
                                              <a href="{{route('admin.meter_readings.show',$meter_reading->id)}}" class="dropdown-item">جزییات</a>
                                          @can('delete-meter-reading')
                                              <form action="{{route('admin.meter_readings.destroy',$meter_reading->id)}}" method="POST">
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
                    {{$meter_readings->render()}}
                </div>
            </div>
            <!-- /.card -->
        </div>
    </div>

@endcomponent
