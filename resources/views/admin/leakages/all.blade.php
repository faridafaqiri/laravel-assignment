@component('admin.layouts.content' , ['title' => 'نل های لیک شده'])
    @slot('breadcrumb')
        <li class="breadcrumb-item"><a href="{{route('admin.')}}">پنل مدیریت</a></li>
        <li class="breadcrumb-item active">نل های لیک شده</li>
    @endslot

    <div class="row">
        <div class="col-12">
            <div class="card">
                <div class="card-header">
                    <h3 class="card-title">نل های لیک شده</h3>
                    <div class="card-tools d-flex">
                        <div class="btn-group-sm mr-1">
                            @can('create-leakage')
                                <a href="{{route('admin.leakages.create')}}" class="btn btn-info">ایجاد فرم نل های لیک شده</a>
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
                            <th>شبکه</th>
                            <th>مجموع نل های لیک شده</th>
                            <th>ترمیم شده</th>
                            <th>تاریخ ثبت</th>
                            <th>تنظیمات</th>
                        </tr>
                        <?php $i=1; ?>
                      @foreach($leakages as $leakage)
                          @if(in_array($leakage['provincial_zone_id'],($user->provincialZones->pluck('id')->toArray())))
                          <tr>
                              <td>{{$i++}}</td>
                              <td>{{$leakage->zone->name}}</td>
                              <td>{{$leakage->province->name}}</td>
                              <td>{{$leakage->provincialZone->name}}</td>
                              <td>
                                  @if($leakage->type_of_web=='transitive')
                                      انتقالی
                                  @elseif($leakage->type_of_web=='distributive')
                                      توزیعی
                                  @else
                                      توزیعی مشترکین
                                  @endif
                              </td>
                              <td>{{$leakage->total}}</td>
                              <td>
                                  @if($leakage->fixation==1)
                                      بلی
                                  @else
                                      نخیر
                                  @endif
                              </td>


                              <td>{{jdate($leakage->created_at)->format('%A %d %B %y')}}</td>

                              <td class="d-flex ">

                                  <div class="btn-group">
                                      <button type="button" class="btn btn-info btn-sm dropdown-toggle" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                          تنظیمات
                                      </button>
                                      <div class="dropdown-menu">

                                          @can('edit-leakage')
                                              <a href="{{route('admin.leakages.edit',$leakage->id)}}" class="dropdown-item">ویرایش</a>
                                          @endcan
                                              <a href="{{route('admin.leakages.show',$leakage->id)}}" class="dropdown-item">جزییات</a>
                                          @can('delete-leakage')
                                              <form action="{{route('admin.leakages.destroy',$leakage->id)}}" method="POST">
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
                    {{$leakages->render()}}
                </div>
            </div>
            <!-- /.card -->
        </div>
    </div>

@endcomponent
