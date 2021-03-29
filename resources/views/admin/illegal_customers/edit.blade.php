@component('admin.layouts.content
' , ['title' => ' مشترکین غیرقانونی'])
    @slot('breadcrumb')
        <li class="breadcrumb-item"><a href="{{route('admin.')}}">پنل مدیریت</a></li>
        <li class="breadcrumb-item "><a href="{{route('admin.illegal_customers.index')}}"> مشترکین غیرقانونی </a></li>
        <li class="breadcrumb-item active">ویرایش مشترکین غیرقانونی</li>
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


            $(document).ready(function (){

                $('#systemRegister').hide();
                $('#register').show();

                $('.dropdown').change(function (){
                    if($('.dropdown').val()==0){
                        $('#systemRegister').hide();
                        $('#register').show();
                    }else{
                        $('#systemRegister').show();
                        $('#register').hide();
                    }

                });

            });
        </script>
    @endslot
    <div class="row">
        <div class="col-lg-12">
            @include('admin.layouts.errors')
            <div class="card card-info">
                <div class="card-header">
                    <h3 class="card-title"> ویرایش مشترکین غیرقانونی </h3>
                </div>
                <!-- /.card-header -->
                <!-- form start -->
                <form class="form-horizontal" method="post" action="{{route('admin.illegal_customers.update',['illegal_customer'=>$illegalCustomer->id])}}">
                    @csrf
                    @method('PATCH')
                    <div class="card-body">
                        @include('admin.zone_pz_province.zone_pz_province_edit')
                        <div class="form-group">
                            <div class="row">
                                <div class="col-md-6">
                                    <label for="total" class=" control-label">تعداد مشترکین غیرقانونی</label>
                                    <input type="number" name="total" class="form-control" id="total" placeholder="تعداد مشترکین غیرقانونی را وارد کنید" value="{{old('total',$illegalCustomer->total)}}">
                                </div>
                                <div class="col-md-6">
                                    <label for="action">واکنش</label>
                                    <select class="form-control dropdown" name="action" id="action">
                                        <option value="0" {{$illegalCustomer->action=='0' ? 'selected':''}}>قطع نل</option>
                                        <option value="1" {{$illegalCustomer->action=='1' ? 'selected':''}}>ثبت سیستم</option>
                                    </select>
                                </div>
                            </div>
                        </div>

                    </div>

                    <!-- /.card-body -->
                    <div class="card-footer">
                        <button type="submit" class="btn btn-info" name="register" value="register" id="register">ویرایش</button>
                        <button type="submit" name="register" value="system_register" class="btn btn-info" id="systemRegister">ثبت سیستم </button>
                        <a href="{{route('admin.illegal_customers.index')}}" class="btn btn-default float-left" >لغو </a>
                    </div>
                    <!-- /.card-footer -->
                </form>
            </div>
        </div>
    </div>

@endcomponent
