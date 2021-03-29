@component('admin.layouts.content
' , ['title' => 'جزییات تعویض طول شبکه'])
    @slot('breadcrumb')
        <li class="breadcrumb-item"><a href="{{route('admin.')}}">پنل مدیریت</a></li>
        <li class="breadcrumb-item "><a href="{{route('admin.change_web_lengths.index')}}">جزییات تعویض طول شبکه</a></li>
        <li class="breadcrumb-item active">جزییات تعویض طول شبکه</li>
    @endslot
    <div class="row">
    <div class="col-12">
        <!-- Custom Tabs -->
        <div class="card">
            <div class="card-header">
                <h3 class="card-title">تعویض طول شبکه</h3>

            </div>
            <div class="card-body table-responsive-md  p-0">
                <table class="table table-hover">
                    <tbody>
                    <tr>
                        <th>زون</th>
                        <td>{{$changeWebLength->zone->name}}</td>
                    </tr>
                    <tr>
                        <th>ولایت</th>
                        <td>{{$changeWebLength->province->name}}</td>
                    </tr>
                    <tr>
                        <th>زون ولایتی</th>
                        <td>{{$changeWebLength->provincialZone->name}}</td>
                    </tr>
                    <tr>
                        <th>نوعیت</th>
                        <td>
                            @if($changeWebLength->tran_dist=='1')
                                انتقالی
                            @else
                                توزیعی
                            @endif

                        </td>
                    </tr>

                    <tr>
                        <th>مقدار</th>
                        <td>{{$changeWebLength->length}}</td>
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
