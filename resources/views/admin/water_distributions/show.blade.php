@component('admin.layouts.content
' , ['title' => 'جزییات آب های توزیع شده'])
    @slot('breadcrumb')
        <li class="breadcrumb-item"><a href="{{route('admin.')}}">پنل مدیریت</a></li>
        <li class="breadcrumb-item "><a href="{{route('admin.water_distributions.index')}}">توزیع آب</a></li>
        <li class="breadcrumb-item active">جزییات توزیع آب</li>
    @endslot
    <div class="row">
    <div class="col-12">
        <!-- Custom Tabs -->
        <div class="card">
            <div class="card-header">
                <h3 class="card-title">جزییات آب های توزیع شده</h3>

            </div>
            <div class="card-body table-responsive-md  p-0">
                <table class="table table-hover">
                    <tbody>
                    <tr>
                        <th>زون</th>
                        <td>{{$waterDistribution->zone->name}}</td>
                    </tr>
                    <tr>
                        <th>ولایت</th>
                        <td>{{$waterDistribution->province->name}}</td>
                    </tr>
                    <tr>
                        <th>زون ولایتی</th>
                        <td>{{$waterDistribution->provincialZone->name}}</td>
                    </tr>
                   <tr>
                       <th>آب های توزیع شده<span>(m<sup>3</sup>)</span></th>
                       <td>{{$waterDistribution->water_distributed}}</td>
                   </tr>

                    <tr>
                        <th>تاریخ ثبت</th>
                        <td>{{jdate($waterDistribution->created_at)->format('%A %d %b %y')}}</td>
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
