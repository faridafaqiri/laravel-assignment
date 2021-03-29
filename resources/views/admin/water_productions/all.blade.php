@component('admin.layouts.content' , ['title' => 'تولید آب'])
    @slot('breadcrumb')
        <li class="breadcrumb-item"><a href="{{route('admin.')}}">پنل مدیریت</a></li>
        <li class="breadcrumb-item active">تولید آب</li>
    @endslot

    <div class="row">
        <div class="col-12">
            <div class="card">
                <div class="card-header">
                    <h3 class="card-title">تولید آب</h3>
                    <div class="card-tools d-flex">
                        <div class="btn-group-sm mr-1">
                            @can('create-water-production')
                                <a href="{{route('admin.water_productions.create')}}" class="btn btn-info">ثبت تولید آب  </a>
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
                            <th>مقدار آب </th>
                            <th>هزینه تولید</th>
                            <th>تاریخ</th>
                            <th>تنظیمات</th>
                        </tr>

                        <?php $i=1; ?>
                      @foreach($water_productions as $water_production)
                          @if(in_array($water_production['provincial_zone_id'],($user->provincialZones->pluck('id')->toArray())))
                          <tr>
                              <td>{{$i++}}</td>
                              <td>{{$water_production->zone->name}}</td>
                              <td>{{$water_production->province->name}}</td>
                              <td>{{$water_production->provincialZone->name}}</td>
                              <td>{{$water_production->produce_water}}<span><sub>m<sup>3</sup></sub></span></td>
                              <td>{{$water_production->expends}}<span><sub>AFN</sub></span></td>
                              <td>{{jdate($water_production->created_at)->format('%A %d %B %y')}}</td>

                              <td class="d-flex ">

                                  <div class="btn-group">
                                      <button type="button" class="btn btn-info btn-sm dropdown-toggle" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                          تنظیمات
                                      </button>
                                      <div class="dropdown-menu">

                                          @can('edit-water-production')
                                              <a href="{{route('admin.water_productions.edit',$water_production->id)}}" class="dropdown-item">ویرایش</a>
                                          @endcan

                                              <a href="{{route('admin.water_productions.show',$water_production->id)}}" class="dropdown-item">جزییات</a>
                                          @can('delete-water-production')
                                              <form action="{{route('admin.water_productions.destroy',$water_production->id)}}" method="POST">
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
                    {{$water_productions->render()}}
                </div>
            </div>
            <!-- /.card -->
        </div>
    </div>

@endcomponent
