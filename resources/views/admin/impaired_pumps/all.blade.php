@component('admin.layouts.content' , ['title' => 'پمپ های خراب شده'])
    @slot('breadcrumb')
        <li class="breadcrumb-item"><a href="{{route('admin.')}}">پنل مدیریت</a></li>
        <li class="breadcrumb-item active">پمپ های خراب شده</li>
    @endslot

    <div class="row">
        <div class="col-12">
            <div class="card">
                <div class="card-header">
                    <h3 class="card-title">پمپ های خراب شده</h3>
                    <div class="card-tools d-flex">
                        <div class="btn-group-sm mr-1">
                            @can('create-impaired-pump')
                                <a href="{{route('admin.impaired_pumps.create')}}" class="btn btn-info">ثبت پمپ های خراب شده </a>
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
                            <th>تعداد پمپ های خراب شده</th>
                            <th>دلیل خرابی</th>
                            <th>ترمیم</th>
                            <th>تاریخ ثبت</th>
                            <th>تنظیمات</th>
                        </tr>

                        <?php $i=1; ?>
                      @foreach($impaired_pumps as $impaired_pump)
                          @if(in_array($impaired_pump['provincial_zone_id'],($user->provincialZones->pluck('id')->toArray())))
                          <tr>
                              <td>{{$i++}}</td>
                              <td>{{$impaired_pump->zone->name}}</td>
                              <td>{{$impaired_pump->province->name}}</td>
                              <td>{{$impaired_pump->provincialZone->name}}</td>
                              <td>{{$impaired_pump->total_impaired}}</td>
                              <td>{{\Illuminate\Support\Str::limit($impaired_pump->reason,25)}}</td>
                              <td>
                                  @if($impaired_pump->fixed==1)
                                      شده
                                  @else
                                      نشده
                                  @endif
                              </td>
                              <td>{{jdate($impaired_pump->created_at)->format('%A %d %B %y')}}</td>
                              <td class="d-flex ">

                                  <div class="btn-group">
                                      <button type="button" class="btn btn-info btn-sm dropdown-toggle" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                          تنظیمات
                                      </button>
                                      <div class="dropdown-menu">

                                          @can('edit-impaired-pump')
                                              <a href="{{route('admin.impaired_pumps.edit',$impaired_pump->id)}}" class="dropdown-item">ویرایش</a>
                                          @endcan

                                              <a href="{{route('admin.impaired_pumps.show',$impaired_pump->id)}}" class="dropdown-item">جزییات</a>

                                          @can('delete-impaired-pump')
                                              <form action="{{route('admin.impaired_pumps.destroy',$impaired_pump->id)}}" method="POST">
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
                    {{$impaired_pumps->render()}}
                </div>
            </div>
            <!-- /.card -->
        </div>
    </div>

@endcomponent
