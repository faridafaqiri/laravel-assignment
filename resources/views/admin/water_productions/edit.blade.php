@component('admin.layouts.content
' , ['title' => 'ویرایش تولید آب'])
    @slot('breadcrumb')
        <li class="breadcrumb-item"><a href="{{route('admin.')}}">پنل مدیریت</a></li>
        <li class="breadcrumb-item "><a href="{{route('admin.water_productions.index')}}">تولید آب</a></li>
        <li class="breadcrumb-item active">ویرایش تولید آب </li>
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
                    <h3 class="card-title"> ویرایش تولید آب</h3>
                </div>
                <!-- /.card-header -->
                <!-- form start -->
                <form class="form-horizontal" method="post" action="{{route('admin.water_productions.update',['water_production'=>$waterProduction->id])}}">
                    @csrf
                    @method('PATCH')
                    <div class="card-body">
                        @include('admin.zone_pz_province.zone_pz_province_edit')
                        <div class="form-group">
                            <div class="row">
                                <div class="col-md-6">
                                    <label for="produce_water" class=" control-label">مقدار آب تولید شده</label>
                                    <input type="number" step="any" name="produce_water" class="form-control" id="produce_water" placeholder="مقدار آب تولید شده را به مترمکعب وارد کنید" value="{{old('produce_water',$waterProduction->produce_water)}}">
                                </div>
                                <div class="col-md-6">
                                    <label for="expense_of_oil" class=" control-label">مصارف روغنیات</label>
                                    <input type="number" step="any" name="expense_of_oil" class="form-control" id="expense_of_oil" placeholder="مصارف روغنیات را وارد کنید" value="{{old('expense_of_oil',$waterProduction->expense_of_oil)}}">
                                </div>
                            </div>
                        </div>

                        <div class="form-group">
                            <div class="row">
                                <div class="col-md-6">
                                    <label for="active_hours" class=" control-label">ساعات فعالیت پمپ ها توسط برق</label>
                                    <input type="number" step="any" name="active_hours" class="form-control" id="active_hours" placeholder="ساعات فعالیت پمپ ها توسط برق را وارد کنید" value="{{old('active_hours',$waterProduction->active_hours)}}">
                                </div>

                                <div class="col-md-6">
                                    <label for="produce_generator" class=" control-label">ساعات فعالیت پمپ ها توسط جنراتور</label>
                                    <input type="number" step="any" name="produce_generator" class="form-control" id="produce_generator" placeholder="ساعات فعالیت پمپ ها توسط جنراتور را وارد کنید" value="{{old('produce_generator',$waterProduction->produce_generator)}}">
                                </div>

                            </div>
                        </div>

                        <div class="form-group">
                            <div class="row">
                                <div class="col-md-6">
                                    <label for="expends" class=" control-label">هزینه تولید</label>
                                    <input type="number" step="any" name="expends" class="form-control" id="expends" placeholder="هزینه تولید را به افغانی وارد کنید" value="{{old('expends',$waterProduction->expends)}}">

                                </div>

                            </div>
                        </div>

                    </div>
                    <!-- /.card-body -->
                    <div class="card-footer">
                        <button type="submit" class="btn btn-info">ویرایش</button>
                        <a href="{{route('admin.water_productions.index')}}" class="btn btn-default float-left">لغو </a>
                    </div>
                    <!-- /.card-footer -->
                </form>
            </div>
        </div>
    </div>

@endcomponent
