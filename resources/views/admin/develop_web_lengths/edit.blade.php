@component('admin.layouts.content
' , ['title' => 'ویرایش  طول توسعه شبکه'])
    @slot('breadcrumb')
        <li class="breadcrumb-item"><a href="{{route('admin.')}}">پنل مدیریت</a></li>
        <li class="breadcrumb-item "><a href="{{route('admin.web_lengths.index')}}">طول توسعه شبکه</a></li>
        <li class="breadcrumb-item active">طول توسعه شبکه شبکه </li>
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
                    <h3 class="card-title">ویرایش طول توسعه شبکه</h3>
                </div>
                <!-- /.card-header -->
                <!-- form start -->
                <form class="form-horizontal" method="post" action="{{route('admin.develop_web_lengths.update',['develop_web_length'=>$developWebLength->id])}}">
                    @csrf
                    @method('PATCH')
                    <div class="card-body">
                        @include('admin.zone_pz_province.zone_pz_province_edit')

                        <div class="form-group">
                            <label for="develop_distributive_web_length" class=" control-label">طول توسعه شبکه توزیعی</label>
                            <input type="number" name="develop_distributive_web_length" class="form-control" id="develop_distributive_web_length" step="any" placeholder="مجموع طول شبکه توزیعی را وارد کنید" value="{{old('develop_distributive_web_length',$developWebLength->develop_distributive_web_length)}}">
                        </div>
                        <div class="form-group">
                            <label for="develop_transitive_web_length" class=" control-label">طول توسعه شبکه انتقالی</label>
                            <input type="number" name="develop_transitive_web_length" step="any" class="form-control" id="develop_transitive_web_length" placeholder="مجموع طول شبکه انتقالی را وارد کنید" value="{{old('develop_transitive_web_length',$developWebLength->develop_transitive_web_length)}}">
                        </div>
                    </div>
                    <!-- /.card-body -->
                    <div class="card-footer">
                        <button type="submit" class="btn btn-info">ویرایش</button>
                        <a href="{{route('admin.develop_web_lengths.index')}}" class="btn btn-default float-left">لغو</a>
                    </div>
                    <!-- /.card-footer -->
                </form>
            </div>
        </div>
    </div>

@endcomponent
