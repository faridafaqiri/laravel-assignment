@component('admin.layouts.content
' , ['title' => 'ایجاد پاک کاری ذخیره'])
    @slot('breadcrumb')
        <li class="breadcrumb-item"><a href="{{route('admin.')}}">پنل مدیریت</a></li>
        <li class="breadcrumb-item "><a href="{{route('admin.storage_cleans.index')}}">همه  پاک کاری ذخیره </a></li>
        <li class="breadcrumb-item active">ایجاد پاک کاری ذخیره</li>
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
                    <h3 class="card-title">فرم ایجاد پاک کاری ذخیره </h3>
                </div>
                <!-- /.card-header -->
                <!-- form start -->
                <form class="form-horizontal" method="post" action="{{route('admin.storage_cleans.store')}}">
                    @csrf
                    <div class="card-body">
                        @include('admin.zone_pz_province.zone_pz_province_create')
                        <div class="form-group">
                            <div class="row">
                                <div class="col-md-6">
                                    <label for="count" class="control-label">تعداد ذخایر پاک شده</label>
                                    <input type="number" name="count" id="count" class="form-control" placeholder="تعداد ذخایر پاک شده را وارد کنید" value="{{old('count')}}">
                                </div>
                                <div class="col-md-6">
                                    <label for="chlorine_amount" class=" control-label">مقدار کلورین</label>
                                    <input type="number" step="any" name="chlorine_amount" class="form-control" id="chlorine_amount" placeholder="مقدار کلورین را وارد کنید" value="{{old('chlorine_amount')}}">
                                </div>
                            </div>
                        </div>
                        <div class="form-group">
                            <div class="row">
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label for="chlorine_type" class=" control-label">نوعیت کلورین</label>
                                        <select class="form-control" name="chlorine_type" id="chlorine_type">
                                            <option value="1">مایع</option>
                                            <option value="0">جامد</option>
                                        </select>
                                    </div>
                                </div>
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label for="unite" class=" control-label">واحد</label>
                                        <select class="form-control" name="unite" id="unite">
                                            <option value="1">لیتر</option>
                                            <option value="0">کیلوگرام</option>
                                        </select>
                                    </div>
                                </div>
                            </div>
                        </div>

                    </div>

                    <!-- /.card-body -->
                    <div class="card-footer">
                        <button type="submit" class="btn btn-info">ثبت</button>
                        <a href="{{route('admin.storage_cleans.index')}}" class="btn btn-default float-left">لغو </a>
                    </div>
                    <!-- /.card-footer -->
                </form>
            </div>
        </div>
    </div>

@endcomponent
