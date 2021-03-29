@component('admin.layouts.content' , ['title' => 'بل های توزیع شده'])
    @slot('breadcrumb')
        <li class="breadcrumb-item"><a href="{{route('admin.')}}">پنل مدیریت</a></li>
        <li class="breadcrumb-item active">بل های توزیع شده</li>
    @endslot

    <div class="row">
        <div class="col-12">
            <div class="card">
                <div class="card-header">
                    <h3 class="card-title">بل های توزیع شده</h3>
                    <div class="card-tools d-flex">
                        <div class="btn-group-sm mr-1">
                            @can('create-distributed-bill')
                                    <a href="{{route('admin.distributed_bills.create')}}" class="btn btn-info">ایجاد بل های توزیع شده</a>
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
                            <th>تعداد بل های توزیع شده</th>
                            <th>تاریخ ثبت</th>
                            <th>تنظیمات</th>
                        </tr>
                        <?php $i=1; ?>
                      @foreach($distributed_bills as $distributed_bill)
                          @if(in_array($distributed_bill['provincial_zone_id'],($user->provincialZones->pluck('id')->toArray())))
                          <tr>
                              <td>{{$i++}}</td>
                              <td>{{$distributed_bill->zone->name}}</td>
                              <td>{{$distributed_bill->province->name}}</td>
                              <td>{{$distributed_bill->provincialZone->name}}</td>
                              <td>{{$distributed_bill->total_distributed}}</td>
                              <td>{{jdate($distributed_bill->created_at)->format('%A %d %b %y')}}</td>

                              <td class="d-flex ">

                                  <div class="btn-group">
                                      <button type="button" class="btn btn-info btn-sm dropdown-toggle" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                          تنظیمات
                                      </button>
                                      <div class="dropdown-menu">

                                          @can('edit-distributed-bill')
                                              <a href="{{route('admin.distributed_bills.edit',$distributed_bill->id)}}" class="dropdown-item">ویرایش</a>
                                          @endcan
                                              <a href="{{route('admin.distributed_bills.show',$distributed_bill->id)}}" class="dropdown-item">جزییات</a>
                                          @can('delete-distributed-bill')
                                              <form action="{{route('admin.distributed_bills.destroy',$distributed_bill->id)}}" method="POST">
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
                    {{$distributed_bills->render()}}
                </div>
            </div>
            <!-- /.card -->
        </div>
    </div>

@endcomponent
