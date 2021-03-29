@component('admin.layouts.content
' , ['title' => 'ایجاد زون'])
    @slot('breadcrumb')
        <li class="breadcrumb-item"><a href="{{route('admin.')}}">پنل مدیریت</a></li>
        <li class="breadcrumb-item "><a href="{{route('admin.roles.index')}}"> زون ها</a></li>
        <li class="breadcrumb-item active">ایجاد زون جدید</li>
    @endslot

    <div class="row">
        <div class="col-lg-12">
            @include('admin.layouts.errors')
            <div class="card card-info">
                <div class="card-header">
                    <h3 class="card-title"> ایجاد زون </h3>
                </div>
                <!-- /.card-header -->
                <!-- form start -->
                <form class="form-horizontal" method="post" action="{{route('admin.zones.store')}}">
                    @csrf
                    <div class="card-body">
                        <div class="form-group">
                            <label for="name" class=" control-label">نام زون</label>
                            <input type="text" name="name" class="form-control" id="name" placeholder="نام زون را وارد کنید" value="{{old('name')}}">
                        </div>

                    </div>
                    <!-- /.card-body -->
                    <div class="card-footer">
                        <button type="submit" class="btn btn-info">ثبت </button>
                        <a href="{{route('admin.zones.index')}}" class="btn btn-default float-left">لغو </a>
                    </div>
                    <!-- /.card-footer -->
                </form>
            </div>
        </div>
    </div>

@endcomponent
