@component('admin.layouts.content
' , ['title' => 'جزییات مشترکین غیر قانونی'])
    @slot('breadcrumb')
        <li class="breadcrumb-item"><a href="{{route('admin.')}}">پنل مدیریت</a></li>
        <li class="breadcrumb-item "><a href="{{route('admin.illegal_customers.index')}}">جزییات مشترکین غیر قانونی</a></li>
        <li class="breadcrumb-item active">جزییات مشترکین غیر قانونی</li>
    @endslot
    <div class="row">
    <div class="col-12">
        <!-- Custom Tabs -->
        <div class="card">
            <div class="card-header">
                <h3 class="card-title">مشترکین غیر قانونی</h3>
            </div>
            <div class="card-body table-responsive-md  p-0">
                <table class="table table-hover">
                    <tbody>
                    <tr>
                        <th>زون</th>
                        <td>{{$illegalCustomer->zone->name}}</td>
                    </tr>
                    <tr>
                        <th>ولایت</th>
                        <td>{{$illegalCustomer->province->name}}</td>
                    </tr>
                    <tr>
                        <th>زون ولایتی</th>
                        <td>{{$illegalCustomer->provincialZone->name}}</td>
                    </tr>
                    <tr>
                        <th>تعداد مشترکین غیرقانونی</th>
                        <td>{{$illegalCustomer->total}}</td>
                    </tr>
                    <tr>
                        <th>واکنش ها</th>
                        <td>
                            @if($illegalCustomer->action=='1')
                                ثبت سیستم
                            @else
                                قطع نل

                            @endif
                        </td>
                    </tr>
                    <tr>
                        <th>تاریخ ثبت</th>
                        <td>{{jdate($illegalCustomer->created_at)->format('%A %d %b %y')}}</td>
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
