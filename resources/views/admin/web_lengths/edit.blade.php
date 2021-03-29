@component('admin.layouts.content
' , ['title' => 'ویرایش طول شبکه'])
    @slot('breadcrumb')
        <li class="breadcrumb-item"><a href="{{route('admin.')}}">پنل مدیریت</a></li>
        <li class="breadcrumb-item "><a href="{{route('admin.web_lengths.index')}}">طول شبکه</a></li>
        <li class="breadcrumb-item active">طول شبکه طول شبکه </li>
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
                    <h3 class="card-title">ویرایش طول شبکه</h3>
                </div>
                <!-- /.card-header -->
                <!-- form start -->
                <form class="form-horizontal" method="post" action="{{route('admin.web_lengths.update',['web_length'=>$webLength->id])}}">
                    @csrf
                    @method('PATCH')
                    <div class="card-body">
                        @include('admin.zone_pz_province.zone_pz_province_edit')

                        <div class="form-group">
                            <label for="distributive_web_length" class=" control-label">طول شبکه توزیعی</label>
                            <input type="number" step="any" name="distributive_web_length" class="form-control" id="distributive_web_length" placeholder="مجموع طول شبکه توزیعی را وارد کنید" value="{{old('distributive_web_length',$webLength->distributive_web_length)}}">
                        </div>
                        <div class="form-group">
                            <label for="transitive_web_length" class=" control-label">طول شبکه انتقالی</label>
                            <input type="number" step="any" name="transitive_web_length" class="form-control" id="transitive_web_length" placeholder="مجموع طول شبکه انتقالی را وارد کنید" value="{{old('transitive_web_length',$webLength->transitive_web_length)}}">
                        </div>
                    </div>
                    <!-- /.card-body -->
                    <div class="card-footer">
                        <button type="submit" class="btn btn-info">ویرایش</button>
                        <a href="{{route('admin.web_lengths.index')}}" class="btn btn-default float-left">لغو</a>
                    </div>
                    <!-- /.card-footer -->
                </form>
            </div>
        </div>
    </div>

@endcomponent
