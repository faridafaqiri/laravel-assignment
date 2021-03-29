@component('admin.layouts.content' , ['title' => 'پاک کاری ذخایر'])
    @slot('breadcrumb')
        <li class="breadcrumb-item"><a href="{{route('admin.')}}">پنل مدیریت</a></li>
        <li class="breadcrumb-item active">پاک کاری ذخایر</li>
    @endslot

    <div class="row">
        <div class="col-12">
            <div class="card">
                <div class="card-header">
                    <h3 class="card-title">پاک کاری ذخایر</h3>
                    <div class="card-tools d-flex">
                        <div class="btn-group-sm mr-1">
                            @can('create-storage-clean')
                                    <a href="{{route('admin.storage_cleans.create')}}" class="btn btn-info">ایجاد پاک کاری ذخیره </a>
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
                            <th>تعداد ذخایر پاک شده</th>
                            <th>نوعیت کلورین</th>
                            <th>مقدار کلورین</th>
                            <th>واحد اندازه گیری</th>
                            <th>تاریخ ثبت</th>
                            <th>تنظیمات</th>
                        </tr>
                        <?php $i=1; ?>
                      @foreach($storage_cleans as $storage_clean)
                          @if(in_array($storage_clean['provincial_zone_id'],($user->provincialZones->pluck('id')->toArray())))
                          <tr>
                              <td>{{$i++}}</td>
                              <td>{{$storage_clean->zone->name}}</td>
                              <td>{{$storage_clean->province->name}}</td>
                              <td>{{$storage_clean->provincialZone->name}}</td>
                              <td>{{$storage_clean->count}}</td>

                              <td>
                                  @if($storage_clean->chlorine_type==1)
                                      مایع
                                  @else
                                        جامد
                                  @endif

                              </td>
                              <td>{{$storage_clean->chlorine_amount}}</td>

                              <td>
                                  @if($storage_clean->unite==1)
                                      لیتر
                                      @else
                                      کیلوگرام
                                  @endif

                              </td>
                              <td>{{jdate($storage_clean->created_at)->format('%A %d %B %y')}}</td>


                              <td class="d-flex ">

                                  <div class="btn-group">
                                      <button type="button" class="btn btn-info btn-sm dropdown-toggle" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                          تنظیمات
                                      </button>
                                      <div class="dropdown-menu">

                                          @can('edit-storage-clean')
                                              <a href="{{route('admin.storage_cleans.edit',$storage_clean->id)}}" class="dropdown-item">ویرایش</a>
                                          @endcan
                                              <a href="{{route('admin.storage_cleans.show',$storage_clean->id)}}" class="dropdown-item">جزییات</a>
                                          @can('delete-storage-clean')
                                              <form action="{{route('admin.storage_cleans.destroy',$storage_clean->id)}}" method="POST">
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
                    {{$storage_cleans->render()}}
                </div>
            </div>
            <!-- /.card -->
        </div>
    </div>

@endcomponent
