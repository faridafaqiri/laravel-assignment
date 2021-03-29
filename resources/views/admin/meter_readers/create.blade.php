@component('admin.layouts.content
' , ['title' => 'ثبت میتر خوان ها'])
    @slot('breadcrumb')
        <li class="breadcrumb-item"><a href="{{route('admin.')}}">پنل مدیریت</a></li>
        <li class="breadcrumb-item "><a href="{{route('admin.meter_readers.index')}}">همه میتر خوان ها </a></li>
        <li class="breadcrumb-item active">ثبت میتر خوان ها</li>
    @endslot

    @slot('script')
        <script>

            $('#zone_id').change(function (){
                var zoneID=$(this).val();
                if(zoneID){
                    $.ajax({
                        type:'GET',
                        url:"{{url('get-province-list')}}?zone_id="+zoneID,
                        success:function (res) {
                            if (res) {
                                $("#province_id").empty();
                                $("#province_id").append('<option>ولایت را انتخاب کنید</option>');
                                $.each(res, function (key, value) {
                                    $("#province_id").append('<option value="' + key + '">' + value + '</option>');
                                });

                            } else {
                                $("#province_id").empty();
                            }
                        }
                    });
                }else {
                    $("#province_id").empty();
                    $('#provincial_zone_id').empty();
                }
            });
            $('#province_id').on('change',function(){
                var ProvinceID = $(this).val();
                if(ProvinceID){
                    $.ajax({
                        type:"GET",
                        url:"{{url('get-provincial-zone-list')}}?province_id="+ProvinceID,
                        success:function(res){
                            if(res){
                                $("#provincial_zone_id").empty();
                                $.each(res,function(key,value){
                                    $("#provincial_zone_id").append('<option value="'+key+'">'+value+'</option>');
                                });

                            }else{
                                $("#provincial_zone_id").empty();
                            }
                        }
                    });
                }else{
                    $("#provincial_zone_id").empty();
                }

            });
        </script>
    @endslot

    <div class="row">
        <div class="col-lg-12">
            @include('admin.layouts.errors')
            <div class="card card-info">
                <div class="card-header">
                    <h3 class="card-title"> ثبت میتر خوان ها </h3>
                </div>
                <!-- /.card-header -->
                <!-- form start -->
                <form class="form-horizontal" method="post" action="{{route('admin.meter_readers.store')}}">
                    @csrf
                    <div class="card-body">
                        @include('admin.zone_pz_province.zone_pz_province_create')
                        <div class="form-group">
                            <div class="row">
                                <div class="col-md-6">
                                    <label for="name" class=" control-label">نام را وارد کنید</label>
                                    <input type="text" name="name" class="form-control" id="name" placeholder="نام را وارد کنید" value="{{old('name')}}">
                                </div>

                                <div class="col-md-6">
                                    <label for="degree" class="control-label">درجه تحصیلی</label>
                                    <input type="text" id="degree" name="degree" class="form-control" placeholder="درجه تحصیلی را وارد کنید" value="{{old('degree')}}">
                                </div>

                            </div>
                        </div>
                        <div class="form-group">
                            <div class="row">
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label for="area" class=" control-label">ساحه کاری</label>
                                        <select class="form-control" name="area" id="area">
                                            <option value="0">هموار</option>
                                            <option value="1">کوهی</option>
                                        </select>
                                    </div>
                                </div>
                                <div class="col-md-6">
                                    <label for="age" class=" control-label">سن</label>
                                    <input type="number" class="form-control" id="age" name="age" placeholder="سن را وارد کنید" value="{{old('age')}}">
                                </div>
                            </div>
                        </div>
                        <div class="form-group">
                            <div class="row">
                                <label for="address" class=" control-label">آدرس میتر خوان</label>
                                <textarea name="address" placeholder="آدرس میترخوان را وارد کنید" id="address" cols="30" rows="5" class="form-control" >{{old('address')}}</textarea>
                            </div>

                        </div>

                    </div>

                    <!-- /.card-body -->
                    <div class="card-footer">
                        <button type="submit" class="btn btn-info">ثبت</button>
                        <a href="{{route('admin.meter_readers.index')}}" class="btn btn-default float-left">لغو </a>
                    </div>
                    <!-- /.card-footer -->
                </form>
            </div>
        </div>
    </div>

@endcomponent
