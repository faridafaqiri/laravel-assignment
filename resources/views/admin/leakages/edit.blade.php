@component('admin.layouts.content
' , ['title' => 'نل های لیک شده'])
    @slot('breadcrumb')
        <li class="breadcrumb-item"><a href="{{route('admin.')}}">پنل مدیریت</a></li>
        <li class="breadcrumb-item "><a href="{{route('admin.leakages.index')}}"> نل های لیک شده</a></li>
        <li class="breadcrumb-item active">فورم ویرایش نل های لیک شده</li>
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
                    <h3 class="card-title">فورم ویرایش نل های لیک شده </h3>
                </div>
                <!-- /.card-header -->
                <!-- form start -->
                <form class="form-horizontal" method="post" action="{{route('admin.leakages.update',['leakage'=>$leakage->id])}}">
                    @csrf
                    @method('PATCH')
                    <div class="card-body">
                        @include('admin.zone_pz_province.zone_pz_province_edit')

                        <div class="form-group">
                            <div class="row">
                                <label for="type_of_web">نوع شبکه</label>
                                <select class="form-control" name="type_of_web" id="type_of_web">
                                    <option value="transitive" {{$leakage->type_of_web=='transitive'?'selected':''}}>انتقالی</option>
                                    <option value="distributive" {{$leakage->type_of_web=='distributive'?'selected':''}}>توزیعی</option>
                                    <option value="customer_distributive" {{$leakage->type_of_web=='customer_distributive'?'selected':''}}>توزیعی مشترکین</option>
                                </select>
                            </div>
                        </div>

                        <div class="form-group">
                            <div class="row">
                                <div class="col-md-6">
                                    <label for="total" class=" control-label">تعداد نل های لیک شده</label>
                                    <input type="number" name="total" class="form-control" id="total" placeholder="تعداد نل های لیک شده را وارد کنید" value="{{old('total',$leakage->total)}}">
                                </div>
                                <div class="col-md-6">
                                    <label for="fixation">ترمیم شده</label>
                                    <select class="form-control" name="fixation" id="fixation">
                                        <option value="1" {{$leakage->fixation=='1'? 'selected':''}}>بلی</option>
                                        <option value="0" {{$leakage->fixation=='0'? 'selected':''}}>نخیر</option>
                                    </select>
                                </div>
                            </div>

                        </div>

                    </div>
                    <!-- /.card-body -->
                    <div class="card-footer">
                        <button type="submit" class="btn btn-info">ویرایش</button>
                        <a href="{{route('admin.leakages.index')}}" class="btn btn-default float-left">لغو</a>
                    </div>
                    <!-- /.card-footer -->
                </form>
            </div>
        </div>
    </div>

@endcomponent
