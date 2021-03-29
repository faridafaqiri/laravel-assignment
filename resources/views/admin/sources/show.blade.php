@component('admin.layouts.content
' , ['title' => 'جزییات  منابع'])
    @slot('breadcrumb')
        <li class="breadcrumb-item"><a href="{{route('admin.')}}">پنل مدیریت</a></li>
        <li class="breadcrumb-item "><a href="{{route('admin.sources.index')}}"> منابع</a></li>
        <li class="breadcrumb-item active">جزییات  منابع</li>
    @endslot
    <div class="row">
    <div class="col-12">
        <!-- Custom Tabs -->
        <div class="card">
            <div class="card-header">
                <h3 class="card-title">جزییات  منابع</h3>

            </div>
            <div class="card-body table-responsive-md  p-0">
                <table class="table table-hover">
                    <tbody>
                    <tr>
                        <th>زون</th>
                        <td>{{$source->zone->name}}</td>
                    </tr>
                    <tr>
                        <th>ولایت</th>
                        <td>{{$source->province->name}}</td>
                    </tr>
                    <tr>
                        <th>زون ولایتی</th>
                        <td>{{$source->provincialZone->name}}</td>
                    </tr>
                    <tr>
                        <th>همه منابع</th>
                        <td>{{$source->total_source}}</td>
                    </tr>
                    <tr>
                        <th>همه پمپ ها</th>
                        <td>{{$source->total_pumps}}</td>
                    </tr>
                    <tr>
                        <th>نوع منبع</th>
                        <td>{{$source->sourceType->name}}</td>
                    </tr>
                    <tr>
                        <th>تعداد منابع فعال</th>
                        <td>{{$source->total_active}}</td>
                    </tr>
                    <tr>
                        <th>تاریخ ثبت</th>
                        <td>{{jdate($source->created_at)->format('%A %d %b %y')}}</td>
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
