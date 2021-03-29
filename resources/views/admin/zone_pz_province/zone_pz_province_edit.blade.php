<div class="from-group">
    <div class="row">
        <div class="col-md-4">
            <label for="zone_id" class=" control-label">زون را انتخاب کنید</label>
            <select class="form-control" name="zone_id" id="zone_id">
                <option>زون را انتخاب کنید</option>
                @foreach($zones as $key=>$zone)
                    @if(old('zone_id')==$key)
                        <option value="{{$key}}" selected>{{$zone}}</option>
                    @else
                        <option value="{{$key}}">{{$zone}}</option>
                    @endif
                @endforeach

            </select>
        </div>

        <div class="col-md-4">
            <label for="province_id" class=" control-label">ولایت را انتخاب کنید</label>
            <select class="form-control" name="province_id" id="province_id" >
                @if(Request::old('province_id') != NULL)
                    <option value="{{Request::old('province_id')}}">
                        {{\App\Province::where('id', intval(Request::old('province_id')))->first()->name}}
                    </option>
                @endif
            </select>
        </div>
        <div class="col-md-4">
            <label for="provincial_zone_id" class=" control-label">زون ولایتی را انتخاب کنید</label>
            <select class="form-control" name="provincial_zone_id" id="provincial_zone_id" >
                @if(Request::old('provincial_zone_id') != NULL)
                    <option value="{{Request::old('provincial_zone_id')}}">{{\App\ProvincialZone::where('id', intval(Request::old('provincial_zone_id')))->first()->name}}</option>
                @endif
            </select>
        </div>

    </div>

</div>
