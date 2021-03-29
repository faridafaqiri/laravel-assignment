@component('admin.layouts.content
' , ['title' => 'ثبت نوع منبع'])
    @slot('breadcrumb')
        <li class="breadcrumb-item"><a href="{{route('admin.')}}">پنل مدیریت</a></li>
        <li class="breadcrumb-item "><a href="{{route('admin.source_types.index')}}"> انواع منابع </a></li>
        <li class="breadcrumb-item active">ثبت نوع منبع</li>
    @endslot


    <div class="row">
        <div class="col-lg-12">
            @include('admin.layouts.errors')
            <div class="card card-info">
                <div class="card-header">
                    <h3 class="card-title">ثبت نوع منبع </h3>
                </div>
                <!-- /.card-header -->
                <!-- form start -->
                <form class="form-horizontal" method="post" action="{{route('admin.source_types.store')}}">
                    @csrf
                    <div class="card-body">

                        <div class="form-group">
                            <label for="name" class=" control-label">نوع منبع</label>
                            <input type="text" name="name" class="form-control" id="name" placeholder="نوع منبع را وارد کنید" value="{{old('name')}}">
                        </div>
                    </div>
                    <!-- /.card-body -->
                    <div class="card-footer">
                        <button type="submit" class="btn btn-info">ثبت</button>
                        <a href="{{route('admin.source_types.index')}}" class="btn btn-default float-left">لغو </a>
                    </div>
                    <!-- /.card-footer -->
                </form>
            </div>
        </div>
    </div>

@endcomponent
