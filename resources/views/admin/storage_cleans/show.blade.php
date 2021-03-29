@component('admin.layouts.content
' , ['title' => 'جزییات  پاک کاری ذخایر'])
    @slot('breadcrumb')
        <li class="breadcrumb-item"><a href="{{route('admin.')}}">پنل مدیریت</a></li>
        <li class="breadcrumb-item "><a href="{{route('admin.storage_cleans.index')}}"> پاک کاری ذخایر</a></li>
        <li class="breadcrumb-item active">جزییات  پاک کاری ذخایر</li>
    @endslot
    <div class="row">
    <div class="col-12">
        <!-- Custom Tabs -->
        <div class="card">
            <div class="card-header">
                <h3 class="card-title">جزییات  پاک کاری ذخایر</h3>

            </div>
            <div class="card-body table-responsive-md  p-0">
                <table class="table table-hover">
                    <tbody>
                    <tr>
                        <th>زون</th>
                        <td>{{$storageClean->zone->name}}</td>
                    </tr>
                    <tr>
                        <th>ولایت</th>
                        <td>{{$storageClean->province->name}}</td>
                    </tr>
                    <tr>
                        <th>زون ولایتی</th>
                        <td>{{$storageClean->provincialZone->name}}</td>
                    </tr>
                    <tr>
                        <th>تعداد ذخایر پاک شده</th>
                        <td>{{$storageClean->count}}</td>
                    </tr>
                    <tr>
                        <th>نوعیت کلورین</th>
                        <td>
                            @if($storageClean->chlorine_type==1)
                                مایع
                            @else
                                جامد
                            @endif

                        </td>
                    </tr>
                    <tr>
                        <th>مقدار کلورین</th>
                        <td>{{$storageClean->chlorine_amount}}</td>
                    </tr>
                    <tr>
                        <th>واحد اندازه گیری</th>
                        <td>
                            @if($storageClean->unite==1)
                                لیتر
                            @else
                                کیلوگرام
                            @endif

                        </td>
                    </tr>

                    <tr>
                        <th>تاریخ ثبت</th>
                        <td>{{jdate($storageClean->created_at)->format('%A %d %b %y')}}</td>
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
