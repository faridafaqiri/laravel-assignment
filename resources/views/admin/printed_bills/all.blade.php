@component('admin.layouts.content' , ['title' => 'بل های چاپ شده'])
    @slot('breadcrumb')
        <li class="breadcrumb-item"><a href="{{route('admin.')}}">پنل مدیریت</a></li>
        <li class="breadcrumb-item active">بل های چاپ شده</li>
    @endslot

    <div class="row">
        <div class="col-12">
            <div class="card">
                <div class="card-header">
                    <h3 class="card-title">بل های چاپ شده</h3>
                    <div class="card-tools d-flex">
                        <div class="btn-group-sm mr-1">
                            @can('create-printed-bill')
                                <a href="{{route('admin.printed_bills.create')}}" class="btn btn-info">ثبت بل های چاپ شده </a>
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
                            <th>نوع نل</th>
                            <th>تعداد بل ها</th>
                            <th>چاپ دوباره</th>
                            <th>تاریخ ثبت</th>
                            <th>تنظیمات</th>
                        </tr>
                        <?php $i=1; ?>
                      @foreach($printed_bills as $printed_bill)
                          @if(in_array($printed_bill['provincial_zone_id'],($user->provincialZones->pluck('id')->toArray())))
                          <tr>
                              <td>{{$i++}}</td>
                              <td>{{$printed_bill->zone->name}}</td>
                              <td>{{$printed_bill->province->name}}</td>
                              <td>{{$printed_bill->provincialZone->name}}</td>
                              <td>
                                  @if($printed_bill->type==1)
                                      میتری
                                  @else
                                      عددی
                                  @endif
                              </td>
                              <td>{{$printed_bill->total_printed}}</td>
                              <td>
                                  @if($printed_bill->reprinted==1)
                                      بلی
                                      @else
                                        نخیر
                                  @endif
                              </td>

                              <td>{{jdate($printed_bill->created_at)->format('%A %d %B %y')}}</td>

                              <td class="d-flex ">

                                  <div class="btn-group">
                                      <button type="button" class="btn btn-info btn-sm dropdown-toggle" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                          تنظیمات
                                      </button>
                                      <div class="dropdown-menu">

                                          @can('edit-printed-bill')
                                              <a href="{{route('admin.printed_bills.edit',$printed_bill->id)}}" class="dropdown-item">ویرایش</a>
                                          @endcan
                                              <a href="{{route('admin.printed_bills.show',$printed_bill->id)}}" class="dropdown-item">جزییات</a>
                                          @can('delete-printed-bill')
                                              <form action="{{route('admin.printed_bills.destroy',$printed_bill->id)}}" method="POST">
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
                    {{$printed_bills->render()}}
                </div>
            </div>
            <!-- /.card -->
        </div>
    </div>

@endcomponent
