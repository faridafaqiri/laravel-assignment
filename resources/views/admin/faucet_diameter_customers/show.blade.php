@component('admin.layouts.content
' , ['title' => 'جزییات قطر نل مشترکین'])
    @slot('breadcrumb')
        <li class="breadcrumb-item"><a href="{{route('admin.')}}">پنل مدیریت</a></li>
        <li class="breadcrumb-item "><a href="{{route('admin.faucet_diameter_customers.index')}}">جزییات قطر نل مشترکین</a></li>
        <li class="breadcrumb-item active">جزییات قطر نل مشترکین</li>
    @endslot
    <div class="row">
    <div class="col-12">
        <!-- Custom Tabs -->
        <div class="card">
            <div class="card-header">
                <h3 class="card-title">قطر نل مشترکین</h3>

            </div>
            <div class="card-body table-responsive-md  p-0">
                <table class="table table-hover">
                    <tbody>
                    <tr>
                        <th>زون</th>
                        <td>{{$faucet_diameter_customer->zone->name}}</td>
                    </tr>
                    <tr>
                        <th>ولایت</th>
                        <td>{{$faucet_diameter_customer->province->name}}</td>
                    </tr>
                    <tr>
                        <th>زون ولایتی</th>
                        <td>{{$faucet_diameter_customer->provincialZone->name}}</td>
                    </tr>
                    <tr>
                        <th>نیم اینچ</th>
                        <td><span><sup>"</sup></span>{{$faucet_diameter_customer->half}}</td>
                    </tr>
                    <tr>
                        <th>یک اینچ</th>
                        <td><span><sup>"</sup></span>{{$faucet_diameter_customer->one}}</td>
                    </tr>
                    <tr>
                        <th>۳/۴ اینچ</th>
                        <td><span><sup>"</sup></span>{{$faucet_diameter_customer->three_quarter}}</td>
                    </tr>
                    <tr>
                        <th>تاریخ ثبت</th>
                        <td>{{jdate($faucet_diameter_customer->created_at)->format('%A %d %b %y')}}</td>
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
