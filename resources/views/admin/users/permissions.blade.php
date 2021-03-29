@component('admin.layouts.content
' , ['title' => 'ثبت دسترسی'])
    @slot('breadcrumb')
        <li class="breadcrumb-item"><a href="{{route('admin.')}}">پنل مدیریت</a></li>
        <li class="breadcrumb-item "><a href="{{route('admin.users.index')}}">لیست کاربران</a></li>
        <li class="breadcrumb-item active">ثبت دسترسی</li>
    @endslot

    @slot('script')

        <script>
            $('#roles').select2({
                'placeholder':'مقام مورد نظر را انتخاب کنید'
            });
            $('#permissions').select2({
                'placeholder':'دسترسی مورد نظر را انتخاب کنید'
            });

            $('#selectedProvincialZones').select2({
                'placeholder':'زون ولایتی مورد نظر را انتخاب کنید'
            });

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
                    $('#provincialZones').empty();
                }
            });

            var select_pz=[];
            $('#province_id').on('change',function(){
                var ProvinceID = $(this).val();

                if(ProvinceID){
                    $.ajax({
                        type:"GET",
                        url:"{{url('get-provincial-zone-list-for-role')}}?province_id="+ProvinceID,
                        success:function(res){
                            if(res){

                                $("#provincialZones").empty();
                                $("#provincialZones").append( '<option value="">زون ولایتی را انتخاب کنید</option>');
                                $.each(res,function(key,value){

                                   $("#provincialZones").append( '<option value="'+key+'">'+value+'</option>');

                                });

                            }else{
                                $("#provincialZones").empty();
                            }
                        }
                    });
                }else{
                    $("#provincialZones").empty();
                }

            });
            
            $('#provincialZones').on('change',function(){
                var text = $('#provincialZones option:selected').text();
                var value = $('#provincialZones option:selected').val()
                $("#selectedProvincialZones").append( '<option value="'+value+'" selected>'+text+'</option>');
                $('#selectedProvincialZones').select2().trigger('change');
            });


        </script>

    @endslot
    <div class="row">
        <div class="col-lg-12">
            @include('admin.layouts.errors')
            <div class="card card-info">
                <div class="card-header">
                    <h3 class="card-title">فرم ثبت دسترسی </h3>
                </div>
                <!-- /.card-header -->
                <!-- form start -->
                <form class="form-horizontal" method="post" action="{{route('admin.users.permissions.store',$user->id)}}">
                    @csrf
                    <div class="card-body">
                        <div class="from-group">
                            <label for="roles" class=" control-label">مقام ها</label>
                            <select class="form-control" name="roles[]" id="roles" multiple>
                                @foreach(\App\Role::all() as $role)
                                    <option value="{{$role->id}}" {{in_array($role->id,$user->roles->pluck('id')->toArray()) ? 'selected' : ''}}>{{$role->name}}-{{$role->label}}</option>
                                @endforeach
                            </select>
                        </div>

                        <!--<div class="from-group">
                            <label for="permissions" class=" control-label">دسترسی ها</label>
                            <select class="form-control" name="permissions[]" id="permissions" multiple>
                                @foreach(\App\Permission::all() as $permission)
                                    <option value="{{$permission->id}}" {{in_array($permission->id,$user->permissions->pluck('id')->toArray()) ? 'selected' : ''}}>{{$permission->name}}-{{$permission->label}}</option>
                                @endforeach
                            </select>
                        </div>-->

                        <div class="from-group">
                            <div class="row">
                                <div class="col-md-4">
                                    <label for="zone_id" class=" control-label">زون را انتخاب کنید</label>
                                    <select class="form-control" name="zone_id" id="zone_id">
                                        <option>زون را انتخاب کنید</option>
                                        @foreach($zones as $key=>$zone)
                                            <option value="{{$key}}">{{$zone}}</option>
                                        @endforeach
                                    </select>
                                </div>
                                <div class="col-md-4">
                                    <label for="province_id" class=" control-label">ولایت را انتخاب کنید</label>
                                    <select class="form-control" name="province_id" id="province_id"></select>
                                </div>
                                <div class="col-md-4">
                                    <label for="provincialZones" class=" control-label">زون ولایتی را انتخاب کنید</label>
                                    <select class="form-control" name="provincialZones" id="provincialZones"></select>
                                </div>

                            </div>
                        </div>
                        
                        <div class="form-group">
                            <div class="row">
                                <label for="selectedProvincialZones" class=" control-label">زون ولایتی را انتخاب کنید</label>
                                <select class="form-control provincialZones" name="selectedProvincialZones[]" id="selectedProvincialZones" multiple>
                                    @foreach($user->provincialZones->all() as $provincialZone)
                                        <option value='{{$provincialZone->id}}' selected="selected" >{{$provincialZone->name}}</option>
                                    @endforeach
                                </select>
                            </div>
                        </div>
                        
                    </div>
                    <!-- /.card-body -->
                    <div class="card-footer">
                        <button type="submit" class="btn btn-info">ثبت مقام</button>
                        <a href="{{route('admin.roles.index')}}" class="btn btn-default float-left">لغو مقام</a>
                    </div>
                    <!-- /.card-footer -->
                </form>
            </div>
        </div>
    </div>

@endcomponent
