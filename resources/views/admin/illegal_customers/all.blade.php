@component('admin.layouts.content' , ['title' => 'مشترکین غیرقانونی'])
    @slot('breadcrumb')
        <li class="breadcrumb-item"><a href="{{route('admin.')}}">پنل مدیریت</a></li>
        <li class="breadcrumb-item active">مشترکین غیرقانونی</li>
    @endslot

    <div class="row">
        <div class="col-12">
            <div class="card">
                <div class="card-header">
                    <h3 class="card-title">مشترکین غیرقانونی</h3>
                    <div class="card-tools d-flex">
                        <div class="btn-group-sm mr-1">
                            @can('create-illegal-customer')
                                    <a href="{{route('admin.illegal_customers.create')}}" class="btn btn-info">ایجاد مشترکین غیرقانونی </a>
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
                            <th>تعداد مشترکین غیرقانونی</th>
                            <th>واکنش ها</th>
                            <th>تاریخ ثبت</th>
                            <th>تنظیمات</th>
                        </tr>

                        <?php $i=1; ?>
                      @foreach($illegal_customers as $illegal_customer)
                          @if(in_array($illegal_customer['provincial_zone_id'],($user->provincialZones->pluck('id')->toArray())))
                          <tr>
                              <td>{{$i++}}</td>
                              <td>{{$illegal_customer->zone->name}}</td>
                              <td>{{$illegal_customer->province->name}}</td>
                              <td>{{$illegal_customer->provincialZone->name}}</td>
                              <td>{{$illegal_customer->total}}</td>
                              <td>
                                  @if($illegal_customer->action=='1')
                                        ثبت سیستم
                                      @else
                                            قطع نل

                                  @endif
                              </td>
                                <td>{{jdate($illegal_customer->created_at)->format('%A %d %B %y')}}</td>
                              <td class="d-flex ">

                                  <div class="btn-group">
                                      <button type="button" class="btn btn-info btn-sm dropdown-toggle" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                          تنظیمات
                                      </button>
                                      <div class="dropdown-menu">

                                          @can('edit-illegal-customer')
                                              <a href="{{route('admin.illegal_customers.edit',$illegal_customer->id)}}" class="dropdown-item">ویرایش</a>
                                          @endcan
                                              <a href="{{route('admin.illegal_customers.show',$illegal_customer->id)}}" class="dropdown-item">جزییات</a>
                                          @can('delete-illegal-customer')
                                              <form action="{{route('admin.illegal_customers.destroy',$illegal_customer->id)}}" method="POST">
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
                    {{$illegal_customers->render()}}
                </div>
            </div>
            <!-- /.card -->
        </div>
    </div>

@endcomponent
