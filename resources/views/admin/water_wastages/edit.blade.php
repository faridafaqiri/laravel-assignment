@component('admin.layouts.content
' , ['title' => 'ویرایش ضایعات آب'])
    @slot('breadcrumb')
        <li class="breadcrumb-item"><a href="{{route('admin.')}}">پنل مدیریت</a></li>
        <li class="breadcrumb-item "><a href="{{route('admin.water_wastages.index')}}">ضایعات آب</a></li>
        <li class="breadcrumb-item active">ثبت ضایعات</li>
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
                    <h3 class="card-title">ثبت ضایعات آب</h3>
                </div>
                <!-- /.card-header -->
                <!-- form start -->
                <form class="form-horizontal" method="post" action="{{route('admin.water_wastages.update',['water_wastage'=>$waterWastage->id])}}">
                    @csrf
                    @method('PATCH')
                    <div class="card-body">
                        @include('admin.zone_pz_province.zone_pz_province_edit')

                        <div class="form-group">
                            <div class="row">
                                <div class="col-md-6">
                                    <label for="wasted_type" class=" control-label">نوعیت ضایعات </label>
                                    <select class="form-control" name="wasted_type" id="wasted_type" >
                                        <option value="1" {{$waterWastage->wasted_type==1 ?'selected' : ''}}>تخنیکی</option>
                                        <option value="0" {{$waterWastage->wasted_type==0 ?'selected' : ''}}>تجاری</option>
                                    </select>
                                </div>
                                <div class="col-md-6">
                                    <label for="loss" class=" control-label">هزینه آب ضایع شده</label>
                                    <input type="number" step="any" name="loss" class="form-control" id="loss" placeholder="هزینه آب های ضایع شده را وارد کنید" value="{{old('loss',$waterWastage->loss)}}">
                                </div>
                            </div>
                        </div>

                    </div>

                    <!-- /.card-body -->
                    <div class="card-footer">
                        <button type="submit" class="btn btn-info">ویرایش</button>
                        <a href="{{route('admin.water_wastages.index')}}" class="btn btn-default float-left">لغو </a>
                    </div>
                    <!-- /.card-footer -->
                </form>
            </div>
        </div>
    </div>

@endcomponent
