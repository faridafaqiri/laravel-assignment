@component('admin.layouts.content
' , ['title' => 'نفوس تحت پوشش'])
    @slot('breadcrumb')
        <li class="breadcrumb-item"><a href="{{route('admin.')}}">پنل مدیریت</a></li>
        <li class="breadcrumb-item "><a href="{{route('admin.covered_populations.index')}}">نفوس تحت پوشش</a></li>
        <li class="breadcrumb-item active">ایجاد نفوس تحت پوشش </li>
    @endslot

   
    <div class="row">
        <div class="col-lg-12">
            @include('admin.layouts.errors')
            <div class="card card-info">
                <div class="card-header">
                    <h3 class="card-title">فرم ثبت نفوس تحت پوشش </h3>
                </div>
                <!-- /.card-header -->
                <!-- form start -->
                <form class="form-horizontal" method="post" action="{{route('admin.covered_populations.store')}}">
                    @csrf
                    <div class="card-body">

                        <div class="form-group">
                            <div class="row">
                                <div class="col-md-6">
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
                                <div class="col-md-6">
                                    <label for="population" class=" control-label">مجموع نفوس شهری</label>
                                    <input type="number" name="population" class="form-control" id="population" placeholder="مجموع نفوس شهری را وارد کنید" value="{{old('population')}}">
                                </div>
                            </div>
                        </div>


                        <div class="form-group">
                            <div class="row">
                                <div class='col-md-6'>
                                    <label for="year" class=" control-label">سال</label>
                                    <input type="number" name="year" class="form-control" id="year" placeholder="سال را وارد کنید" value="{{old('year')}}">
                                </div>
                                <div class="col-md-6">
                                    <label for="m_business" class=" control-label">ضریب نفوس مشترکین تجاری</label>
                                    <input type="number" name="m_business" class="form-control" id="m_business" placeholder="ضریب نفوس مشترکین تجاری را وارد کنید" value="{{old('m_business')}}">
                                </div>

                            </div>

                        </div>

                        <div class="form-group">
                            <div class="row">
                                <div class="col-md-6">
                                    <label for="m_residential" class=" control-label">ضریب نفوس مشترکین رهایشی</label>
                                    <input type="number" name="m_residential" class="form-control" id="m_residential" placeholder="ضریب نفوس مشترکین رهایشی را وارد کنید" value="{{old('m_residential')}}">
                                </div>
                                <div class="col-md-6">
                                    <label for="m_holyPlaces" class=" control-label">ضریب نفوس مشترکین اماکن مقدسه</label>
                                    <input type="number" name="m_holyPlaces" class="form-control" id="m_holyPlaces" placeholder="ضریب نفوس مشترکین اماکن مقدسه  را وارد کنید" value="{{old('m_holyPlaces')}}">
                                </div>

                            </div>
                        </div>

                        <div class="form-group">
                            <div class="row">
                                <div class='col-md-6'>
                                    <label for="m_public" class=" control-label">ضریب نفوس مشترکین عامه</label>
                                    <input type="number" name="m_public" class="form-control" id="m_public" placeholder="ضریب نفوس مشترکین عامه را وارد کنید" value="{{old('m_public')}}">
                                </div>
                                <div class="col-md-6">
                                    <label for="m_governmental" class=" control-label">ضریب نفوس مشترکین دولتی</label>
                                    <input type="number" name="m_governmental" class="form-control" id="m_governmental" placeholder="ضریب نفوس مشترکین دولتی را وارد کنید" value="{{old('m_governmental')}}">
                                </div>

                            </div>
                        </div>



                    </div>
                    <!-- /.card-body -->
                    <div class="card-footer">
                        <button type="submit" class="btn btn-info">ثبت</button>
                        <a href="{{route('admin.covered_populations.index')}}" class="btn btn-default float-left">لغو </a>
                    </div>
                    <!-- /.card-footer -->
                </form>
            </div>
        </div>
    </div>

@endcomponent
