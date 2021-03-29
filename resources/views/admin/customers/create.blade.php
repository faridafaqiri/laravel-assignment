@component('admin.layouts.content
' , ['title' => ' مشترکین'])
    @slot('breadcrumb')
        <li class="breadcrumb-item"><a href="{{route('admin.')}}">پنل مدیریت</a></li>
        <li class="breadcrumb-item "><a href="{{route('admin.customers.index')}}">تعداد مشترکین</a></li>
        <li class="breadcrumb-item active">ایجاد مشترکین </li>
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
                    <h3 class="card-title">فرم ثبت مشترکین </h3>
                </div>
                <!-- /.card-header -->
                <!-- form start -->
                <form class="form-horizontal" method="post" action="{{route('admin.customers.store')}}">
                    @csrf
                    <div class="card-body">
                        @include('admin.zone_pz_province.zone_pz_province_edit')

                        <div class="form-group">
                            <div class="row">
                                <div class="col-md-6">
                                    <label for="faucet_type" class=" control-label">نوع نل مشترکین</label>
                                    <select class="form-control" name="faucet_type" id="faucet_type" >
                                        <option value="1">میتری</option>
                                        <option value="0">عددی</option>
                                    </select>
                                </div>
                                <div class="col-md-6">
                                    <label for="old_new" class=" control-label">سابقه/جدید</label>
                                    <select class="form-control" name="old_new" id="old_new" >
                                        <option value="1">جدید</option>
                                        <option value="0">سابقه</option>
                                    </select>
                                </div>

                            </div>

                        </div>

                        <div class="form-group">
                            <div class="row">
                                <div class="col-md-6">
                                    <label for="business" class=" control-label">تعداد مشترکین تجاری</label>
                                    <input type="number" name="business" class="form-control" id="business" placeholder="تعداد مشترکین تجاری  را وارد کنید" value="{{old('business')}}">
                                </div>
                                <div class="col-md-6">
                                    <label for="residential" class=" control-label">تعداد مشترکین رهایشی</label>
                                    <input type="number" name="residential" class="form-control" id="residential" placeholder="تعداد مشترکین رهایشی  را وارد کنید" value="{{old('residential')}}">
                                </div>
                            </div>

                        </div>

                        <div class="form-group">
                            <div class="row">
                                <div class="col-md-6">
                                    <label for="holy_places" class=" control-label">تعداد مشترکین اماکن مقدسه</label>
                                    <input type="number" name="holy_places" class="form-control" id="holy_places" placeholder="تعداد مشترکین اماکن مقدسه  را وارد کنید" value="{{old('holy_places')}}">
                                </div>
                                <div class='col-md-6'>
                                    <label for="public_places" class=" control-label">تعداد مشترکین عامه</label>
                                    <input type="number" name="public_places" class="form-control" id="public_places" placeholder="تعداد مشترکین عامه را وارد کنید" value="{{old('public_places')}}">
                                </div>
                            </div>
                        </div>

                        <div class="form-group">
                            <div class="row">
                                <div class="col-md-6">
                                    <label for="governmental" class=" control-label">تعداد مشترکین دولتی</label>
                                    <input type="number" name="governmental" class="form-control" id="governmental" placeholder="تعداد مشترکین دولتی را وارد کنید" value="{{old('governmental')}}">
                                </div>
                                <div class='col-md-6'>
                                    <label for="unknown" class=" control-label">تعداد مشترکین لادرک(گمشده)</label>
                                    <input type="number" name="unknown" class="form-control" id="unknown" placeholder="تعداد مشترکین لادرک(گمشده) را وارد کنید" value="{{old('unknown')}}">
                                </div>
                            </div>
                        </div>
                    </div>
                    <!-- /.card-body -->
                    <div class="card-footer">
                        <button type="submit" class="btn btn-info">ثبت</button>
                        <a href="{{route('admin.customers.index')}}" class="btn btn-default float-left">لغو </a>
                    </div>
                    <!-- /.card-footer -->
                </form>
            </div>
        </div>
    </div>

@endcomponent
