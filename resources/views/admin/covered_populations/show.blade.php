@component('admin.layouts.content
' , ['title' => 'جزییات نفوس تحت پوشش'])
    @slot('breadcrumb')
        <li class="breadcrumb-item"><a href="{{route('admin.')}}">پنل مدیریت</a></li>
        <li class="breadcrumb-item "><a href="{{route('admin.covered_populations.index')}}">جزییات نفوس تحت پوشش</a></li>
        <li class="breadcrumb-item active">جزییات نفوس تحت پوشش</li>
    @endslot
    <div class="row">
    <div class="col-12">
        <!-- Custom Tabs -->
        <div class="card">
            <div class="card-header">
                <h3 class="card-title">نفوس تحت پوشش</h3>

            </div>
            <div class="card-body table-responsive-md  p-0">
                <table class="table table-hover">
                    <tbody>
                    <tr>
                        <th>زون</th>
                        <td>{{$coveredPopulation->zone->name}}</td>
                    </tr>
                    <tr>
                        <th>مجموع نفوس شهری</th>
                        <td>{{$coveredPopulation->population}}</td>
                    </tr>
                    <tr>
                        <th>رهایشی</th>
                        <td>{{$coveredPopulation->m_residential}}</td>
                    </tr>
                    <tr>
                        <th>تجاری</th>
                        <td>{{$coveredPopulation->m_business}}</td>
                    </tr>
                    <tr>
                        <th>اماکن مقدسه</th>
                        <td>{{$coveredPopulation->m_holyPlaces}}</td>
                    </tr>
                    <tr>
                        <th>عامه</th>
                        <td>{{$coveredPopulation->m_public}}</td>
                    </tr>
                    <tr>
                        <th>دولتی</th>
                        <td>{{$coveredPopulation->m_governmental}}</td>
                    </tr>
                    <tr>
                        <th>سال</th>
                        <td>{{$coveredPopulation->year}}</td>
                    </tr>
                    <tr>
                        <th>تاریخ ثبت</th>
                        <td>{{jdate($coveredPopulation->created_at)->format('%A, %d %B %y')}}</td>
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
