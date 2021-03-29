@component('admin.layouts.content' , ['title' => 'طول شبکه'])
    @slot('breadcrumb')
        <li class="breadcrumb-item"><a href="{{route('admin.')}}">پنل مدیریت</a></li>
        <li class="breadcrumb-item active">طول شبکه</li>
    @endslot

    <div class="row">
        <div class="col-12">
            <div class="card">
                <div class="card-header">
                    <h3 class="card-title">طول شبکه</h3>
                    <div class="card-tools d-flex">
                        <div class="btn-group-sm mr-1">
                            @can('create-provincial-zone')
                                <a href="{{route('admin.web_lengths.create')}}" class="btn btn-info">ایجاد طول شبکه</a>
                            @endcan
                        </div>
                    </div>
                </div>
                <!-- /.card-header -->
                <div class="card-body table-responsive-md p-0">
                    <table class="table table-hover">
                        <tbody>
                        <tr>
                            <th>#</th>
                            <th>زون</th>
                            <th>ولایت</th>
                            <th>زون ولایتی</th>
                            <th>طول شبکه توزیعی</th>
                            <th>طول شبکه انتقالی</th>
                            <th>مجموع طول شبکه</th>
                            <th>تاریخ ثبت</th>
                            <th>تنظیمات</th>
                        </tr>
                        <?php $i=1; ?>
                      @foreach($web_lengths as $web_length)
                          @if(in_array($web_length['provincial_zone_id'],($user->provincialZones->pluck('id')->toArray())))
                          <tr>
                              <td>{{$i++}}</td>
                              <td>{{$web_length->zone->name}}</td>
                              <td>{{$web_length->province->name}}</td>
                              <td>{{$web_length->provincialZone->name}}</td>
                              <td>{{$web_length->distributive_web_length}}</td>
                              <td>{{$web_length->transitive_web_length}}</td>
                              <td>{{$web_length->distributive_web_length+$web_length->transitive_web_length}}</td>
                              <td>{{jdate($web_length->created_at)->format('%A %d %B %y')}}</td>
                              <td class="d-flex">
                                  <div class="btn-group">
                                      <button type="button" class="btn btn-info btn-sm dropdown-toggle" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                          تنظیمات
                                      </button>
                                      <div class="dropdown-menu">
                                          @can('edit-web-length')
                                              <a href="{{route('admin.web_lengths.edit',$web_length->id)}}" class="dropdown-item">ویرایش</a>
                                          @endcan
                                              <a href="{{route('admin.web_lengths.show',$web_length->id)}}" class="dropdown-item">جزییات</a>
                                          @can('delete-web-length')
                                              <form action="{{route('admin.web_lengths.destroy',$web_length->id)}}" method="POST">
                                                  @csrf
                                                  @method('DELETE')
                                                  <button type="submit" class="dropdown-item">حذف</button>
                                              </form>
                                          @endcan
                                      </div>
                                  </div>
                              </td>
                          </tr>
                          @endif
                      @endforeach
                        </tbody>
                    </table>
                </div>
                <!-- /.card-body -->
                <div class="card-footer">
                    {{$web_lengths->render()}}
                </div>
            </div>
            <!-- /.card -->
        </div>
    </div>
@endcomponent
