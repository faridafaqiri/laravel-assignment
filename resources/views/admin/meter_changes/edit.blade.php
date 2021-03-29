@component('admin.layouts.content
' , ['title' => 'ثبت میترهای تعویض شده'])
    @slot('breadcrumb')
        <li class="breadcrumb-item"><a href="{{route('admin.')}}">پنل مدیریت</a></li>
        <li class="breadcrumb-item "><a href="{{route('admin.meter_changes.index')}}">ویرایش میترهای تعویض شده</a></li>
        <li class="breadcrumb-item active">ویرایش میترهای تعویض شده</li>
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
                    <h3 class="card-title">ویرایش میترهای تعویض شده</h3>
                </div>
                <!-- /.card-header -->
                <!-- form start -->
                <form class="form-horizontal" method="post" action="{{route('admin.meter_changes.update',['meter_change'=>$meterChange->id])}}">
                    @csrf
                    @method('PATCH')
                    <div class="card-body">
                        @include('admin.zone_pz_province.zone_pz_province_edit')

                        <div class="form-group">
                            <div class="row">
                                <div class="col-md-6">
                                    <label for="total" class=" control-label">تعداد میتر های تعویض شده</label>
                                    <input type="number" name="total" class="form-control" id="total" placeholder="تعداد میتر های تعویض شده را وارد کنید" value="{{old('total',$meterChange->total)}}">
                                </div>
                                <div class="col-md-6">
                                    <label for="type" class=" control-label">نوع میتر های تعویض شده</label>
                                    <select name="type" id="type" class="form-control">
                                        <option value="distributive" {{$meterChange->type=='distributive' ? 'selected' : ''}}>توزیعی</option>
                                        <option value="transitive" {{$meterChange->type=='transitive' ? 'selected' : ''}}>میتر مشترک</option>
                                        <option value="productive" {{$meterChange->type=='productive' ? 'selected':''}}>بالک میتر</option>
                                    </select>
                                </div>
                            </div>

                        </div>
                    </div>
                    <!-- /.card-body -->
                    <div class="card-footer">
                        <button type="submit" class="btn btn-info">ویرایش</button>
                        <a href="{{route('admin.meter_changes.index')}}" class="btn btn-default float-left">لغو </a>
                    </div>
                    <!-- /.card-footer -->
                </form>
            </div>
        </div>
    </div>

@endcomponent