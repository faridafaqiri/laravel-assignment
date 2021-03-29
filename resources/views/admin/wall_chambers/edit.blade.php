@component('admin.layouts.content
' , ['title' => 'ویرایش وال چمبر'])
    @slot('breadcrumb')
        <li class="breadcrumb-item"><a href="{{route('admin.')}}">پنل مدیریت</a></li>
        <li class="breadcrumb-item "><a href="{{route('admin.wall_chambers.index')}}">ویرایش وال چمبر</a></li>
        <li class="breadcrumb-item active">ویرایش وال چمبر</li>
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
                    <h3 class="card-title"> ویرایش وال چمبر</h3>
                </div>
                <!-- /.card-header -->
                <!-- form start -->
                <form class="form-horizontal" method="post" action="{{route('admin.wall_chambers.update',['wall_chamber'=>$wallChamber->id])}}">
                    @csrf
                    @method('PATCH')
                    <div class="card-body">
                        @include('admin.zone_pz_province.zone_pz_province_edit')
                        <div class="form-group">
                            <div class="row">

                                        <div class="col-md-6">
                                            <label for="number" class="control-label">تعداد</label>
                                            <input type="number" id="number" name="number" class="form-control" placeholder="تعدا را وارد کنید" value="{{old('number',$wallChamber->number)}}">
                                        </div>
                                        <div class="col-md-6">
                                            <label for="active" class="control-label">فعال</label>
                                            <select name="active" id="active" class="form-control">
                                                <option value="1" {{$wallChamber->active=='1'?'selected':''}}> بلی</option>
                                                <option value="0" {{$wallChamber->active=='0'?'selected':''}}>نخیر</option>
                                            </select>
                                        </div>
                            </div>
                        </div>

                    </div>
                    <!-- /.card-body -->
                    <div class="card-footer">
                        <button type="submit" class="btn btn-info">ویرایش</button>
                        <a href="{{route('admin.wall_chambers.index')}}" class="btn btn-default float-left">لغو </a>
                    </div>
                    <!-- /.card-footer -->
                </form>
            </div>
        </div>
    </div>

@endcomponent
