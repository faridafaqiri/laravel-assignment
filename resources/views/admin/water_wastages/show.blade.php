@component('admin.layouts.content
' , ['title' => 'جزییات آب های ضایع شده'])
    @slot('breadcrumb')
        <li class="breadcrumb-item"><a href="{{route('admin.')}}">پنل مدیریت</a></li>
        <li class="breadcrumb-item "><a href="{{route('admin.water_wastages.index')}}">آب های ضایع شده</a></li>
        <li class="breadcrumb-item active">جزییات آب های ضایع شده</li>
    @endslot
    <div class="row">
    <div class="col-12">
        <!-- Custom Tabs -->
        <div class="card">
            <div class="card-header">
                <h3 class="card-title">جزییات آب های ضایع شده</h3>
            </div>
            <div class="card-body table-responsive-md  p-0">
                <table class="table table-hover">
                    <tbody>
                    <tr>
                        <th>زون</th>
                        <td>{{$waterWastage->zone->name}}</td>
                    </tr>
                    <tr>
                        <th>ولایت</th>
                        <td>{{$waterWastage->province->name}}</td>
                    </tr>
                    <tr>
                        <th>زون ولایتی</th>
                        <td>{{$waterWastage->provincialZone->name}}</td>
                    </tr>
                    <tr>
                        <th>نوع ضایعات</th>
                        <td>
                            @if($waterWastage->wasted_type==1)
                                تخنیکی
                            @else
                                تجاری
                            @endif
                        </td>
                    </tr>
                    <tr>
                        <th>مقدار آب ضایع شده<span>(m<sup>3</sup>)</span></th>
                        <td>{{$waterWastage->wasted_water}}</td>
                    </tr>
                    <tr>
                        <th>هزینه آب ضایع شده</th>
                        <td>{{$waterWastage->loss}}</td>
                    </tr>

                    <tr>
                        <th>تاریخ ثبت</th>
                        <td>{{jdate($waterWastage->created_at)->format('%A %d %b %y')}}</td>
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
