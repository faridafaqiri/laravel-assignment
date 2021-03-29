@component('admin.layouts.content
' , ['title' => 'جزییات میتر خوان ها'])
    @slot('breadcrumb')
        <li class="breadcrumb-item"><a href="{{route('admin.')}}">پنل مدیریت</a></li>
        <li class="breadcrumb-item "><a href="{{route('admin.meter_readers.index')}}">میتر خوان ها</a></li>
        <li class="breadcrumb-item active">جزییات میتر خوان ها</li>
    @endslot
    <div class="row">
    <div class="col-12">
        <!-- Custom Tabs -->
        <div class="card">
            <div class="card-header">
                <h3 class="card-title">جزییات میتر خوان ها</h3>

            </div>
            <div class="card-body table-responsive-md  p-0">
                <table class="table table-hover">
                    <tbody>
                    <tr>
                        <th>زون</th>
                        <td>{{$meterReader->zone->name}}</td>
                    </tr>
                    <tr>
                        <th>ولایت</th>
                        <td>{{$meterReader->province->name}}</td>
                    </tr>
                    <tr>
                        <th>زون ولایتی</th>
                        <td>{{$meterReader->provincialZone->name}}</td>
                    </tr>
                    <tr>
                        <th>نام</th>
                        <td>{{$meterReader->name}}</td>
                    </tr>
                    <tr>
                        <th>آدرس</th>
                        <td>{{$meterReader->address}}</td>
                    </tr>
                    <tr>
                        <th>درجه تحصیلی</th>
                        <td>{{$meterReader->degree}}</td>
                    </tr>
                    <tr>
                        <th>ساحه کاری</th>
                        <td>
                            @if($meterReader->area==1)
                                کوهی
                            @else
                                هموار
                            @endif
                        </td>
                    </tr>


                    <tr>
                        <th>تاریخ ثبت</th>
                        <td>{{jdate($meterReader->created_at)->format('%A %d %b %y')}}</td>
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
