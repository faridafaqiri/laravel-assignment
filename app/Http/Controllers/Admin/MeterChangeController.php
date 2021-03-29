<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\MeterChange;
use Exception;
use Illuminate\Contracts\View\Factory;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Http\Response;
use Illuminate\Routing\Redirector;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\View\View;

class MeterChangeController extends Controller
{
    public function __construct()
    {
        $this->middleware('can:show-meter-changes')->only(['index']);
        $this->middleware('can:create-meter-change')->only(['create','store']);
        $this->middleware('can:edit-meter-change')->only(['edit','update']);
        $this->middleware('can:delete-meter-change')->only(['destroy']);
    }

    /**
     * Display a listing of the resource.
     *
     * @return Factory|View
     */
    public function index()
    {
        $meter_changes=MeterChange::latest()->paginate(10);
        $user=Auth::user();
        return view('admin.meter_changes.all',compact('meter_changes','user'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return Factory|View
     */
    public function create()
    {
        $zones=DB::table('zones')->pluck('name','id');
        return  view('admin.meter_changes.create',compact('zones'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param Request $request
     * @return RedirectResponse|Redirector
     */
    public function store(Request $request)
    {
        $data=$request->validate([
           'provincial_zone_id'=>'required',
            'zone_id'=>'required',
            'province_id'=>'required',
            'total'=>'required',
            'type'=>'required'
        ]);
        MeterChange::create($data);
        alert()->success('مطلب مورد نظر شما با موفقیت ثبت شد');
        return  redirect(route('admin.meter_changes.index'));

    }

    /**
     * Display the specified resource.
     *
     * @param MeterChange $meterChange
     * @return \Illuminate\Contracts\Foundation\Application|Factory|View|void
     */
    public function show(MeterChange $meterChange)
    {
        return view('admin.meter_changes.show',compact('meterChange'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param MeterChange $meterChange
     * @return Factory|View
     */
    public function edit(MeterChange $meterChange)
    {
        $zones=DB::table('zones')->pluck('name','id');
      return view('admin.meter_changes.edit',compact('meterChange','zones'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param Request $request
     * @param MeterChange $meterChange
     * @return RedirectResponse|Redirector
     */
    public function update(Request $request, MeterChange $meterChange)
    {
        $data=$request->validate([
            'provincial_zone_id'=>'required',
            'zone_id'=>'required',
            'province_id'=>'required',
            'total'=>'required',
            'type'=>'required'
        ]);
        $meterChange->update($data);
        return redirect(route('admin.meter_changes.index'));
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param MeterChange $meterChange
     * @return RedirectResponse
     * @throws Exception
     */
    public function destroy(MeterChange $meterChange)
    {
        $meterChange->delete();
        alert()->success('مطلب مورد نظر شما با موفقیت حذف شد.');
        return back();
    }
}
