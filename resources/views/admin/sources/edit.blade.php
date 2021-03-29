@component('admin.layouts.content
' , ['title' => 'ویرایش منابع'])
    @slot('breadcrumb')
        <li class="breadcrumb-item"><a href="{{route('admin.')}}">پنل مدیریت</a></li>
        <li class="breadcrumb-item"><a href="{{route('admin.sources.index')}}"> تعداد منابع  </a></li>
        <li class="breadcrumb-item active">ویرایش منابع</li>
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
                    <h3 class="card-title"> ویرایش منابع </h3>
                </div>
                <!-- /.card-header -->
                <!-- form start -->
                <form class="form-horizontal" method="post" action="{{route('admin.sources.update',['source'=>$source->id])}}">
                    @csrf
                    @method('PATCH')
                    <div class="card-body">
                        @include('admin.zone_pz_province.zone_pz_province_edit')
                        <div class="form-group">
                            <div class="row">
                                <div class="col-md-6">
                                    <label for="source_type_id" class=" control-label">نوع منبع</label>
                                    <select class="form-control" name="source_type_id" id="source_type_id" >
                                        @foreach(\App\Source_type::all() as $source_type)
                                            <option value="{{$source_type->id}}">{{$source_type->name}}</option>
                                        @endforeach
                                    </select>
                                </div>

                                <div class="col-md-6">
                                    <label for="total_source" class=" control-label">تعداد منابع</label>
                                    <input type="number" name="total_source" class="form-control" id="total_source" placeholder="تعداد منابع را وارد کنید" value="{{old('total_source',$source->total_source)}}">
                                </div>
                            </div>

                        </div>
                        <div class="form-group">
                            <div class="row">
                                <div class="col-md-6">
                                    <label for="total_active" class=" control-label">تعداد منابع فعال</label>
                                    <input type="number" name="total_active" class="form-control" id="total_active" placeholder="تعداد منابع فعال را وارد کنید" value="{{old('total_active',$source->total_active)}}">
                                </div>
                                <div class="col-md-6">
                                    <label for="total_pumps" class=" control-label">تعداد پمپ ها</label>
                                    <input type="number" name="total_pumps" class="form-control" id="total_pumps" placeholder=" تعداد پمپ ها را وارد کنید" value="{{old('total_pumps',$source->total_pumps)}}">
                                </div>
                            </div>
                        </div>

                    </div>
                    <!-- /.card-body -->
                    <div class="card-footer">
                        <button type="submit" class="btn btn-info">ویرایش</button>
                        <a href="{{route('admin.sources.index')}}" class="btn btn-default float-left">لغو </a>
                    </div>
                    <!-- /.card-footer -->
                </form>
            </div>
        </div>
    </div>

@endcomponent
