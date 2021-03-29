@component('admin.layouts.content
' , ['title' => 'ثبت قطر نل مشترکین'])
    @slot('breadcrumb')
        <li class="breadcrumb-item"><a href="{{route('admin.')}}">پنل مدیریت</a></li>
        <li class="breadcrumb-item "><a href="{{route('admin.faucet_diameter_customers.index')}}"> قطر نل مشترکین</a></li>
        <li class="breadcrumb-item active">ثبت قطر نل مشترکین </li>
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
                    <h3 class="card-title"> ثبت قطر نل مشترکین  </h3>
                </div>
                <!-- /.card-header -->
                <!-- form start -->
                <form class="form-horizontal" method="post" action="{{route('admin.faucet_diameter_customers.store')}}">
                    @csrf
                    <div class="card-body">

                        @include('admin.zone_pz_province.zone_pz_province_create')

                        <div class="form-group">
                            <div class="row">
                                <label for="half" class=" control-label">تعداد نل های نیم اینچ</label>
                                <input type="number" name="half" class="form-control" id="half" placeholder="تعداد نل های نیم اینچ را وارد کنید" value="{{old('half')}}">
                            </div>
                        </div>

                        <div class="form-group">
                            <div class="row">
                                <div class="col-md-6">
                                    <label for="one" class=" control-label">تعداد نل های یک اینچ</label>
                                    <input type="number" name="one" class="form-control" id="one" placeholder="تعداد نل های یک اینچ را وارد کنید" value="{{old('one')}}">
                                </div>
                                <div class="col-md-6">
                                    <label for="three_quarter" class=" control-label">تعداد نل های ۳/۴ اینچ </label>
                                    <input type="number" name="three_quarter" class="form-control" id="three_quarter" placeholder="تعداد نل های ۳/۴ اینچ را وارد کنید" value="{{old('three_quarter')}}">
                                </div>
                            </div>

                        </div>

                    </div>
                    <!-- /.card-body -->
                    <div class="card-footer">
                        <button type="submit" class="btn btn-info">ثبت</button>
                        <a href="{{route('admin.faucet_diameter_customers.index')}}" class="btn btn-default float-left">لغو </a>
                    </div>
                    <!-- /.card-footer -->
                </form>
            </div>
        </div>
    </div>

@endcomponent
