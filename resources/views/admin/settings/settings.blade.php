@component('admin.layouts.content' , ['title' => ' تنظیمات'])
    @slot('breadcrumb')
        <li class="breadcrumb-item"><a href="{{route('admin.')}}">پنل مدیریت</a></li>
        <li class="breadcrumb-item active">تنظیمات</li>
    @endslot

    <div class="row">
        <div class="col-lg-12">
            @include('admin.layouts.errors')
            <div class="card card-info">
                <div class="card-header">
                    <h3 class="card-title">تنظیمات سایت</h3>
                </div>
                <!-- /.card-header -->
                <!-- form start -->
                <form class="form-horizontal" method="post" action="{{route('admin.settings.update')}}">
                    @csrf
                    <div class="card-body">

                        <div class="form-group">
                            <div class="row">
                                    <label for="site_name" class=" control-label">نام سایت</label>
                                    <input type="text" name="site_name" class="form-control" id="site_name" placeholder="  نام سایت را وارد کنید" value="{{$settings->site_name}}">
                            </div>
                        </div>

                    </div>
                    <!-- /.card-body -->
                    <div class="card-footer">
                        <button type="submit" class="btn btn-info">ویرایش تنظیمات سایت</button>
                        <a href="{{route('admin.')}}" class="btn btn-default float-left">لغو </a>
                    </div>
                    <!-- /.card-footer -->
                </form>
            </div>
        </div>
    </div>

@endcomponent
