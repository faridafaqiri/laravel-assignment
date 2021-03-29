@component('admin.layouts.content
' , ['title' => 'ثبت میتر خوانی'])
    @slot('breadcrumb')
        <li class="breadcrumb-item"><a href="{{route('admin.')}}">پنل مدیریت</a></li>
        <li class="breadcrumb-item "><a href="{{route('admin.meter_readings.index')}}"> میتر خوانی ها </a></li>
        <li class="breadcrumb-item active">ثبت  میتر خوانی ها</li>
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
                                $("#provincial_zone_id").append('<option>زون ولایتی را انتخاب کنید</option>');
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

            $('#provincial_zone_id').on('change',function(){
                var ProvincialZoneID = $(this).val();
                if(ProvincialZoneID){
                    $.ajax({
                        type:"GET",
                        url:"{{url('get-meter-reader-list')}}?provincial_zone_id="+ProvincialZoneID,
                        success:function(res){
                            if(res){
                                $("#meter_reader_id").empty();
                                $.each(res,function(key,value){
                                    $("#meter_reader_id").append('<option value="'+key+'">'+value+'</option>');
                                });

                            }else{
                                $("#meter_reader_id").empty();
                            }
                        }
                    });
                }else{
                    $("#meter_reader_id").empty();
                }

            });

        </script>
    @endslot

    <div class="row">
        <div class="col-lg-12">
            @include('admin.layouts.errors')
            <div class="card card-info">
                <div class="card-header">
                    <h3 class="card-title"> ثبت  میتر خوانی </h3>
                </div>
                <!-- /.card-header -->
                <!-- form start -->
                <form class="form-horizontal" method="post" action="{{route('admin.meter_readings.store')}}">
                    @csrf
                    <div class="card-body">

                        @include('admin.zone_pz_province.zone_pz_province_create')

                        <div class="form-group">
                            <div class="form-group">
                                <div class="row">
                                    <div class="col-md-6">
                                        <label for="total_read" class=" control-label">تعداد میتر های خوانده شده</label>
                                        <input type="number" name="total_read" class="form-control" id="total_read" placeholder="تعداد میتر های خوانده شده را وارد کنید" value="{{old('total_read')}}">
                                    </div>
                                    <div class="col-md-6">
                                        <label for="meter_reader_id" class=" control-label">نام میترخوان</label>
                                        <select class="form-control" name="meter_reader_id" id="meter_reader_id"></select>
                                    </div>
                                </div>

                            </div>
                        </div>

                    </div>

                    <!-- /.card-body -->
                    <div class="card-footer">
                        <button type="submit" class="btn btn-info">ثبت</button>
                        <a href="{{route('admin.meter_readings.index')}}" class="btn btn-default float-left">لغو </a>
                    </div>
                    <!-- /.card-footer -->
                </form>
            </div>
        </div>
    </div>

@endcomponent
