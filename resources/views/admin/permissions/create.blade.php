@component('admin.layouts.content
' , ['title' => 'ایجاد دسترسی'])
    @slot('breadcrumb')
        <li class="breadcrumb-item"><a href="{{route('admin.')}}">پنل مدیریت</a></li>
        <li class="breadcrumb-item "><a href="{{route('admin.permissions.index')}}">همه دسترسی ها</a></li>
        <li class="breadcrumb-item active">ایجاد دسترسی جدید</li>
    @endslot

    <div class="row">
        <div class="col-lg-12">
            @include('admin.layouts.errors')
            <div class="card card-info">
                <div class="card-header">
                    <h3 class="card-title">فرم ایجاد دسترسی </h3>
                </div>
                <!-- /.card-header -->
                <!-- form start -->
                <form class="form-horizontal" method="post" action="{{route('admin.permissions.store')}}">
                    @csrf
                    <div class="card-body">
                        <div class="form-group">
                            <label for="name" class=" control-label">نام دسترسی</label>
                            <input type="text" name="name" class="form-control" id="name" placeholder="نام دسترسی را وارد کنید" value="{{old('name')}}">
                        </div>
                        <div class="form-group">
                            <label for="label" class=" control-label">توضیح دسترسی</label>
                                <input type="text" name="label" class="form-control" id="label" placeholder="توضیح دسترسی را وارد کنید" value="{{old('label')}}">
                        </div>
                    </div>
                    <!-- /.card-body -->
                    <div class="card-footer">
                        <button type="submit" class="btn btn-info">ثبت دسترسی</button>
                        <a href="{{route('admin.permissions.index')}}" class="btn btn-default float-left">لغو دسترسی</a>
                    </div>
                    <!-- /.card-footer -->
                </form>
            </div>
        </div>
    </div>

@endcomponent
