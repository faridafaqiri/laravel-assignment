@component('admin.layouts.content
' , ['title' => 'جزییات کنترولینگ'])
    @slot('breadcrumb')
        <li class="breadcrumb-item"><a href="{{route('admin.')}}">پنل مدیریت</a></li>
        <li class="breadcrumb-item "><a href="{{route('admin.wall_controllings.index')}}">جزییات کنترولینگ</a></li>
        <li class="breadcrumb-item active">جزییات کنترولینگ</li>
    @endslot
    <div class="row">
    <div class="col-12">
        <!-- Custom Tabs -->
        <div class="card">
            <div class="card-header">
                <h3 class="card-title">کنترولینگ</h3>

            </div>
            <div class="card-body table-responsive-md  p-0">
                <table class="table table-hover">
                    <tbody>
                    <tr>
                        <th>زون</th>
                        <td>{{$wallControlling->zone->name}}</td>
                    </tr>
                    <tr>
                        <th>ولایت</th>
                        <td>{{$wallControlling->province->name}}</td>
                    </tr>
                    <tr>
                        <th>زون ولایتی</th>
                        <td>{{$wallControlling->provincialZone->name}}</td>
                    </tr>
                    <tr>
                        <th>تعداد</th>
                        <td>{{$wallControlling->number}}</td>
                    </tr>
                    <tr>
                        <th>فعال</th>
                        <td>
                            @if($wallControlling->active==1)
                                 بلی
                            @else
                                نخیر
                            @endif
                        </td>
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
