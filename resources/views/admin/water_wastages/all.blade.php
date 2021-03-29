@component('admin.layouts.content' , ['title' => 'آب های ضایع شده'])
    @slot('breadcrumb')
        <li class="breadcrumb-item"><a href="{{route('admin.')}}">پنل مدیریت</a></li>
        <li class="breadcrumb-item active">آب های ضایع شده</li>
    @endslot

    <div class="row">
        <div class="col-12">
            <div class="card">
                <div class="card-header">
                    <h3 class="card-title">آب های ضایع شده</h3>
                    <div class="card-tools d-flex">
                        <div class="btn-group-sm mr-1">
                            @can('create-water-wastage')
                                <a href="{{route('admin.water_wastages.create')}}" class="btn btn-info">ثبت آب های ضایع شده</a>
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
                            <th>نوع ضایعات</th>
                            <th>مقدار آب ضایع شده<span>(m<sup>3</sup>)</span></th>
                            <th>هزینه آب ضایع شده</th>
                            <th>تاریخ ثبت</th>
                            <th>تنظیمات</th>
                        </tr>
                        <?php $i=1; ?>
                      @foreach($water_wastages as $water_wastage)
                          @if(in_array($water_wastage['provincial_zone_id'],($user->provincialZones->pluck('id')->toArray())))
                          <tr>
                              <td>{{$i++}}</td>
                              <td>{{$water_wastage->zone->name}}</td>
                              <td>{{$water_wastage->province->name}}</td>
                              <td>{{$water_wastage->provincialZone->name}}</td>
                              <td>
                                  @if($water_wastage->wasted_type==1)
                                      تخنیکی
                                  @else
                                      تجاری
                                  @endif
                              </td>
                              <td>{{$water_wastage->wasted_water}}</td>
                              <td>{{$water_wastage->loss}}</td>

                              <td>{{jdate($water_wastage->created_at)->format('%A %d %B %y')}}</td>

                              <td class="d-flex ">

                                  <div class="btn-group">
                                      <button type="button" class="btn btn-info btn-sm dropdown-toggle" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                          تنظیمات
                                      </button>
                                      <div class="dropdown-menu">

                                          @can('edit-water-wastage')
                                              <a href="{{route('admin.water_wastages.edit',$water_wastage->id)}}" class="dropdown-item">ویرایش</a>
                                          @endcan
                                              <a href="{{route('admin.water_wastages.show',$water_wastage->id)}}" class="dropdown-item">جزییات</a>
                                          @can('delete-water-wastage')
                                              <form action="{{route('admin.water_wastages.destroy',$water_wastage->id)}}" method="POST">
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
                    {{$water_wastages->render()}}
                </div>
            </div>
            <!-- /.card -->
        </div>
    </div>

@endcomponent
