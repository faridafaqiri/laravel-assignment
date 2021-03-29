@component('admin.layouts.content
' , ['title' => 'ایجاد زون ولایتی'])
    @slot('breadcrumb')
        <li class="breadcrumb-item"><a href="{{route('admin.')}}">پنل مدیریت</a></li>
        <li class="breadcrumb-item "><a href="{{route('admin.provincial-zones.index')}}"> زون های ولایتی</a></li>
        <li class="breadcrumb-item active">ایجاد زون ولایتی </li>
    @endslot


    <div class="row">
        <div class="col-lg-12">
            @include('admin.layouts.errors')
            <div class="card card-info">
                <div class="card-header">
                    <h3 class="card-title"> ایجاد زون ولایتی </h3>
                </div>
                <!-- /.card-header -->
                <!-- form start -->
                <form class="form-horizontal" method="post" action="{{route('admin.provincial-zones.store')}}">
                    @csrf
                    <div class="card-body">
                        <div class="form-group">
                            <label for="name" class=" control-label">نام زون ولایتی</label>
                            <input type="text" name="name" class="form-control" id="name" placeholder="نام زون ولایتی را وارد کنید" value="{{old('name')}}">
                        </div>

                        <div class="from-group">
                            <label for="province_id" class=" control-label">ولایت را انتخاب کنید</label>
                            <select class="form-control" name="province_id" id="province_id">
                                @foreach($provinces as $key=>$value)
                                    @if(old('province_id')==$key)
                                    <option value="{{$key}}" selected>{{$value}}</option>
                                    @else
                                        <option value="{{$key}}">{{$value}}</option>
                                    @endif
                                @endforeach

                            </select>
                        </div>

                    </div>
                    <!-- /.card-body -->
                    <div class="card-footer">
                        <button type="submit" class="btn btn-info">ثبت</button>
                        <a href="{{route('admin.provincial-zones.index')}}" class="btn btn-default float-left">لغو</a>
                    </div>
                    <!-- /.card-footer -->
                </form>
            </div>
        </div>
    </div>

@endcomponent
