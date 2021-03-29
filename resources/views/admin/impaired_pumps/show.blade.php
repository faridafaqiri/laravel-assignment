@component('admin.layouts.content
' , ['title' => 'جزییات خرابی پمپ'])
    @slot('breadcrumb')
        <li class="breadcrumb-item"><a href="{{route('admin.')}}">پنل مدیریت</a></li>
        <li class="breadcrumb-item "><a href="{{route('admin.water_wastages.index')}}">جزییات خرابی پمپ</a></li>
        <li class="breadcrumb-item active">جزییات خرابی پمپ</li>
    @endslot
    <div class="row">
    <div class="col-12">
        <!-- Custom Tabs -->
        <div class="card">
            <div class="card-header">
                <h3 class="card-title">پمپ های خراب شده</h3>
            </div>
            <div class="card-body table-responsive-md  p-0">
                <table class="table table-hover">
                    <tbody>
                    <tr>
                        <th>زون</th>
                        <td>{{$impairedPump->zone->name}}</td>
                    </tr>
                    <tr>
                        <th>ولایت</th>
                        <td>{{$impairedPump->province->name}}</td>
                    </tr>
                    <tr>
                        <th>زون ولایتی</th>
                        <td>{{$impairedPump->provincialZone->name}}</td>
                    </tr>
                    <tr>
                        <th>تعداد پمپ های خراب شده</th>
                        <td>{{$impairedPump->total_impaired}}</td>
                    </tr>
                    <tr>
                        <th>دلیل خرابی</th>
                        <td>{{$impairedPump->reason}}</td>
                    </tr>
                    <tr>
                        <th>تاریخ ثبت</th>
                        <td>{{jdate($impairedPump->created_at)->format('%A %d %b %y')}}</td>
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
