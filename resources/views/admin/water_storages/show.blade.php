@component('admin.layouts.content
' , ['title' => 'جزییات ذخایر آب'])
    @slot('breadcrumb')
        <li class="breadcrumb-item"><a href="{{route('admin.')}}">پنل مدیریت</a></li>
        <li class="breadcrumb-item "><a href="{{route('admin.water_storages.index')}}">ذخایر آب</a></li>
        <li class="breadcrumb-item active">جزییات ذخایر آب</li>
    @endslot
    <div class="row">
    <div class="col-12">
        <!-- Custom Tabs -->
        <div class="card">
            <div class="card-header">
                <h3 class="card-title">جزییات ذخایر آب</h3>
            </div>
            <div class="card-body table-responsive-md  p-0">
                <table class="table table-hover">
                    <tbody>
                    <tr>
                        <th>زون</th>
                        <td>{{$waterStorage->zone->name}}</td>
                    </tr>
                    <tr>
                        <th>ولایت</th>
                        <td>{{$waterStorage->province->name}}</td>
                    </tr>
                    <tr>
                        <th>زون ولایتی</th>
                        <td>{{$waterStorage->provincialZone->name}}</td>
                    </tr>
                    <tr>
                        <th>مواد ساخت ذخیره</th>
                        <td>
                            @if($waterStorage->storage_type==0)
                                کانکریتی
                            @else
                                فلزی
                            @endif
                        </td>
                    </tr>
                    <tr>
                        <th>نوعیت</th>
                        <td>
                            @if($waterStorage->height_type==0)
                                ارتفاعی
                            @else
                                زمینی
                            @endif
                        </td>
                    </tr>
                    <tr>
                        <th>فعال</th>
                        <td>
                            @if($waterStorage->activation==1)
                                فعال
                            @else
                                غیر فعال
                            @endif
                        </td>
                    </tr>
                    <tr>
                        <th>ظرفیت<span>(m<sup>3</sup>)</span></th>
                        <td>{{$waterStorage->capacity}}</td>
                    </tr>


                    <tr>
                        <th>تاریخ ثبت</th>
                        <td>{{jdate($waterStorage->created_at)->format('%A %d %b %y')}}</td>
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
