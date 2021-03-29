@component('admin.layouts.content
' , ['title' => 'ایجاد ولایت'])
    @slot('breadcrumb')
        <li class="breadcrumb-item"><a href="{{route('admin.')}}">پنل مدیریت</a></li>
        <li class="breadcrumb-item "><a href="{{route('admin.provinces.index')}}">ولایات</a></li>
        <li class="breadcrumb-item active">ویرایش ولایت </li>
    @endslot

    @slot('script')
        <script>
            $('#unit').select2({
                'placeholder':'نوعیت مورد نظر را انتخاب کنید'
            })
        </script>
    @endslot

    <div class="row">
        <div class="col-lg-12">
            @include('admin.layouts.errors')
            <div class="card card-info">
                <div class="card-header">
                    <h3 class="card-title"> ویرایش ولایت </h3>
                </div>
                <!-- /.card-header -->
                <!-- form start -->
                <form class="form-horizontal" method="post" action="{{route('admin.provinces.update',['province'=>$province->id])}}">
                    @csrf
                    @method('PATCH')
                    <div class="card-body">
                        <div class="form-group">
                            <label for="name" class=" control-label">نام ولایت</label>
                            <input type="text" name="name" class="form-control" id="name" placeholder="نام ولایت را وارد کنید" value="{{old('name',$province->name)}}">
                        </div>
                        <div class="from-group">
                            <label for="zone_id" class=" control-label">زون</label>
                            <select class="form-control" name="zone_id" id="zone_id" >
                                <option>زون را انتخاب کنید</option>
                                @foreach(\App\Zone::all() as $zone)
                                    <option value="{{$zone->id}}">{{$zone->name}}</option>
                                @endforeach
                            </select>
                        </div>

                        <div class="from-group">
                            <label for="unit" class=" control-label">واحد</label>
                            <select class="form-control" name="unit" id="unit" >
                                <option value="1">اولی</option>
                                <option value="0">دومی</option>
                            </select>
                        </div>


                    </div>
                    <!-- /.card-body -->
                    <div class="card-footer">
                        <button type="submit" class="btn btn-info">ویرایش</button>
                        <a href="{{route('admin.provinces.index')}}" class="btn btn-default float-left">لغو </a>
                    </div>
                    <!-- /.card-footer -->
                </form>
            </div>
        </div>
    </div>

@endcomponent
