@component('admin.layouts.content
' , ['title' => ' تبدیلی نل مشترکین'])
    @slot('breadcrumb')
        <li class="breadcrumb-item"><a href="{{route('admin.')}}">پنل مدیریت</a></li>
        <li class="breadcrumb-item "><a href="{{route('admin.faucet_changes.index')}}"> تبدیلی نل مشترکین </a></li>
        <li class="breadcrumb-item active">ثبت تبدیلی نل مشترکین</li>
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


            /*-----------------------------------*/

        </script>
    @endslot

    @section('calculate_customer')

        <script>
            $('.form-group').on('input','.customer',function (){
                var totalCustomer=0;
                $('.form-group .customer').each(function (){
                    var inputVal=$(this).val();
                    if($.isNumeric(inputVal)){
                        totalCustomer+=parseInt(inputVal);
                    }
                });
                $('#total').val(totalCustomer);
            });
        </script>
    @endsection

    <div class="row">
        <div class="col-lg-12">
            @include('admin.layouts.errors')
            <div class="card card-info">
                <div class="card-header">
                    <h3 class="card-title">ثبت  تبدیلی نل مشترکین</h3>
                </div>
                <!-- /.card-header -->
                <!-- form start -->
                <form class="form-horizontal" method="post" action="{{route('admin.faucet_changes.store')}}">
                    @csrf
                    <div class="card-body">
                        @include('admin.zone_pz_province.zone_pz_province_create')
                        <div class="form-group">
                            <div class="row">

                                <div class='col-md-6'>
                                    <label for="public_places" class=" control-label">تعداد  نل های تبدیل شده مشترکین عامه</label>
                                    <input type="number" name="public_places" class="form-control customer" id="public_places" placeholder="تعداد  نل های تبدیل شده مشترکین عامه را وارد کنید" value="{{old('public_places')}}">
                                </div>

                                <div class="col-md-6">
                                    <label for="governmental" class=" control-label">تعداد نل های تبدیل شده مشترکین دولتی</label>
                                    <input type="number" name="governmental" class="form-control customer" id="governmental" placeholder="تعداد نل های تبدیل شده مشترکین دولتی را وارد کنید" value="{{old('governmental')}}">
                                </div>
                            </div>
                        </div>
                        <div class="form-group">
                            <div class="row">
                                <div class="col-md-6">
                                    <label for="business" class=" control-label">تعداد نل های تبدیل شده مشترکین تجاری</label>
                                    <input type="number" name="business" class="form-control customer" id="business" placeholder="تعداد نل های تبدیل شده مشترکین تجاری  را وارد کنید" value="{{old('business')}}">
                                </div>
                                <div class="col-md-6">
                                    <label for="residential" class=" control-label">تعداد نل های تبدیل شده مشترکین رهایشی</label>
                                    <input type="number" name="residential" class="form-control customer" id="residential" placeholder="تعداد  نل های تبدیل شده مشترکین رهایشی  را وارد کنید" value="{{old('residential')}}">
                                </div>
                            </div>
                        </div>

                        <div class="form-group">
                            <div class="row">
                                <div class="col-md-6">
                                    <label for="holy_places" class=" control-label">تعداد  نل های تبدیل شده مشترکین اماکن مقدسه</label>
                                    <input type="number" name="holy_places" class="form-control customer" id="holy_places" placeholder="تعداد  نل های تبدیل شده مشترکین اماکن مقدسه  را وارد کنید" value="{{old('holy_places')}}">
                                </div>

                                <div class="col-md-6">
                                    <label for="total" class=" control-label">تعداد نل های تبدیل شده</label>
                                    <input type="number" name="total" class="form-control" id="total" placeholder="تعداد نل های تبدیلی شده به میتری را وارد کنید" value="{{old('total')}}">

                                </div>
                            </div>
                        </div>
                    </div>
                    <!-- /.card-body -->
                    <div class="card-footer">
                        <button type="submit" class="btn btn-info">ثبت</button>
                        <a href="{{route('admin.faucet_changes.index')}}" class="btn btn-default float-left">لغو </a>
                    </div>
                    <!-- /.card-footer -->
                </form>
            </div>
        </div>
    </div>

@endcomponent
