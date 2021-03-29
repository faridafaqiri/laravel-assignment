@component('admin.layouts.content
' , ['title' => 'ایجاد کاربر'])
    @slot('breadcrumb')
        <li class="breadcrumb-item"><a href="{{route('admin.')}}">پنل مدیریت</a></li>
        <li class="breadcrumb-item "><a href="{{route('admin.users.index')}}">لیست کاربران</a></li>
        <li class="breadcrumb-item active">ایجاد کاربر</li>
    @endslot

    <div class="row">
        <div class="col-lg-12">
            @include('admin.layouts.errors')
            <div class="card card-info">
                <div class="card-header">
                    <h3 class="card-title">ایجاد کاربر</h3>
                </div>
                <!-- /.card-header -->
                <!-- form start -->
                <form class="form-horizontal" method="post" action="{{route('admin.users.store')}}">
                    @csrf
                    <div class="card-body">
                        <div class="form-group">
                            <label for="name" class="col-sm-2 control-label">نام کاربر</label>
                            <input type="text" name="name" class="form-control" id="name" placeholder="نام کاربر را وارد کنید" value="{{old('name')}}">
                        </div>
                        <div class="form-group">
                            <label for="inputEmail3" class="col-sm-2 control-label">ایمیل</label>
                                <input type="email" name="email" class="form-control" id="inputEmail3" placeholder="ایمیل کاربر را وارد کنید" value="{{old('email')}}">
                        </div>
                        <div class="form-group">
                            <label for="inputPassword3" class="col-sm-2 control-label">پسورد</label>
                                <input type="password" name="password" class="form-control" id="inputPassword3" placeholder="پسورد کاربر را وارد کنید" >
                        </div>
                        <div class="form-group">
                            <label for="inputPassword3" class="col-sm-2 control-label">تکرار پسورد</label>
                                <input type="password" name="password_confirmation" class="form-control" id="inputPassword3" placeholder="پسورد را دوباره وارد کنید">
                        </div>
                        <div class="form-check">
                            <input type="checkbox" name="verify" class="form-check-input" id="verify">
                            <label class="form-check-label" for="verify">اکاونت فعال باشد</label>
                        </div>

                    </div>
                    <!-- /.card-body -->
                    <div class="card-footer">
                        <button type="submit" class="btn btn-info">ثبت</button>
                        <a href="{{route('admin.users.index')}}" class="btn btn-default float-left">لغو</a>
                    </div>
                    <!-- /.card-footer -->
                </form>
            </div>
        </div>
    </div>

@endcomponent
