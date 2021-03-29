@component('admin.layouts.content' , ['title' => 'مشترکین'])
    @slot('breadcrumb')
        <li class="breadcrumb-item"><a href="{{route('admin.')}}">پنل مدیریت</a></li>
        <li class="breadcrumb-item active">مشترکین</li>
    @endslot

    <div class="row">
        <div class="col-12">
            <div class="card">
                <div class="card-header">
                    <h3 class="card-title">مشترکین</h3>
                    <div class="card-tools d-flex">
                        <div class="btn-group-sm mr-1">
                            <a href="{{route('admin.customers.index')}}" class="btn btn-primary">تمام مشترکین</a>
                            <a href="{{url('http://sub.pohantoonplus.com/customers?metric_customers=1')}}" class="btn btn-success">مشترکین میتری</a>
                            <a href="{{url('http://sub.pohantoonplus.com/customers?numeric_customers=1')}}" class="btn btn-danger">مشترکین عددی</a>
                            @can('create-customer')
                                <a href="{{route('admin.customers.create')}}" class="btn btn-info">ایجاد مشترکین جدید </a>
                            @endcan

                        </div>
                    </div>
                </div>
                <!-- /.card-header -->
                <div class="card-body table-responsive-md p-0">
                    @if(count($customers) > 0)
                    <table class="table table-hover">
                        <tbody>
                        <tr>
                            <th>#</th>
                            <th>زون</th>
                            <th>ولایت</th>
                            <th>زون ولایتی</th>
                            <th>نوع نل</th>
                            <th>سابقه/جدید</th>
                            <th>مجموع مشترکین</th>
                            <th>تاریخ ثبت</th>
                            <th>تنظیمات</th>
                        </tr>

                        <?php $i=1; ?>
                      @foreach($customers as $customer)
                          @if(in_array($customer['provincial_zone_id'],($user->provincialZones->pluck('id')->toArray())))
                          <tr>
                              <td>{{$i++}}</td>
                              <td>{{$customer->zone->name}}</td>
                              <td>{{$customer->province->name}}</td>
                              <td>{{$customer->provincialZone->name}}</td>
                              <td>
                                  @if($customer->faucet_type=="1")
                                      میتری
                                  @else
                                      عددی
                                  @endif
                              </td>
                              <td>
                                  @if($customer->old_new=="1")
                                      جدید
                                  @else
                                      سابقه
                                  @endif
                              </td>
                              <td>{{$customer->business+$customer->residential+$customer->holy_places+$customer->public_places+$customer->governmental+$customer->unknown}}</td>
                              <td>{{jdate($customer->created_at)->format('%A, %d %B %y')}}</td>

                              <td class="d-flex ">

                                  <div class="btn-group">
                                      <button type="button" class="btn btn-info btn-sm dropdown-toggle" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                          تنظیمات
                                      </button>
                                      <div class="dropdown-menu">

                                          @can('edit-customer')
                                              <a href="{{route('admin.customers.edit',['customer'=>$customer->id])}}" class="dropdown-item">ویرایش</a>
                                          @endcan
                                          @can('delete-customer')
                                              <form action="{{route('admin.customers.destroy',['customer'=>$customer->id])}}" method="POST">
                                                  @csrf
                                                  @method('DELETE')
                                                  <button type="submit" class="dropdown-item">حذف</button>
                                              </form>
                                          @endcan

                                              <a href="{{route('admin.customers.show',['customer'=>$customer->id])}}" class="dropdown-item">جزییات</a>
                                      </div>
                                  </div>

                              </td>
                          </tr>
                          @endif
                      @endforeach
                        </tbody>
                    </table>
                    @else
                    <p class="alert alert-secondary">هیچ دیتایی وجود ندارد</p>
                    @endif
                </div>
                <!-- /.card-body -->
                <div class="card-footer">
                    {{$customers->render()}}
                </div>
            </div>
            <!-- /.card -->
        </div>
    </div>

@endcomponent
