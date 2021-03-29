@component('admin.layouts.content
' , ['title' => 'جزییات لوحه ها'])
    @slot('breadcrumb')
        <li class="breadcrumb-item"><a href="{{route('admin.')}}">پنل مدیریت</a></li>
        <li class="breadcrumb-item "><a href="{{route('admin.signboards.index')}}">لوحه ها</a></li>
        <li class="breadcrumb-item active">جزییات لوحه ها</li>
    @endslot
    <div class="row">
    <div class="col-12">
        <!-- Custom Tabs -->
        <div class="card">
            <div class="card-header">
                <h3 class="card-title">جزییات لوحه ها</h3>

            </div>
            <div class="card-body table-responsive-md  p-0">
                <table class="table table-hover">
                    <tbody>
                    <tr>
                        <th>زون</th>
                        <td>{{$signboard->zone->name}}</td>
                    </tr>
                    <tr>
                        <th>ولایت</th>
                        <td>{{$signboard->province->name}}</td>
                    </tr>
                    <tr>
                        <th>زون ولایتی</th>
                        <td>{{$signboard->provincialZone->name}}</td>
                    </tr>
                   <tr>
                       <th>تعداد لوحه ها</th>
                       <td>{{$signboard->total}}</td>
                   </tr>

                    <tr>
                        <th>تاریخ ثبت</th>
                        <td>{{jdate($signboard->created_at)->format('%A %d %b %y')}}</td>
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
