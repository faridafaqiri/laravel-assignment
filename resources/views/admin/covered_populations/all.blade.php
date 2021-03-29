@component('admin.layouts.content' , ['title' => 'نفوس تحت پوشش'])
    @slot('breadcrumb')
        <li class="breadcrumb-item"><a href="{{route('admin.')}}">پنل مدیریت</a></li>
        <li class="breadcrumb-item active">نفوس تحت پوشش</li>
    @endslot

    <div class="row">
        <div class="col-12">
            <div class="card">
                <div class="card-header">
                    <h3 class="card-title">نفوس تحت پوشش</h3>
                    <div class="card-tools d-flex">
                        <div class="btn-group-sm mr-1">
                            @can('create-covered-population')
                                <a href="{{route('admin.covered_populations.create')}}" class="btn btn-info">ایجاد نفوس تحت پوشش</a>
                            @endcan

                        </div>
                    </div>
                </div>
                <!-- /.card-header -->
                <div class="card-body table-responsive-md p-0">
                    @if(count($covered_populations) > 0)
                    <table class="table table-hover">
                        <tbody>


                        <tr>
                            <th>#</th>
                            <th>زون</th>
                            <th>مجموع نفوس شهری</th>
                            <th>سال</th>
                            <th>تجاری</th>
                            <th>رهایشی</th>
                            <th>اماکن مقدسه</th>
                            <th>عامه</th>
                            <th>دولتی</th>
                            <th>تاریخ ثبت</th>
                            <th>تنظیمات</th>
                        </tr>

                        <?php $i=1; ?>
                      @foreach($covered_populations as $covered_population)
                          
                          <tr>
                              <td>{{$i++}}</td>
                              <td>{{$covered_population->zone->name}}</td>
                              <td>{{$covered_population->population}}</td>
                              <td>{{$covered_population->year}}</td>
                              <td>{{$covered_population->m_business}}</td>
                              <td>{{$covered_population->m_residential}}</td>
                              <td>{{$covered_population->m_holyPlaces}}</td>
                              <td>{{$covered_population->m_public}}</td>
                              <td>{{$covered_population->m_governmental}}</td>
                              <td>{{jdate($covered_population->created_at)->format('%A, %d %B %y')}}</td>

                              <td class="d-flex ">

                                  <div class="btn-group">
                                      <button type="button" class="btn btn-info btn-sm dropdown-toggle" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                          تنظیمات
                                      </button>
                                      <div class="dropdown-menu">

                                          @can('edit-covered-population')
                                              <a href="{{route('admin.covered_populations.edit',$covered_population->id)}}" class="dropdown-item">ویرایش</a>

                                          @endcan


                                              <a href="{{route('admin.covered_populations.show',$covered_population->id)}}" class="dropdown-item">جزییات</a>

                                          @can('delete-covered-population')
                                              <form action="{{route('admin.covered_populations.destroy',$covered_population->id)}}" method="POST">
                                                  @csrf
                                                  @method('DELETE')
                                                  <button type="submit" class="dropdown-item">حذف</button>
                                              </form>
                                          @endcan

                                      </div>
                                  </div>

                              </td>
                          </tr>
                       
                      @endforeach
                        </tbody>
                    </table>
                    @else
                    <p class="alert alert-secondary">هیچ دیتایی وجود ندارد</p>
                    @endif
                </div>
                <!-- /.card-body -->
                <div class="card-footer">
                    {{$covered_populations->render()}}
                </div>
            </div>
            <!-- /.card -->
        </div>
    </div>

@endcomponent
