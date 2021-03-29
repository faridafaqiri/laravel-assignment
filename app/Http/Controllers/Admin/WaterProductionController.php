<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\WaterProduction;
use Illuminate\Contracts\View\Factory;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Http\Response;
use Illuminate\Routing\Redirector;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\View\View;

class WaterProductionController extends Controller
{
    public function __construct()
    {
        $this->middleware('can:show-water-productions')->only(['index']);
        $this->middleware('can:create-water-production')->only(['create','store']);
        $this->middleware('can:edit-water-production')->only(['edit','update']);
        $this->middleware('can:delete-water-production')->only(['destroy']);
    }
    /**
     * Display a listing of the resource.
     *
     * @return Factory|View
     */
    public function index()
    {
        $water_productions=WaterProduction::latest()->paginate(20);
        $user=Auth::user();
        return view('admin.water_productions.all',compact('water_productions','user'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return Factory|View
     */
    public function create()
    {
        $zones=DB::table('zones')->pluck('name','id');
        return view('admin.water_productions.create',compact('zones'));
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
           'active_hours'=>'required',
           'expense_of_oil'=>'required',
           'expends'=>'required',
            'produce_water'=>'required',
            'produce_generator'=>'required'
        ]);
        WaterProduction::create($data);
        alert()->success('مطلب مورد نظر شما با موفقیت ثبت شد.');
        return redirect(route('admin.water_productions.index'));
    }

    /**
     * Display the specified resource.
     *
     * @param WaterProduction $waterProduction
     * @return \Illuminate\Contracts\Foundation\Application|Factory|View|void
     */
    public function show(WaterProduction $waterProduction)
    {
        return view('admin.water_productions.show',compact('waterProduction'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param WaterProduction $waterProduction
     * @return Factory|View
     */
    public function edit(WaterProduction $waterProduction)
    {
        $zones=DB::table('zones')->pluck('name','id');
        return view('admin.water_productions.edit',compact('waterProduction','zones'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param Request $request
     * @param WaterProduction $waterProduction
     * @return RedirectResponse|Redirector
     */
    public function update(Request $request, WaterProduction $waterProduction)
    {
        $data=$request->validate([
            'zone_id'=>'required',
            'province_id'=>'required',
            'provincial_zone_id'=>'required',
            'active_hours'=>'required',
            'expense_of_oil'=>'required',
            'expends'=>'required',
            'produce_water'=>'required',
            'produce_generator'=>'required'
        ]);
        $waterProduction->update($data);
        alert()->success('مطلب مورد نظر شما با موفقیت ویرایش شد.');
        return redirect(route('admin.water_productions.index'));
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param WaterProduction $waterProduction
     * @return RedirectResponse
     * @throws \Exception
     */
    public function destroy(WaterProduction $waterProduction)
    {
        $waterProduction->delete();
        alert()->success('مطلب مورد نظر شما با موفقیت حذف شد.');
        return back();

    }
}
