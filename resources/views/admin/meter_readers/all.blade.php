‍‍‍@component('admin.layouts.content' , ['title' => 'میتر خوان ها'])
    @slot('breadcrumb')
        <li class="breadcrumb-item"><a href="{{route('admin.')}}">پنل مدیریت</a></li>
        <li class="breadcrumb-item active">میتر خوان ها</li>
    @endslot

    <div class="row">
        <div class="col-12">
            <div class="card">
                <div class="card-header">
                    <h3 class="card-title">میتر خوان ها</h3>
                    <div class="card-tools d-flex">
                        <div class="btn-group-sm mr-1">
                            @can('create-meter-reader')
                                    <a href="{{route('admin.meter_readers.create')}}" class="btn btn-info">ثبت میتر خوان</a>
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
                            <th>نام</th>
                            <th>درجه تحصیلی</th>
                            <th>ساحه کاری</th>
                            <th>تاریخ ثبت</th>
                            <th>تنظیمات</th>
                        </tr>

                        <?php $i=1; ?>
                      @foreach($meter_readers as $meter_reader)
                          @if(in_array($meter_reader['provincial_zone_id'],($user->provincialZones->pluck('id')->toArray())))
                          <tr>
                              <td>{{$i++}}</td>
                              <td>{{$meter_reader->zone->name}}</td>
                              <td>{{$meter_reader->province->name}}</td>
                              <td>{{$meter_reader->provincialZone->name}}</td>
                              <td>{{$meter_reader->name}}</td>
                              <td>{{$meter_reader->degree}}</td>
                              <td>
                                  @if($meter_reader->area==1)
                                      کوهی
                                  @else
                                      هموار
                                  @endif
                              </td>
                              <td>{{jdate($meter_reader->created_at)->format('%A %d %B %y')}}</td>

                              <td class="d-flex ">

                                  <div class="btn-group">
                                      <button type="button" class="btn btn-info btn-sm dropdown-toggle" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                          تنظیمات
                                      </button>
                                      <div class="dropdown-menu">

                                          @can('edit-meter-reader')
                                              <a href="{{route('admin.meter_readers.edit',$meter_reader->id)}}" class="dropdown-item">ویرایش</a>
                                          @endcan

                                              <a href="{{route('admin.meter_readers.show',$meter_reader->id)}}" class="dropdown-item">جزییات</a>
                                          @can('delete-meter-reader')
                                              <form action="{{route('admin.meter_readers.destroy',$meter_reader->id)}}" method="POST">
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
                    {{$meter_readers->render()}}
                </div>
            </div>
            <!-- /.card -->
        </div>
    </div>

@endcomponent
