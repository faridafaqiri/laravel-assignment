@component('admin.layouts.content
' , ['title' => 'پمپ های خراب شده'])
    @slot('breadcrumb')
        <li class="breadcrumb-item"><a href="{{route('admin.')}}">پنل مدیریت</a></li>
        <li class="breadcrumb-item "><a href="{{route('admin.impaired_pumps.index')}}">پمپ های خراب شده</a></li>
        <li class="breadcrumb-item active">ثبت پمپ های خراب شده</li>
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
                    <h3 class="card-title">ثبت پمپ های خراب شده</h3>
                </div>
                <!-- /.card-header -->
                <!-- form start -->
                <form class="form-horizontal" method="post" action="{{route('admin.impaired_pumps.store')}}">
                    @csrf
                    <div class="card-body">

                        @include('admin.zone_pz_province.zone_pz_province_create')

                        <div class="form-group">
                            <div class="row">
                                <div class="col-md-6">
                                    <label for="total_impaired" class=" control-label">تعداد پمپ</label>
                                    <input type="number" id="total_impaired" name="total_impaired" placeholder="تعداد پمپ های خراب شده را وارد کنید." class="form-control">
                                </div>
                                <div class="col-md-6">
                                    <label for="fixed" class=" control-label">ترمیم شده</label>
                                    <select name="fixed" id="fixed" class="form-control">
                                        <option value="1">بلی</option>
                                        <option value="0">نخیر</option>
                                    </select>
                                </div>
                            </div>
                        </div>
                        <div class="form-group">
                            <label for="reason" class="control-label">دلیل خرابی</label>
                            <textarea name="reason" id="reason" cols="30" rows="5" placeholder="مطلب مورد نظر خود را وارد کنید" class="form-control">{{old('reason')}}</textarea>
                        </div>

                    </div>
                    <!-- /.card-body -->
                    <div class="card-footer">
                        <button type="submit" class="btn btn-info">ثبت</button>
                        <a href="{{route('admin.impaired_pumps.index')}}" class="btn btn-default float-left">لغو </a>
                    </div>
                    <!-- /.card-footer -->
                </form>
            </div>
        </div>
    </div>


@endcomponent
