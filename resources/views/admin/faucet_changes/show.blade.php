@component('admin.layouts.content
' , ['title' => 'جزییات تبدیلی نل مشترکین'])
    @slot('breadcrumb')
        <li class="breadcrumb-item"><a href="{{route('admin.')}}">پنل مدیریت</a></li>
        <li class="breadcrumb-item "><a href="{{route('admin.faucet_changes.index')}}">جزییات تبدیلی نل مشترکین</a></li>
        <li class="breadcrumb-item active">جزییات تبدیلی نل مشترکین</li>
    @endslot
    <div class="row">
    <div class="col-12">
        <!-- Custom Tabs -->
        <div class="card">
            <div class="card-header">
                <h3 class="card-title">تبدیلی نل مشترکین</h3>

            </div>
            <div class="card-body table-responsive-md  p-0">
                <table class="table table-hover">
                    <tbody>
                    <tr>
                        <th>زون</th>
                        <td>{{$faucetChange->zone->name}}</td>
                    </tr>
                    <tr>
                        <th>ولایت</th>
                        <td>{{$faucetChange->province->name}}</td>
                    </tr>
                    <tr>
                        <th>زون ولایتی</th>
                        <td>{{$faucetChange->provincialZone->name}}</td>
                    </tr>
                    <tr>
                        <th>کل نل های تبدیل شده</th>
                        <td>{{$faucetChange->total}}</td>
                    </tr>
                    <tr>
                        <th> تجاری</th>
                        <td>{{$faucetChange->business}}</td>
                    </tr>
                    <tr>
                        <th>رهایشی </th>
                        <td>{{$faucetChange->residential}}</td>
                    </tr>
                    <tr>
                        <th>مقدسه</th>
                        <td>{{$faucetChange->holy_places}}</td>
                    </tr>
                    <tr>
                        <th>عامه</th>
                        <td>{{$faucetChange->public_places}}</td>
                    </tr>
                    <tr>
                        <th>دولتی</th>
                        <td>{{$faucetChange->governmental}}</td>
                    </tr>
                    <tr>
                        <th>تاریخ ثبت</th>
                        <td>{{jdate($faucetChange->created_at)->format('%A %d %b %y')}}</td>
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
