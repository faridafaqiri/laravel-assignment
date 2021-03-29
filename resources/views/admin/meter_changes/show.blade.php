@component('admin.layouts.content
' , ['title' => 'جزییات تعویض میتر ها'])
    @slot('breadcrumb')
        <li class="breadcrumb-item"><a href="{{route('admin.')}}">پنل مدیریت</a></li>
        <li class="breadcrumb-item "><a href="{{route('admin.meter_changes.index')}}"> تعویض میتر ها</a></li>
        <li class="breadcrumb-item active">جزییات تعویض میتر ها</li>
    @endslot
    <div class="row">
    <div class="col-12">
        <!-- Custom Tabs -->
        <div class="card">
            <div class="card-header">
                <h3 class="card-title">جزییات تعویض میتر ها</h3>

            </div>
            <div class="card-body table-responsive-md  p-0">
                <table class="table table-hover">
                    <tbody>
                    <tr>
                        <th>زون</th>
                        <td>{{$meterChange->zone->name}}</td>
                    </tr>
                    <tr>
                        <th>ولایت</th>
                        <td>{{$meterChange->province->name}}</td>
                    </tr>
                    <tr>
                        <th>زون ولایتی</th>
                        <td>{{$meterChange->provincialZone->name}}</td>
                    </tr>
                    <tr>
                        <th>تعداد میترهای تعویض شده</th>
                        <td>{{$meterChange->total}}</td>
                    </tr>
                    <tr>
                        <th>نوع میتر های تعویض شده</th>
                        <td>
                            @if($meterChange->type=='distributive')
                                توزیعی
                            @elseif($meterChange->type=='transitive')
                                میتر مشترک
                            @else
                                بالک میتر
                            @endif
                        </td>
                    </tr>

                    <tr>
                        <th>تاریخ ثبت</th>
                        <td>{{jdate($meterChange->created_at)->format('%A %d %b %y')}}</td>
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
