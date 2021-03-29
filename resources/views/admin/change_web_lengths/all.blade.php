@component('admin.layouts.content' , ['title' => 'تعویض طول شبکه'])
    @slot('breadcrumb')
        <li class="breadcrumb-item"><a href="{{route('admin.')}}">پنل مدیریت</a></li>
        <li class="breadcrumb-item active">تعویض طول شبکه</li>
    @endslot

    <div class="row">
        <div class="col-12">
            <div class="card">
                <div class="card-header">
                    <h3 class="card-title">تعویض طول شبکه</h3>
                    <div class="card-tools d-flex">
                        <div class="btn-group-sm mr-1">
                            @can('create-change-web-length')
                                <a href="{{route('admin.change_web_lengths.create')}}" class="btn btn-info">ایجاد تعویض طول شبکه</a>
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
                            <th>نوعیت</th>
                            <th>مقدار</th>
                            <th>تاریخ ثبت</th>
                            <th>تنظیمات</th>
                        </tr>
                        <?php $i=1; ?>
                      @foreach($change_web_lengths as $change_web_length)
                          @if(in_array($change_web_length['provincial_zone_id'],($user->provincialZones->pluck('id')->toArray())))
                            <tr>
                              <td>{{$i++}}</td>
                              <td>{{$change_web_length->zone->name}}</td>
                              <td>{{$change_web_length->province->name}}</td>
                              <td>{{$change_web_length->provincialZone->name}}</td>
                              <td>
                                  @if($change_web_length->tran_dist=='1')
                                      انتقالی
                                  @else
                                        توزیعی
                                  @endif

                              </td>
                              <td>{{$change_web_length->length}}</td>
                              <td>{{jdate($change_web_length->created_at)->format('%A %d %B %y')}}</td>
                              <td class="d-flex">
                                  <div class="btn-group">
                                      <button type="button" class="btn btn-info btn-sm dropdown-toggle" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                          تنظیمات
                                      </button>
                                      <div class="dropdown-menu">
                                          @can('edit-change-web-length')
                                              <a href="{{route('admin.change_web_lengths.edit',$change_web_length->id)}}" class="dropdown-item">ویرایش</a>
                                          @endcan
                                              <a href="{{route('admin.change_web_lengths.show',$change_web_length->id)}}" class="dropdown-item">جزییات</a>
                                          @can('delete-change-web-length')
                                              <form action="{{route('admin.change_web_lengths.destroy',$change_web_length->id)}}" method="POST">
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
                    {{$change_web_lengths->render()}}
                </div>
            </div>
            <!-- /.card -->
        </div>
    </div>
@endcomponent
