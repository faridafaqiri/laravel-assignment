@component('admin.layouts.content' , ['title' => 'زون های ولایتی'])
    @slot('breadcrumb')
        <li class="breadcrumb-item"><a href="{{route('admin.')}}">پنل مدیریت</a></li>
        <li class="breadcrumb-item active">زون های ولایتی</li>
    @endslot

    <div class="row">
        <div class="col-12">
            <div class="card">
                <div class="card-header">
                    <h3 class="card-title">زون های ولایتی</h3>
                    <div class="card-tools d-flex">
                        <div class="btn-group-sm mr-1">
                            @can('create-provincial-zone')
                                <a href="{{route('admin.provincial-zones.create')}}" class="btn btn-info">ایجاد زون های ولایتی جدید </a>
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
                            <th>نام</th>
                            <th>ولایت</th>
                            <th>تاریخ ثبت</th>
                            <th>تنظیمات</th>
                        </tr>
                        <?php $i=1; ?>
                      @foreach($provincial_zones as $provincial_zone)
                          <tr>
                              <td>{{$i++}}</td>
                              <td>{{$provincial_zone->name}}</td>
                              <td>{{$provincial_zone->province->name}}</td>
                              <td>{{jdate($provincial_zone->created_at)->format('%A %d %B %y')}}</td>

                              <td class="d-flex ">

                                  <div class="btn-group">
                                      <button type="button" class="btn btn-info btn-sm dropdown-toggle" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                          تنظیمات
                                      </button>
                                      <div class="dropdown-menu">

                                          @can('edit-provincial-zone')
                                              <a href="{{route('admin.provincial-zones.edit',$provincial_zone->id)}}" class="dropdown-item">ویرایش</a>
                                          @endcan
                                          @can('delete-provincial-zone')
                                              <form action="{{route('admin.provincial-zones.destroy',$provincial_zone->id)}}" method="POST">
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
                </div>
                <!-- /.card-body -->
                <div class="card-footer">
                    {{$provincial_zones->render()}}
                </div>
            </div>
            <!-- /.card -->
        </div>
    </div>

@endcomponent
