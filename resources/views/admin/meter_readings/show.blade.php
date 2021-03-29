@component('admin.layouts.content
' , ['title' => 'جزییات میتر خوانی ها'])
    @slot('breadcrumb')
        <li class="breadcrumb-item"><a href="{{route('admin.')}}">پنل مدیریت</a></li>
        <li class="breadcrumb-item "><a href="{{route('admin.meter_readings.index')}}">میتر خوانی ها</a></li>
        <li class="breadcrumb-item active">جزییات میتر خوانی ها</li>
    @endslot
    <div class="row">
    <div class="col-12">
        <!-- Custom Tabs -->
        <div class="card">
            <div class="card-header">
                <h3 class="card-title">جزییات میتر خوانی ها</h3>

            </div>
            <div class="card-body table-responsive-md  p-0">
                <table class="table table-hover">
                    <tbody>
                    <tr>
                        <th>زون</th>
                        <td>{{$meterReading->zone->name}}</td>
                    </tr>
                    <tr>
                        <th>ولایت</th>
                        <td>{{$meterReading->province->name}}</td>
                    </tr>
                    <tr>
                        <th>زون ولایتی</th>
                        <td>{{$meterReading->provincialZone->name}}</td>
                    </tr>

                    <tr>
                        <th>میتر های خوانده شده</th>
                        <td>{{$meterReading->total_read}}</td>
                    </tr>
                    <tr>
                        <th>میتر خوان</th>
                        <td>{{$meterReading->meter_reader->name}}</td>

                    </tr>
                    <tr>
                        <th>تاریخ ثبت</th>
                        <td>{{jdate($meterReading->created_at)->format('%A %d %b %y')}}</td>
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
