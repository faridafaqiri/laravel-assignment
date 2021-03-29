@component('admin.layouts.content
' , ['title' => 'جزییات مشترکین'])
    @slot('breadcrumb')
        <li class="breadcrumb-item"><a href="{{route('admin.')}}">پنل مدیریت</a></li>
        <li class="breadcrumb-item "><a href="{{route('admin.customers.index')}}">جزییات مشترکین</a></li>
        <li class="breadcrumb-item active">جزییات مشترکین</li>
    @endslot
    <div class="row">
    <div class="col-12">
        <!-- Custom Tabs -->
        <div class="card">
            <div class="card-header">
                <h3 class="card-title">مشترکین</h3>

            </div>
            <div class="card-body table-responsive-md  p-0">
                <table class="table table-hover">
                    <tbody>
                    <tr>
                        <th>زون</th>
                        <td>{{$customer->zone->name}}</td>
                    </tr>
                    <tr>
                        <th>ولایت</th>
                        <td>{{$customer->province->name}}</td>
                    </tr>
                    <tr>
                        <th>زون ولایتی</th>
                        <td>{{$customer->provincialZone->name}}</td>
                    </tr>
                    <tr>
                        <th>نوع نل</th>
                        <td>
                            @if($customer->faucet_type=="1")
                                میتری
                            @else
                                عددی
                            @endif
                        </td>
                    </tr>
                    <tr>
                        <th>سابقه/جدید</th>
                        <td>
                            @if($customer->old_new=="1")
                                جدید
                            @else
                                سابقه
                            @endif
                        </td>
                    </tr>
                    <tr>
                        <th>تجاری</th>
                        <td>{{$customer->business}}</td>
                    </tr>
                    <tr>
                        <th>رهایشی</th>
                        <td>{{$customer->residential}}</td>
                    </tr>
                    <tr>
                        <th>اماکن مقدسه</th>
                        <td>{{$customer->holy_places}}</td>
                    </tr>
                    <tr>
                        <th>عامه</th>
                        <td>{{$customer->public_places}}</td>
                    </tr>
                    <tr>
                        <th>دولتی</th>
                        <td>{{$customer->governmental}}</td>
                    </tr>
                    <tr>
                        <th>لادرک(گمشده)</th>
                        <td>{{$customer->unknown}}</td>
                    </tr>
                    <tr>
                        <th>مجموع نل های مشترکین</th>
                        <td>{{$customer->business+$customer->residential+$customer->holy_places+$customer->public_places+$customer->governmental+$customer->unknown}}</td>
                    </tr>
                    <tr>
                        <th>تاریخ ثبت</th>
                        <td>{{jdate($customer->created_at)->format('%A, %d %B %y')}}</td>
                    </tr>

                    </tbody>
                </table>

            </div>
        </div>

        <!-- ./card -->
    </div>
    <!-- /.col -->
</div>

@endcomponent
