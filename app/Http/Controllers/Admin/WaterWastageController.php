<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\WaterWastage;
use Exception;
use Illuminate\Contracts\View\Factory;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Http\Response;
use Illuminate\Routing\Redirector;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\View\View;

class WaterWastageController extends Controller
{

    public function __construct()
    {
        $this->middleware('can:show-water-wastages')->only(['index']);
        $this->middleware('can:create-water-wastage')->only(['create','store']);
        $this->middleware('can:edit-water-wastage')->only(['edit','update']);
        $this->middleware('can:delete-water-wastage')->only(['destroy']);
    }

    /**
     * Display a listing of the resource.
     *
     * @return Factory|View
     */
    public function index()
    {
        $water_wastages=WaterWastage::latest()->paginate(20);
        $user=Auth::user();
        return view('admin.water_wastages.all',compact('water_wastages','user'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return Factory|View
     */
    public function create()
    {
        $zones=DB::table('zones')->pluck('name','id');
        return view('admin.water_wastages.create',compact('zones'));
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
           'zone_id'=>'required',
           'province_id'=>'required',
           'provincial_zone_id'=>'required',
           'wasted_type'=>'required',
           'wasted_water'=>'required',
            'loss'=>'required'
        ]);
        WaterWastage::create($data);
        alert()->success('مطلب مورد نظر شما با موفقیت ثبت شد.');
        return redirect(route('admin.water_wastages.index'));
    }

    /**
     * Display the specified resource.
     *
     * @param WaterWastage $waterWastage
     * @return \Illuminate\Contracts\Foundation\Application|Factory|View|void
     */
    public function show(WaterWastage $waterWastage)
    {
        return view('admin.water_wastages.show',compact('waterWastage'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param WaterWastage $waterWastage
     * @return Factory|View
     */
    public function edit(WaterWastage $waterWastage)
    {
        $zones=DB::table('zones')->pluck('name','id');
        return view('admin.water_wastages.edit',compact('waterWastage','zones'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param Request $request
     * @param WaterWastage $waterWastage
     * @return RedirectResponse|Redirector
     */
    public function update(Request $request, WaterWastage $waterWastage)
    {
        $data=$request->validate([
            'zone_id'=>'required',
            'province_id'=>'required',
            'provincial_zone_id'=>'required',
            'wasted_type'=>'required',
            'wasted_water'=>'required',
            'loss'=>'required'
        ]);
        $waterWastage->update($data);
        alert()->success('مطلب مورد نظر شما با موفقیت ویرایش شد.');
        return redirect(route('admin.water_wastages.index'));
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param WaterWastage $waterWastage
     * @return RedirectResponse
     * @throws Exception
     */
    public function destroy(WaterWastage $waterWastage)
    {
        $waterWastage->delete();
        alert()->success('مطلب مورد نظر شما با موفقیت حذف شد.');
        return back();
    }
}
