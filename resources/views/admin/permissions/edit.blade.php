@component('admin.layouts.content
' , ['title' => 'ویرایش دسترسی'])
    @slot('breadcrumb')
        <li class="breadcrumb-item"><a href="{{route('admin.')}}">پنل مدیریت</a></li>
        <li class="breadcrumb-item "><a href="{{route('admin.permissions.index')}}">همه دسترسی ها</a></li>
        <li class="breadcrumb-item active">ویرایش دسترسی جدید</li>
    @endslot

    <div class="row">
        <div class="col-lg-12">
            @include('admin.layouts.errors')
            <div class="card card-info">
                <div class="card-header">
                    <h3 class="card-title">فرم ویرایش دسترسی </h3>
                </div>
                <!-- /.card-header -->
                <!-- form start -->
                <form class="form-horizontal" method="post" action="{{route('admin.permissions.update',$permission->id)}}">
                    @csrf
                    @method('PATCH')
                    <div class="card-body">
                        <div class="form-group">
                            <label for="name" class=" control-label">نام دسترسی</label>
                            <input type="text" name="name" class="form-control" id="name" placeholder="نام دسترسی را وارد کنید" value="{{old('name',$permission->name)}}">
                        </div>
                        <div class="form-group">
                            <label for="label" class=" control-label">توضیح دسترسی</label>
                            <input type="text" name="label" class="form-control" id="label" placeholder="توضیح دسترسی را وارد کنید" value="{{old('label',$permission->label)}}">
                        </div>
                    </div>
                    <!-- /.card-body -->
                    <div class="card-footer">
                        <button type="submit" class="btn btn-info">ویرایش دسترسی</button>
                        <a href="{{route('admin.permissions.index')}}" class="btn btn-default float-left">لغو دسترسی</a>
                    </div>
                    <!-- /.card-footer -->
                </form>
            </div>
        </div>
    </div>

@endcomponent
