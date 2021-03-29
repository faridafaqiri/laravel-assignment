@component('admin.layouts.content' , ['title' => 'آب های توزیع شده'])
    @slot('breadcrumb')
        <li class="breadcrumb-item"><a href="{{route('admin.')}}">پنل مدیریت</a></li>
        <li class="breadcrumb-item active">توزیع آب</li>
    @endslot

    <div class="row">
        <div class="col-12">
            <div class="card">
                <div class="card-header">
                    <h3 class="card-title">توزیع آب</h3>
                    <div class="card-tools d-flex">
                        <div class="btn-group-sm mr-1">
                            @can('create-water-distribution')
                                <a href="{{route('admin.water_distributions.create')}}" class="btn btn-info">ثبت توزیع آب</a>
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
                            <th>توزیع آب<span>(m<sup>3</sup>)</span></th>
                            <th>تاریخ ثبت</th>
                            <th>تنظیمات</th>
                        </tr>
                        <?php $i=1 ?>
                      @foreach($water_distributions as $water_distribution)
                          @if(in_array($water_distribution['provincial_zone_id'],($user->provincialZones->pluck('id')->toArray())))
                          <tr>
                              <td>{{$i++}}</td>
                              <td>{{$water_distribution->zone->name}}</td>
                              <td>{{$water_distribution->province->name}}</td>
                              <td>{{$water_distribution->provincialZone->name}}</td>
                              <td>{{$water_distribution->water_distributed}}</td>
                              <td>{{jdate($water_distribution->created_at)->format('%A %d %B %y')}}</td>

                              <td class="d-flex ">

                                  <div class="btn-group">
                                      <button type="button" class="btn btn-info btn-sm dropdown-toggle" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                          تنظیمات
                                      </button>
                                      <div class="dropdown-menu">

                                          @can('edit-water-distribution')
                                              <a href="{{route('admin.water_distributions.edit',$water_distribution->id)}}" class="dropdown-item">ویرایش</a>
                                          @endcan
                                              <a href="{{route('admin.water_distributions.show',$water_distribution->id)}}" class="dropdown-item">جزییات</a>
                                          @can('delete-water-distribution')
                                              <form action="{{route('admin.water_distributions.destroy',$water_distribution->id)}}" method="POST">
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
                    {{$water_distributions->render()}}
                </div>
            </div>
            <!-- /.card -->
        </div>
    </div>

@endcomponent
