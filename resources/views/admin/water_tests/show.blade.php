@component('admin.layouts.content
' , ['title' => 'جزییات تست آب'])
    @slot('breadcrumb')
        <li class="breadcrumb-item"><a href="{{route('admin.')}}">پنل مدیریت</a></li>
        <li class="breadcrumb-item "><a href="{{route('admin.water_tests.index')}}">تست آب</a></li>
        <li class="breadcrumb-item active">جزییات تست آب</li>
    @endslot
    <div class="row">
    <div class="col-12">
        <!-- Custom Tabs -->
        <div class="card">
            <div class="card-header">
                <h3 class="card-title">جزییات تست آب</h3>
            </div>
            <div class="card-body table-responsive-md  p-0">
                <table class="table table-hover">
                    <tbody>
                    <tr>
                        <th>زون</th>
                        <td>{{$waterTest->zone->name}}</td>
                    </tr>
                    <tr>
                        <th>ولایت</th>
                        <td>{{$waterTest->province->name}}</td>
                    </tr>
                    <tr>
                        <th>زون ولایتی</th>
                        <td>{{$waterTest->provincialZone->name}}</td>
                    </tr>
                    <tr>
                        <th>تعداد نمونه</th>
                        <td>{{$waterTest->count_of_instance}}</td>
                    </tr>
                    <tr>
                        <th>تعداد پارامتر ها</th>
                        <td>{{$waterTest->parameters}}</td>
                    </tr>

                    <tr>
                        <th>تاریخ ثبت</th>
                        <td>{{jdate($waterTest->created_at)->format('%A %d %b %y')}}</td>
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
