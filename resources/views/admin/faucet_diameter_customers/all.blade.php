@component('admin.layouts.content' , ['title' => 'قطر نل مشترکین'])
    @slot('breadcrumb')
        <li class="breadcrumb-item"><a href="{{route('admin.')}}">پنل مدیریت</a></li>
        <li class="breadcrumb-item active">قطر نل مشترکین</li>
    @endslot

    <div class="row">
        <div class="col-12">
            <div class="card">
                <div class="card-header">
                    <h3 class="card-title">قطر نل مشترکین</h3>
                    <div class="card-tools d-flex">
                        <div class="btn-group-sm mr-1">
                            @can('create-faucet-diameter-customer')
                                <a href="{{route('admin.faucet_diameter_customers.create')}}" class="btn btn-info">ثبت قطر نل مشترکین</a>
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
                            <th>نیم اینچ</th>
                            <th>یک اینچ</th>
                            <th>۳/۴ اینچ</th>
                            <th>تاریخ ثبت</th>
                            <th>تنظیمات</th>
                        </tr>
                        <?php $i=1; ?>
                      @foreach($faucetDiameterCustomers as $faucet_diameter_customer)
                          @if(in_array($faucet_diameter_customer['provincial_zone_id'],($user->provincialZones->pluck('id')->toArray())))
                          <tr>
                              <td>{{$i++}}</td>
                              <td>{{$faucet_diameter_customer->zone->name}}</td>
                              <td>{{$faucet_diameter_customer->province->name}}</td>
                              <td>{{$faucet_diameter_customer->provincialZone->name}}</td>
                              <td><span><sup>"</sup></span>{{$faucet_diameter_customer->half}}</td>
                              <td><span><sup>"</sup></span>{{$faucet_diameter_customer->one}}</td>
                              <td><span><sup>"</sup></span>{{$faucet_diameter_customer->three_quarter}}</td>
                              <td>{{jdate($faucet_diameter_customer->created_at)->format('%A %d %B %y')}}</td>

                              <td class="d-flex ">

                                  <div class="btn-group">
                                      <button type="button" class="btn btn-info btn-sm dropdown-toggle" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                          تنظیمات
                                      </button>
                                      <div class="dropdown-menu">

                                          @can('edit-faucet-diameter-customer')
                                              <a href="{{route('admin.faucet_diameter_customers.edit',$faucet_diameter_customer->id)}}" class="dropdown-item">ویرایش</a>
                                          @endcan
                                              <a href="{{route('admin.faucet_diameter_customers.show',$faucet_diameter_customer->id)}}" class="dropdown-item">جزییات</a>
                                          @can('delete-faucet-diameter-customer')
                                              <form action="{{route('admin.faucet_diameter_customers.destroy',$faucet_diameter_customer->id)}}" method="POST">
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
                    {{$faucetDiameterCustomers->render()}}
                </div>
            </div>
            <!-- /.card -->
        </div>
    </div>

@endcomponent
