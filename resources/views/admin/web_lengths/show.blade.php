@component('admin.layouts.content
' , ['title' => 'جزییات طول شبکه'])
    @slot('breadcrumb')
        <li class="breadcrumb-item"><a href="{{route('admin.')}}">پنل مدیریت</a></li>
        <li class="breadcrumb-item "><a href="{{route('admin.web_lengths.index')}}">طول شبکه</a></li>
        <li class="breadcrumb-item active">جزییات طول شبکه</li>
    @endslot
    <div class="row">
    <div class="col-12">
        <!-- Custom Tabs -->
        <div class="card">
            <div class="card-header">
                <h3 class="card-title">جزییات طول شبکه</h3>
            </div>
            <div class="card-body table-responsive-md  p-0">
                <table class="table table-hover">
                    <tbody>
                    <tr>
                        <th>زون</th>
                        <td>{{$webLength->zone->name}}</td>
                    </tr>
                    <tr>
                        <th>ولایت</th>
                        <td>{{$webLength->province->name}}</td>
                    </tr>
                    <tr>
                        <th>زون ولایتی</th>
                        <td>{{$webLength->provincialZone->name}}</td>
                    </tr>
                    <tr>
                        <th>طول شبکه توزیعی</th>
                        <td>{{$webLength->distributive_web_length}}</td>
                    </tr>
                    <tr>
                        <th>طول شبکه انتقالی</th>
                        <td>{{$webLength->transitive_web_length}}</td>
                    </tr>
                    <tr>
                        <th>مجموع طول شبکه</th>
                        <td>{{$webLength->distributive_web_length+$webLength->transitive_web_length}}</td>
                    </tr>


                    <tr>
                        <th>تاریخ ثبت</th>
                        <td>{{jdate($webLength->created_at)->format('%A %d %B %y')}}</td>
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
