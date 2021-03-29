@component('admin.layouts.content' , ['title' => 'منابع'])
    @slot('breadcrumb')
        <li class="breadcrumb-item"><a href="{{route('admin.')}}">پنل مدیریت</a></li>
        <li class="breadcrumb-item active">منابع</li>
    @endslot

    <div class="row">
        <div class="col-12">
            <div class="card">
                <div class="card-header">
                    <h3 class="card-title">منابع</h3>
                    <div class="card-tools d-flex">
                        <div class="btn-group-sm mr-1">
                            @can('create-source')
                                <a href="{{route('admin.sources.create')}}" class="btn btn-info">ایجاد منابع  </a>
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
                            <th>نوع منبع</th>
                            <th>تعداد منابع</th>
                            <th>تعداد منابع فعال</th>
                            <th>تعداد پمپ ها</th>
                            <th>تاریخ</th>
                            <th>تنظیمات</th>
                        </tr>

                        <?php $i=1; ?>
                      @foreach($sources as $source)
                          @if(in_array($source['provincial_zone_id'],($user->provincialZones->pluck('id')->toArray())))
                          <tr>
                              <td>{{$i++}}</td>
                              <td>{{$source->zone->name}}</td>
                              <td>{{$source->province->name}}</td>
                              <td>{{$source->provincialZone->name}}</td>
                              <td>{{$source->sourceType->name}}</td>
                              <td>{{$source->total_source}}</td>
                              <td>{{$source->total_active}}</td>
                              <td>{{$source->total_pumps}}</td>
                              <td>{{jdate($source->created_at)->format('%A %d %B %y')}}</td>

                              <td class="d-flex ">

                                  <div class="btn-group">
                                      <button type="button" class="btn btn-info btn-sm dropdown-toggle" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                          تنظیمات
                                      </button>
                                      <div class="dropdown-menu">

                                          @can('edit-source')
                                              <a href="{{route('admin.sources.edit',$source->id)}}" class="dropdown-item">ویرایش</a>
                                          @endcan
                                              <a href="{{route('admin.sources.show',$source->id)}}" class="dropdown-item">جزییات</a>
                                          @can('delete-source')
                                              <form action="{{route('admin.sources.destroy',$source->id)}}" method="POST">
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
                    {{$sources->render()}}
                </div>
            </div>
            <!-- /.card -->
        </div>
    </div>

@endcomponent
