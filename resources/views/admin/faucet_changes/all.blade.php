@component('admin.layouts.content' , ['title' => 'تبدیلی نل مشترکین'])
    @slot('breadcrumb')
        <li class="breadcrumb-item"><a href="{{route('admin.')}}">پنل مدیریت</a></li>
        <li class="breadcrumb-item active">تبدیلی نل مشترکین</li>
    @endslot

    <div class="row">
        <div class="col-12">
            <div class="card">
                <div class="card-header">
                    <h3 class="card-title">تبدیلی نل مشترکین</h3>
                    <div class="card-tools d-flex">
                        <div class="btn-group-sm mr-1">
                            @can('create-faucet-change')
                                <a href="{{route('admin.faucet_changes.create')}}" class="btn btn-info">ثبت تبدیلی نل مشترکین </a>
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
                            <th>کل نل های تبدیل شده</th>
                            <th> تجاری</th>
                            <th>رهایشی </th>
                            <th>مقدسه</th>
                            <th>عامه</th>
                            <th>دولتی</th>
                            <th>تاریخ ثبت</th>
                            <th>تنظیمات</th>
                        </tr>

                        <?php $i=1; ?>
                      @foreach($faucet_changes as $faucet_change)

                          @if(in_array($faucet_change['provincial_zone_id'],($user->provincialZones->pluck('id')->toArray())))
                          <tr>
                              <td>{{$i++}}</td>
                              <td>{{$faucet_change->zone->name}}</td>
                              <td>{{$faucet_change->province->name}}</td>
                              <td>{{$faucet_change->provincialZone->name}}</td>
                              <td>{{$faucet_change->total}}</td>
                              <td>{{$faucet_change->business}}</td>
                              <td>{{$faucet_change->residential}}</td>
                              <td>{{$faucet_change->holy_places}}</td>
                              <td>{{$faucet_change->public_places}}</td>
                              <td>{{$faucet_change->governmental}}</td>
                              <td>{{jdate($faucet_change->created_at)->format('%A %d %B %y')}}</td>

                              <td class="d-flex ">

                                  <div class="btn-group">
                                      <button type="button" class="btn btn-info btn-sm dropdown-toggle" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                          تنظیمات
                                      </button>
                                      <div class="dropdown-menu">

                                          @can('edit-faucet-change')
                                              <a href="{{route('admin.faucet_changes.edit',$faucet_change->id)}}" class="dropdown-item">ویرایش</a>
                                          @endcan
                                              <a href="{{route('admin.faucet_changes.show',$faucet_change->id)}}" class="dropdown-item">جزییات</a>
                                          @can('delete-faucet-change')
                                              <form action="{{route('admin.faucet_changes.destroy',$faucet_change->id)}}" method="POST">
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
                    {{$faucet_changes->render()}}
                </div>
            </div>
            <!-- /.card -->
        </div>
    </div>

@endcomponent
