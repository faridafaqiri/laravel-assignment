@component('admin.layouts.content
' , ['title' => 'جزییات نل های لیک شده'])
    @slot('breadcrumb')
        <li class="breadcrumb-item"><a href="{{route('admin.')}}">پنل مدیریت</a></li>
        <li class="breadcrumb-item "><a href="{{route('admin.leakages.index')}}"> نل های لیک شده</a></li>
        <li class="breadcrumb-item active">جزییات نل های لیک شده</li>
    @endslot
    <div class="row">
    <div class="col-12">
        <!-- Custom Tabs -->
        <div class="card">
            <div class="card-header">
                <h3 class="card-title">جزییات نل های لیک شده</h3>

            </div>
            <div class="card-body table-responsive-md  p-0">
                <table class="table table-hover">
                    <tbody>
                    <tr>
                        <th>زون</th>
                        <td>{{$leakage->zone->name}}</td>
                    </tr>
                    <tr>
                        <th>ولایت</th>
                        <td>{{$leakage->province->name}}</td>
                    </tr>
                    <tr>
                        <th>زون ولایتی</th>
                        <td>{{$leakage->provincialZone->name}}</td>
                    </tr>
                    <tr>
                        <th>مجموع نل های لیک شده</th>
                        <td>{{$leakage->total}}</td>
                    </tr>
                    <tr>
                        <th>ترمیم شده</th>
                        <td>
                            @if($leakage->fixation==1)
                                بلی
                            @else
                                نخیر
                            @endif
                        </td>
                    </tr>
                    <tr>
                        <th>شبکه</th>
                        <td>
                            @if($leakage->type_of_web=='transitive')
                                انتقالی
                            @elseif($leakage->type_of_web=='distributive')
                                توزیعی
                            @else
                                توزیعی مشترکین
                            @endif
                        </td>
                    </tr>

                    <tr>
                        <th>تاریخ ثبت</th>
                        <td>{{jdate($leakage->created_at)->format('%A %d %b %y')}}</td>
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
