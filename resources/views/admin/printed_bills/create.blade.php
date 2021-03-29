@component('admin.layouts.content
' , ['title' => 'ثبت بل های چاپ شده'])
    @slot('breadcrumb')
        <li class="breadcrumb-item"><a href="{{route('admin.')}}">پنل مدیریت</a></li>
        <li class="breadcrumb-item "><a href="{{route('admin.printed_bills.index')}}"> بل های چاپ شده </a></li>
        <li class="breadcrumb-item active">ثبت بل های چاپ شده</li>
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

            $('#type').change(function() {
                if( $(this).val() == 1) {
                    $('#total_water_amount').prop( "disabled", false );
                } else {
                    $('#total_water_amount').prop( "disabled", true );
                }
            });
        </script>
    @endslot

<div class="row">
        <div class="col-lg-12">
            @include('admin.layouts.errors')
            <div class="card card-info">
                <div class="card-header">
                    <h3 class="card-title"> ثبت بل های چاپ شده </h3>
                </div>
                <!-- /.card-header -->
                <!-- form start -->
                <form class="form-horizontal" method="post" action="{{route('admin.printed_bills.store')}}">
                    @csrf
                    <div class="card-body">
                        @include('admin.zone_pz_province.zone_pz_province_create')
                        <div class="form-group">
                            <div class="row">
                                <div class="col-md-6">
                                    <label for="type" class="control-label">نوع نل</label>
                                    <select class="form-control" name="type" id="type">
                                        <option value="1">میتری</option>
                                        <option value="0">عددی</option>
                                    </select>
                                </div>
                                <div class="col-md-6">
                                    <label for="total_printed" class=" control-label">تعداد بل های چاپ شده</label>
                                    <input type="number" name="total_printed" class="form-control" id="total_printed" placeholder=" تعداد بل های چاپ شده را وارد کنید" value="{{old('total_printed')}}">
                                </div>
                            </div>
                        </div>
                        <div class="form-group">
                            <div class="row">
                                <div class="col-md-6">
                                    <label for="total_water_amount" class=" control-label">مقدار آب بل شده</label>
                                    <input type="number" name="total_water_amount" class="form-control" id="total_water_amount" placeholder="مقدار آب بل شده را به متر مکعب وارد کنید" value="{{old('total_water_amount')}}">
                                </div>
                                <div class="col-md-6">
                                    <label for="total_price" class=" control-label">مقدار پول تمام بل ها</label>
                                    <input type="number" name="total_price" class="form-control" id="total_price" placeholder="مقدار پول بل ها را وارد کنید" value="{{old('total_price')}}">
                                </div>
                            </div>
                        </div>
                        <div class="form-group">
                            <div class="form-group">
                                <div class="row">

                                        <label for="reprinted" class=" control-label">چاپ دوباره</label>
                                        <select class="form-control" name="reprinted" id="reprinted">
                                            <option value="0">نخیر</option>
                                            <option value="1">بلی</option>
                                        </select>


                                </div>

                            </div>
                        </div>

                        <div class="form-group">
                            <div class="row">
                                <label class="control-label" for="description">توضیحات</label>
                                <textarea class="form-control" id="description" rows="7" cols="30" name="description" placeholder="توضیحات را وارد کنید">{{old('description')}}</textarea>
                            </div>
                        </div>
                    </div>
                    <!-- /.card-body -->
                    <div class="card-footer">
                        <button type="submit" class="btn btn-info">ثبت</button>
                        <a href="{{route('admin.printed_bills.index')}}" class="btn btn-default float-left">لغو </a>
                    </div>
                    <!-- /.card-footer -->
                </form>
            </div>
        </div>
    </div>

@endcomponent
