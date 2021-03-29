@component('admin.layouts.content' , ['title' => 'ذخایر آب'])
    @slot('breadcrumb')
        <li class="breadcrumb-item"><a href="{{route('admin.')}}">پنل مدیریت</a></li>
        <li class="breadcrumb-item active">ذخایر آب</li>
    @endslot

    <div class="row">
        <div class="col-12">
            <div class="card">
                <div class="card-header">
                    <h3 class="card-title">ذخایر آب</h3>
                    <div class="card-tools d-flex">
                        <div class="btn-group-sm mr-1">
                            @can('create-water-storage')
                                    <a href="{{route('admin.water_storages.create')}}" class="btn btn-info">ثبت ذخایر آب </a>
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
                            <th>مواد ساخت ذخیره</th>
                            <th>نوعیت</th>
                            <th>فعال</th>
                            <th>ظرفیت<span>(m<sup>3</sup>)</span></th>
                            <th>تنظیمات</th>
                        </tr>

                        <?php $i=1; ?>
                      @foreach($water_storages as $water_storage)
                          @if(in_array($water_storage['provincial_zone_id'],($user->provincialZones->pluck('id')->toArray())))
                          <tr>
                              <td>{{$i++}}</td>
                              <td>{{$water_storage->zone->name}}</td>
                              <td>{{$water_storage->province->name}}</td>
                              <td>{{$water_storage->provincialZone->name}}</td>
                              <td>
                                  @if($water_storage->storage_type==0)
                                      کانکریتی
                                  @else
                                      فلزی
                                  @endif
                              </td>
                              <td>
                                  @if($water_storage->height_type==0)
                                      ارتفاعی
                                  @else
                                      زمینی
                                  @endif
                              </td>
                              <td>
                                  @if($water_storage->activation==1)
                                      فعال
                                  @else
                                      غیر فعال
                                  @endif
                              </td>
                              <td>{{$water_storage->capacity}}</td>

                              <td class="d-flex ">

                                  <div class="btn-group">
                                      <button type="button" class="btn btn-info btn-sm dropdown-toggle" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                          تنظیمات
                                      </button>
                                      <div class="dropdown-menu">

                                          @can('edit-water-storage')
                                              <a href="{{route('admin.water_storages.edit',$water_storage->id)}}" class="dropdown-item">ویرایش</a>
                                          @endcan
                                              <a href="{{route('admin.water_storages.show',$water_storage->id)}}" class="dropdown-item">جزییات</a>
                                          @can('delete-water-storage')
                                              <form action="{{route('admin.water_storages.destroy',$water_storage->id)}}" method="POST">
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
                    {{$water_storages->render()}}
                </div>
            </div>
            <!-- /.card -->
        </div>
    </div>

@endcomponent
