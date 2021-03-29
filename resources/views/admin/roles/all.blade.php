@component('admin.layouts.content' , ['title' => 'مقام ها'])
    @slot('breadcrumb')
        <li class="breadcrumb-item"><a href="{{route('admin.')}}">پنل مدیریت</a></li>
        <li class="breadcrumb-item active">مقام ها</li>
    @endslot

    <div class="row">
        <div class="col-12">
            <div class="card">
                <div class="card-header">
                    <h3 class="card-title">مقام ها</h3>
                    <div class="card-tools d-flex">
                        <form action="">
                            <div class="input-group input-group-sm" style="width: 150px;">
                                <input type="text" name="search" class="form-control float-right" placeholder="جستجو" value="{{request('search')}}">

                                <div class="input-group-append">
                                    <button type="submit" class="btn btn-default"><i class="fa fa-search"></i></button>
                                </div>
                            </div>
                        </form>
                        <div class="btn-group-sm mr-1">
                            @can('create-role')
                                <a href="{{route('admin.roles.create')}}" class="btn btn-info">ایجاد مقام جدید</a>
                            @endcan
                        </div>
                    </div>
                </div>
                <!-- /.card-header -->
                <div class="card-body table-responsive-md p-0">
                    <table class="table table-hover">
                        <tbody><tr>
                            <th>نام مقام</th>
                            <th>توضیح مقام</th>
                            <th>تنظیمات</th>
                        </tr>

                      @foreach($roles as $role)
                          <tr>
                              <td>{{$role->name}}</td>
                              <td>{{$role->label}}</td>


                              <td class="d-flex ">

                                  <div class="btn-group">
                                      <button type="button" class="btn btn-info btn-sm dropdown-toggle" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                          تنظیمات
                                      </button>
                                      <div class="dropdown-menu">

                                          @can('edit-role')
                                              <a href="{{route('admin.roles.edit',$role->id)}}" class="dropdown-item">ویرایش</a>
                                          @endcan
                                          @can('delete-role')
                                              <form action="{{route('admin.roles.destroy',$role->id)}}" method="POST">
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
                    {{$roles->render()}}
                </div>
            </div>
            <!-- /.card -->
        </div>
    </div>

@endcomponent
