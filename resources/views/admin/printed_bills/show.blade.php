@component('admin.layouts.content
' , ['title' => 'جزییات بل های چاپ شده'])
    @slot('breadcrumb')
        <li class="breadcrumb-item"><a href="{{route('admin.')}}">پنل مدیریت</a></li>
        <li class="breadcrumb-item "><a href="{{route('admin.printed_bills.index')}}"> بل های چاپ شده</a></li>
        <li class="breadcrumb-item active">جزییات بل های چاپ شده</li>
    @endslot
    <div class="row">
    <div class="col-12">
        <!-- Custom Tabs -->
        <div class="card">
            <div class="card-header">
                <h3 class="card-title">بل های چاپ شده</h3>

            </div>
            <div class="card-body table-responsive-md  p-0">
                <table class="table table-hover">
                    <tbody>
                    <tr>
                        <th>زون</th>
                        <td>{{$printedBill->zone->name}}</td>
                    </tr>
                    <tr>
                        <th>ولایت</th>
                        <td>{{$printedBill->province->name}}</td>
                    </tr>
                    <tr>
                        <th>زون ولایتی</th>
                        <td>{{$printedBill->provincialZone->name}}</td>
                    </tr>
                    <tr>
                        <th>تعداد بل ها</th>
                        <td>{{$printedBill->total_printed}}</td>
                    </tr>
                    <tr>
                        <th>مقدار آب بل شده<span>(m<sup>3</sup>)</span></th>
                        <td>{{$printedBill->total_water_amount}}</td>
                    </tr>
                    <tr>
                        <th>مقدار پول </th>
                        <td>{{$printedBill->total_price}}</td>
                    </tr>
                    <tr>
                        <th>چاپ دوباره</th>
                        <td>
                            @if($printedBill->reprinted==1)
                                بلی
                            @else
                                نخیر
                            @endif
                        </td>
                    </tr>
                    <tr>
                        <th>نوع نل</th>
                        <td>
                            @if($printedBill->type==1)
                                میتری
                            @else
                                عددی
                            @endif
                        </td>
                    </tr>

                    <tr>
                        <th>تاریخ ثبت</th>
                        <td>{{jdate($printedBill->created_at)->format('%A %d %B %y')}}</td>
                    </tr>
                    <tr>
                        <th>توضیحات</th>
                        <td>{{$printedBill->description}}</td>
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
