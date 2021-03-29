@component('admin.layouts.content
' , ['title' => 'ویرایش ذخیره آب'])
    @slot('breadcrumb')
        <li class="breadcrumb-item"><a href="{{route('admin.')}}">پنل مدیریت</a></li>
        <li class="breadcrumb-item "><a href="{{route('admin.water_storages.index')}}"> ذخایر آب </a></li>
        <li class="breadcrumb-item active">ویرایش ذخیره آب</li>
    @endslot

    @slot('script')
        <script>
            /*$('#province_zone_id').select2({
                'placeholder':'زون ولایتی مورد نظر را انتخاب کنید'
            })*/

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
                    <h3 class="card-title">فورم ویرایش ذخیره آب </h3>
                </div>
                <!-- /.card-header -->
                <!-- form start -->
                <form class="form-horizontal" method="post" action="{{route('admin.water_storages.update',['water_storage'=>$waterStorage->id])}}">
                    @csrf
                    @method('PATCH')
                    <div class="card-body">
                        @include('admin.zone_pz_province.zone_pz_province_edit')
                        <div class="form-group">
                            <div class="row">
                                <div class="col-md-6">
                                    <label for="capacity" class=" control-label">ظرفیت مخزن </label>
                                    <input type="number" step="any" name="capacity" class="form-control" id="capacity" placeholder="ظرفیت مخزن را به متر مکعب وارد کنید " value="{{old('capacity',$waterStorage->capacity)}}">
                                </div>
                                <div class="col-md-6">
                                    <label for="storage_type">مواد ساخت ذخیره</label>
                                    <select class="form-control" name="storage_type" id="storage_type">
                                        <option value="0" {{$waterStorage->storage_type=="0" ? 'selected' : ''}}>کانکریتی</option>
                                        <option value="1" {{$waterStorage->storage_type=="1" ? 'selected' : ''}}>فلزی</option>
                                    </select>
                                </div>
                            </div>

                        </div>

                        <div class="form-group">
                            <div class="row">
                                <div class="col-md-6">
                                    <label for="height_type">نوعیت</label>
                                    <select class="form-control" name="height_type" id="height_type">
                                        <option value="0" {{$waterStorage->height_type=='0' ? 'selected' : ''}}>ارتفاعی</option>
                                        <option value="1" {{$waterStorage->height_type=='1' ? 'selected' : ''}}>زمینی</option>
                                    </select>
                                </div>
                                <div class="col-md-6">
                                    <label for="activation">فعال</label>
                                    <select class="form-control" name="activation" id="activation">
                                        <option value="1" {{$waterStorage->activation=="1" ? 'selected' : ''}}>بلی</option>
                                        <option value="0" {{$waterStorage->activation=="0" ? 'selected' : ''}}>نخیر</option>
                                    </select>
                                </div>
                            </div>

                        </div>

                    </div>

                    <!-- /.card-body -->
                    <div class="card-footer">
                        <button type="submit" class="btn btn-info">ویرایش</button>
                        <a href="{{route('admin.water_storages.index')}}" class="btn btn-default float-left">لغو </a>
                    </div>
                    <!-- /.card-footer -->
                </form>
            </div>
        </div>
    </div>

@endcomponent
