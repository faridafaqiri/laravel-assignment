@component('admin.layouts.content
' , ['title' => 'ایجاد مقام'])
    @slot('breadcrumb')
        <li class="breadcrumb-item"><a href="{{route('admin.')}}">پنل مدیریت</a></li>
        <li class="breadcrumb-item "><a href="{{route('admin.roles.index')}}">همه مقام ها</a></li>
        <li class="breadcrumb-item active">ایجاد مقام جدید</li>
    @endslot
    @slot('script')
        <script>
            $('#permissions').select2({
                'placeholder':'دسترسی مورد نظر را انتخاب کنید'
            })
        </script>
    @endslot

    <div class="row">
        <div class="col-lg-12">
            @include('admin.layouts.errors')
            <div class="card card-info">
                <div class="card-header">
                    <h3 class="card-title">فرم ایجاد مقام </h3>
                </div>
                <!-- /.card-header -->
                <!-- form start -->
                <form class="form-horizontal" method="post" action="{{route('admin.roles.update',$role->id)}}">
                    @csrf
                    @method('PATCH')
                    <div class="card-body">
                        <div class="form-group">
                            <label for="name" class=" control-label">نام مقام</label>
                            <input type="text" name="name" class="form-control" id="name" placeholder="نام مقام را وارد کنید" value="{{old('name',$role->name)}}">
                        </div>
                        <div class="form-group">
                            <label for="label" class=" control-label">توضیح مقام</label>
                            <input type="text" name="label" class="form-control" id="label" placeholder="توضیح مقام را وارد کنید" value="{{old('label',$role->label)}}">
                        </div>
                        <div class="from-group">
                            <label for="permissions" class=" control-label">دسترسی ها</label>
                            <select class="form-control" name="permissions[]" id="permissions" multiple>
                                @foreach(\App\Permission::all() as $permission)
                                    <option value="{{$permission->id}}" {{in_array($permission->id,$role->permissions->pluck('id')->toArray())?'selected':''}}>{{$permission->name}}-{{$permission->label}}</option>
                                @endforeach
                            </select>
                        </div>
                    </div>
                    <!-- /.card-body -->
                    <div class="card-footer">
                        <button type="submit" class="btn btn-info">ثبت مقام</button>
                        <a href="{{route('admin.roles.index')}}" class="btn btn-default float-left">لغو مقام</a>
                    </div>
                    <!-- /.card-footer -->
                </form>
            </div>
        </div>
    </div>

@endcomponent
