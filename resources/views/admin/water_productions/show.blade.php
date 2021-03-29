@component('admin.layouts.content
' , ['title' => 'جزییات تولید آب'])
    @slot('breadcrumb')
        <li class="breadcrumb-item"><a href="{{route('admin.')}}">پنل مدیریت</a></li>
        <li class="breadcrumb-item "><a href="{{route('admin.water_productions.index')}}">آب های تولید شده</a></li>
        <li class="breadcrumb-item active">جزییات تولید آب</li>
    @endslot
    <div class="row">
    <div class="col-12">
        <!-- Custom Tabs -->
        <div class="card">
            <div class="card-header">
                <h3 class="card-title">جزییات تولید آب</h3>

            </div>
            <div class="card-body table-responsive-md  p-0">
                <table class="table table-hover">
                    <tbody>
                    <tr>
                        <th>زون</th>
                        <td>{{$waterProduction->zone->name}}</td>
                    </tr>
                    <tr>
                        <th>ولایت</th>
                        <td>{{$waterProduction->province->name}}</td>
                    </tr>
                    <tr>
                        <th>زون ولایتی</th>
                        <td>{{$waterProduction->provincialZone->name}}</td>
                    </tr>
                   <tr>
                       <th>مقدار آب </th>
                       <td>{{$waterProduction->produce_water}}<span><sub>m<sup>3</sup></sub></span></td>
                   </tr>
                    <tr>
                        <th>مصارف روغنیات</th>
                        <td>{{$waterProduction->expense_of_oil}}<span><sub>AFN</sub></span></td>
                    </tr>
                    <tr>
                        <th>ساعات فعالیت پمپ توسط برق</th>
                        <td>{{$waterProduction->active_hours}}<span><sub>hours</sub></span></td>
                    </tr>
                    <tr>
                        <th> ساعات فعالیت پمپ توسط جنراتور</th>
                        <td>{{$waterProduction->produce_generator}}<span><sub>hours</sub></span></td>
                    </tr>
                   
                    <tr>
                        <th>هزینه تولید</th>
                        <td>{{$waterProduction->expends}}<span><sub>AFN</sub></span></td>
                    </tr>

                    <tr>
                        <th>تاریخ ثبت</th>
                        <td>{{jdate($waterProduction->created_at)->format('%A %d %b %y')}}</td>
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
