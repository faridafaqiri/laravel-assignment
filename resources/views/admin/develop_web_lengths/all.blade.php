@component('admin.layouts.content' , ['title' => 'توسعه طول شبکه'])
    @slot('breadcrumb')
        <li class="breadcrumb-item"><a href="{{route('admin.')}}">پنل مدیریت</a></li>
        <li class="breadcrumb-item active">توسعه طول شبکه</li>
    @endslot

    <div class="row">
        <div class="col-12">
            <div class="card">
                <div class="card-header">
                    <h3 class="card-title">توسعه طول شبکه</h3>
                    <div class="card-tools d-flex">
                        <div class="btn-group-sm mr-1">
                            @can('create-develop-web-length')
                                <a href="{{route('admin.develop_web_lengths.create')}}" class="btn btn-info">ایجاد توسعه طول شبکه</a>
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
                            <th> توسعه شبکه توزیعی</th>
                            <th> توسعه شبکه انتقالی</th>
                            <th>مجموع توسعه شبکه</th>
                            <th>تاریخ ثبت</th>
                            <th>تنظیمات</th>
                        </tr>
                        <?php $i=1; ?>
                      @foreach($develop_web_lengths as $develop_web_length)
                          @if(in_array($develop_web_length['provincial_zone_id'],($user->provincialZones->pluck('id')->toArray())))
                          <tr>
                              <td>{{$i++}}</td>
                              <td>{{$develop_web_length->zone->name}}</td>
                              <td>{{$develop_web_length->province->name}}</td>
                              <td>{{$develop_web_length->provincialZone->name}}</td>
                              <td>{{$develop_web_length->develop_distributive_web_length}}</td>
                              <td>{{$develop_web_length->develop_transitive_web_length}}</td>
                              <td>{{$develop_web_length->develop_distributive_web_length
                                    +
                                    $develop_web_length->develop_transitive_web_length}}</td>
                              <td>{{jdate($develop_web_length->created_at)->format('%A %d %B %y')}}</td>
                              <td class="d-flex">
                                  <div class="btn-group">
                                      <button type="button" class="btn btn-info btn-sm dropdown-toggle" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                          تنظیمات
                                      </button>
                                      <div class="dropdown-menu">
                                          @can('edit-develop-web-length')
                                              <a href="{{route('admin.develop_web_lengths.edit',$develop_web_length->id)}}" class="dropdown-item">ویرایش</a>
                                          @endcan
                                              <a href="{{route('admin.develop_web_lengths.show',$develop_web_length->id)}}" class="dropdown-item">جزییات</a>
                                          @can('delete-develop-web-length')
                                              <form action="{{route('admin.develop_web_lengths.destroy',$develop_web_length->id)}}" method="POST">
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
                    {{$develop_web_lengths->render()}}
                </div>
            </div>
            <!-- /.card -->
        </div>
    </div>
@endcomponent
