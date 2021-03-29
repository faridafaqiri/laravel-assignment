@component('admin.layouts.content' , ['title' => 'ویرایش کاربر'])
    @slot('breadcrumb')
        <li class="breadcrumb-item"><a href="{{route('admin.')}}">پنل مدیریت</a></li>
        <li class="breadcrumb-item"><a href="{{ route('admin.users.index') }}">لیست کاربران</a></li>
        <li class="breadcrumb-item active">ویرایش کاربر</li>
    @endslot

    <div class="row">
        <div class="col-lg-12">
            @include('admin.layouts.errors')
            <div class="card">
                <div class="card-header">
                    <h3 class="card-title"> ویرایش کاربر</h3>
                </div>
                <!-- /.card-header -->
                <!-- form start -->
                <form class="form-horizontal" action="{{ route('admin.users.update', ['user' => $user->id]) }}" method="POST">
                    @csrf
                    @method('PATCH')

                    <div class="card-body">
                        <div class="form-group">
                            <label for="inputEmail3" class="col-sm-2 control-label">نام</label>
                            <input type="text" name="name" class="form-control" id="inputEmail3" placeholder="نام کاربر را وارد کنید" value="{{ old('name',$user->name) }}">
                        </div>
                        <div class="form-group">
                            <label for="inputEmail3" class="col-sm-2 control-label">ایمیل</label>
                            <input type="email" name="email" class="form-control" id="inputEmail3" placeholder="ایمیل کاربر را وارد کنید" value="{{ old('email',$user->email) }}">
                        </div>
                        <div class="form-group">
                            <label for="inputPassword3" class="col-sm-2 control-label">پسورد</label>
                            <input type="password" name="password" class="form-control" id="inputPassword3" placeholder="پسورد کاربر را وارد کنید">
                        </div>
                        <div class="form-group">
                            <label for="inputPassword3" class="col-sm-2 control-label">تکرار پسورد</label>
                            <input type="password" name="password_confirmation" class="form-control" id="inputPassword3" placeholder="پسورد را دوباره وارد کنید">
                        </div>
                        @if(! $user->hasVerifiedEmail())
                            <div class="form-check">
                                <input type="checkbox" name="verify" class="form-check-input" id="verify">
                                <label class="form-check-label" for="verify">اکانت فعال باشد</label>
                            </div>
                        @endif
                    </div>
                    <!-- /.card-body -->
                    <div class="card-footer">
                        <button type="submit" class="btn btn-info">ویرایش</button>
                        <a href="{{ route('admin.users.index') }}" class="btn btn-default float-left">لغو</a>
                    </div>
                    <!-- /.card-footer -->
                </form>
            </div>
        </div>
    </div>

@endcomponent
