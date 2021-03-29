@component('admin.layouts.content
' , ['title' => 'جزییات توسعه طول شبکه'])
    @slot('breadcrumb')
        <li class="breadcrumb-item"><a href="{{route('admin.')}}">پنل مدیریت</a></li>
        <li class="breadcrumb-item "><a href="{{route('admin.develop_web_lengths.index')}}">جزییات توسعه طول شبکه</a></li>
        <li class="breadcrumb-item active">جزییات توسعه طول شبکه</li>
    @endslot
    <div class="row">
    <div class="col-12">
        <!-- Custom Tabs -->
        <div class="card">
            <div class="card-header">
                <h3 class="card-title">توسعه طول شبکه</h3>

            </div>
            <div class="card-body table-responsive-md  p-0">
                <table class="table table-hover">
                    <tbody>
                    <tr>
                        <th>زون</th>
                        <td>{{$developWebLength->zone->name}}</td>
                    </tr>
                    <tr>
                        <th>ولایت</th>
                        <td>{{$developWebLength->province->name}}</td>
                    </tr>
                    <tr>
                        <th>زون ولایتی</th>
                        <td>{{$developWebLength->provincialZone->name}}</td>
                    </tr>
                    <tr>
                        <th> توسعه شبکه توزیعی</th>
                        <td>{{$developWebLength->develop_distributive_web_length}}</td>
                    </tr>
                    <tr>
                        <th> توسعه شبکه انتقالی</th>
                        <td>{{$developWebLength->develop_transitive_web_length}}</td>
                    </tr>
                    <tr>
                        <th>مجموع توسعه شبکه</th>
                        <td>{{$developWebLength->develop_distributive_web_length
                                    +
                                    $developWebLength->develop_transitive_web_length}}</td>
                    </tr>
                    <tr>
                        <th>تاریخ ثبت</th>
                        <td>{{jdate($developWebLength->created_at)->format('%A %d %B %y')}}</td>
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
