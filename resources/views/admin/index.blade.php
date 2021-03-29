@component('admin.layouts.content' , ['title' => $site_name])
    @slot('breadcrumb')
        <li class="breadcrumb-item active">
            <button class="btn btn-sm btn-info">{{\Illuminate\Support\Facades\Auth::user()->name}} عزیز خوش امدید</button>
        </li>
    @endslot
        <div class="row">
            <div class="col-lg-3 col-6">
                <!-- small box -->
                <div class="small-box bg-primary">
                    <div class="inner">
                        <h3>{{$all_customers}}</h3>

                        <p>مجموع مشترکین</p>
                    </div>
                    <div class="icon">
                        <i class="icon ion-ios-people"></i>
                    </div>

                </div>
            </div>
            <div class="col-lg-3 col-6">
                <!-- small box -->
                <div class="small-box bg-success">
                    <div class="inner">
                        <h3>{{$meter_customers}}</h3>

                        <p>مشترکین میتری</p>
                    </div>
                    <div class="icon">
                        <i class="icon ion-android-person-add"></i>
                    </div>

                </div>
            </div>
            <div class="col-lg-3 col-6">
                <!-- small box -->
                <div class="small-box bg-warning">
                    <div class="inner">
                        <h3>{{$numeric_customers}}</h3>

                        <p>مشترکین عددی</p>
                    </div>
                    <div class="icon">
                        <i class="icon ion-person-stalker"></i>
                    </div>

                </div>
            </div>
            <div class="col-lg-3 col-6">
                <!-- small box -->
                <div class="small-box bg-info">
                    <div class="inner">
                        <h3>{{$illegal_customer}}</h3>

                        <p>مجموع مشترکین غیر قانونی</p>
                    </div>
                    <div class="icon">
                        <i class="icon ion-man"></i>
                    </div>

                </div>
            </div>
        </div>
    <div class="row">
        <div class="col-lg-3 col-6">
            <!-- small box -->
            <div class="small-box bg-danger">
                <div class="inner">
                    <h3>{{$water_production}}</h3>

                    <p>مجموع تولید آب</p>
                </div>
                <div class="icon">
                    <i class="icon ion-waterdrop"></i>
                </div>

            </div>
        </div>
        <div class="col-lg-3 col-6">
            <!-- small box -->
            <div class="small-box bg-secondary">
                <div class="inner">
                    <h3>{{$water_distribution}}</h3>

                    <p>مجموع توزیع آب</p>
                </div>
                <div class="icon">
                    <i class="icon ion-plus-round"></i>
                </div>

            </div>
        </div>
        <div class="col-lg-3 col-6">
            <!-- small box -->
            <div class="small-box bg-dark">
                <div class="inner">
                    <h3>{{$water_wastage}}</h3>

                    <p>مجموع ضایع آب</p>
                </div>
                <div class="icon">
                    <i class="icon ion-close-round"></i>
                </div>

            </div>
        </div>
        <div class="col-lg-3 col-6">
            <!-- small box -->
            <div class="small-box bg-success-gradient">
                <div class="inner">
                    <h3>{{$illegal_customer_system}}</h3>

                    <p>مجموع مشترکین ثبت سیستم</p>
                </div>
                <div class="icon">
                    <i class="icon ion-man"></i>
                </div>

            </div>
        </div>

    </div>
        <div class="row">
            <div class="col-lg-12 col-6">
                <water-production :values="{{json_encode($values)}}" :labels="{{json_encode($labels)}}"></water-production>
                <income :values="{{json_encode($values)}}" :labels="{{json_encode($labels)}}"></income>
            </div>
        </div>
@endcomponent

