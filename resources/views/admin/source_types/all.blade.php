@component('admin.layouts.content' , ['title' => 'انواع منابع'])
    @slot('breadcrumb')
        <li class="breadcrumb-item"><a href="{{route('admin.')}}">پنل مدیریت</a></li>
        <li class="breadcrumb-item active">انواع منابع</li>
    @endslot

    <div class="row">
        <div class="col-12">
            <div class="card">
                <div class="card-header">
                    <h3 class="card-title">انواع منابع</h3>
                    <div class="card-tools d-flex">
                        <div class="btn-group-sm mr-1">
                            @can('create-source-type')
                                <a href="{{route('admin.source_types.create')}}" class="btn btn-info">ثبت نوع منبع</a>
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
                            <th>نوع منبع</th>
                            <th>ثبت تاریخ</th>
                            <th>تنظیمات</th>
                        </tr>

                        <?php $i=1; ?>
                      @foreach($source_types as $source_type)
                          
                          <tr>
                              <td>{{$i++}}</td>
                              <td>{{$source_type->name}}</td>
                              <td>{{jdate($source_type->created_at)->format('%A %d %B %y')}}</td>
                              <td class="d-flex ">

                                  <div class="btn-group">
                                      <button type="button" class="btn btn-info btn-sm dropdown-toggle" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                          تنظیمات
                                      </button>
                                      <div class="dropdown-menu">

                                          @can('edit-source-type')
                                              <a href="{{route('admin.source_types.edit',$source_type->id)}}" class="dropdown-item">ویرایش</a>
                                          @endcan
                                          @can('delete-source-type')
                                              <form action="{{route('admin.source_types.destroy',$source_type->id)}}" method="POST">
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
                    {{$source_types->render()}}
                </div>
            </div>
            <!-- /.card -->
        </div>
    </div>

@endcomponent
