@component('admin.layouts.content' , ['title' => 'تعویض میتر ها'])
    @slot('breadcrumb')
        <li class="breadcrumb-item"><a href="{{route('admin.')}}">پنل مدیریت</a></li>
        <li class="breadcrumb-item active">تعویض میتر ها</li>
    @endslot

    <div class="row">
        <div class="col-12">
            <div class="card">
                <div class="card-header">
                    <h3 class="card-title">تعویض میتر ها</h3>
                    <div class="card-tools d-flex">
                        <div class="btn-group-sm mr-1">
                            @can('create-meter-change')
                                <a href="{{route('admin.meter_changes.create')}}" class="btn btn-info">ثبت تعویض میترها </a>
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
                            <th>تعداد میترهای تعویض شده</th>
                            <th>نوع میتر های تعویض شده</th>
                            <th>تاریخ ثبت</th>
                            <th>تنظیمات</th>
                        </tr>

                        <?php $i=1; ?>
                      @foreach($meter_changes as $meter_change)
                          @if(in_array($meter_change['provincial_zone_id'],($user->provincialZones->pluck('id')->toArray())))
                          <tr>
                              <td>{{$i++}}</td>
                              <td>{{$meter_change->zone->name}}</td>
                              <td>{{$meter_change->province->name}}</td>
                              <td>{{$meter_change->provincialZone->name}}</td>
                              <td>{{$meter_change->total}}</td>
                              <td>
                                  @if($meter_change->type=='distributive')
                                      توزیعی
                                      @elseif($meter_change->type=='transitive')
                                    میتر مشترک
                                      @else
                                      بالک میتر
                                  @endif
                              </td>
                              <td>{{jdate($meter_change->created_at)->format('%A %d %B %y')}}</td>

                              <td class="d-flex ">

                                  <div class="btn-group">
                                      <button type="button" class="btn btn-info btn-sm dropdown-toggle" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                          تنظیمات
                                      </button>
                                      <div class="dropdown-menu">

                                          @can('edit-meter-change')
                                              <a href="{{route('admin.meter_changes.edit',$meter_change->id)}}" class="dropdown-item">ویرایش</a>
                                          @endcan
                                              <a href="{{route('admin.meter_changes.show',$meter_change->id)}}" class="dropdown-item">جزییات</a>
                                          @can('delete-meter-change')
                                              <form action="{{route('admin.meter_changes.destroy',$meter_change->id)}}" method="POST">
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
                    {{$meter_changes->render()}}
                </div>
            </div>
            <!-- /.card -->
        </div>
    </div>

@endcomponent
