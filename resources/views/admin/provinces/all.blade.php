@component('admin.layouts.content' , ['title' => 'ولایات'])
    @slot('breadcrumb')
        <li class="breadcrumb-item"><a href="{{route('admin.')}}">پنل مدیریت</a></li>
        <li class="breadcrumb-item active">ولایات</li>
    @endslot

    <div class="row">
        <div class="col-12">
            <div class="card">
                <div class="card-header">
                    <h3 class="card-title">ولایات</h3>
                    <div class="card-tools d-flex">
                        <div class="btn-group-sm mr-1">
                            @can('create-province')
                                <a href="{{route('admin.provinces.create')}}" class="btn btn-info">ایجاد ولایت جدید </a>
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
                            <th>نام ولایت</th>
                            <th>زون</th>
                            <th>واحد</th>
                            <th>تنظیمات</th>
                        </tr>

                        <?php $i=1; ?>
                      @foreach($provinces as $province)
                          <tr>
                              <td>{{$i++}}</td>
                              <td>{{$province->name}}</td>
                              <td>{{$province->zone->name}}</td>
                              <td>
                                  @if($province->unit=='1')
                                      اولی
                                  @else
                                     دومی
                                  @endif
                              </td>
                              <td class="d-flex ">

                                  <div class="btn-group">
                                      <button type="button" class="btn btn-info btn-sm dropdown-toggle" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                          تنظیمات
                                      </button>
                                      <div class="dropdown-menu">

                                          @can('edit-province')
                                              <a href="{{route('admin.provinces.edit',$province->id)}}" class="dropdown-item">ویرایش</a>
                                          @endcan
                                          @can('delete-province')
                                              <form action="{{route('admin.provinces.destroy',$province->id)}}" method="POST">
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
                    {{$provinces->render()}}
                </div>
            </div>
            <!-- /.card -->
        </div>
    </div>

@endcomponent
