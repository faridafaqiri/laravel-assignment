@component('admin.layouts.content
' , ['title' => 'جزییات بل های توزیع شده'])
    @slot('breadcrumb')
        <li class="breadcrumb-item"><a href="{{route('admin.')}}">پنل مدیریت</a></li>
        <li class="breadcrumb-item "><a href="{{route('admin.develop_web_lengths.index')}}">جزییات بل های توزیع شده</a></li>
        <li class="breadcrumb-item active">جزییات بل های توزیع شده</li>
    @endslot
    <div class="row">
    <div class="col-12">
        <!-- Custom Tabs -->
        <div class="card">
            <div class="card-header">
                <h3 class="card-title"> بل های توزیع شده</h3>

            </div>
            <div class="card-body table-responsive-md  p-0">
                <table class="table table-hover">
                    <tbody>
                    <tr>
                        <th>زون</th>
                        <td>{{$distributedBill->zone->name}}</td>
                    </tr>
                    <tr>
                        <th>ولایت</th>
                        <td>{{$distributedBill->province->name}}</td>
                    </tr>
                    <tr>
                        <th>زون ولایتی</th>
                        <td>{{$distributedBill->provincialZone->name}}</td>
                    </tr>
                    <tr>
                        <th>تعداد بل های توزیع شده</th>
                        <td>{{$distributedBill->total_distributed}}</td>
                    </tr>
                    <tr>
                        <th>تاریخ ثبت</th>
                        <td>{{jdate($distributedBill->created_at)->format('%A %d %b %y')}}</td>
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
