<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\WaterDistribution;
use Illuminate\Contracts\View\Factory;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Http\Response;
use Illuminate\Routing\Redirector;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\View\View;

class WaterDistributionController extends Controller
{

    public function __construct()
    {
        $this->middleware('can:show-water-distributions')->only(['index']);
        $this->middleware('can:create-water-distribution')->only(['create','store']);
        $this->middleware('can:edit-water-distribution')->only(['edit','update']);
        $this->middleware('can:delete-water-distribution')->only(['destroy']);
    }
    /**
     * Display a listing of the resource.
     *
     * @return Factory|View
     */
    public function index()
    {
        $water_distributions=WaterDistribution::latest()->paginate(10);
        $user=Auth::user();
        return view('admin.water_distributions.all',compact('water_distributions','user'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return Factory|View
     */
    public function create()
    {
        $zones=DB::table('zones')->pluck('name','id');
        return view('admin.water_distributions.create',compact('zones'));
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
            'water_distributed'=>'required'
        ]);
        WaterDistribution::create($data);
        alert()->success('مطلب مورد نظر شما با موفقیت ثبت شد.');
        return redirect(route('admin.water_distributions.index'));
    }

    /**
     * Display the specified resource.
     *
     * @param WaterDistribution $waterDistribution
     * @return \Illuminate\Contracts\Foundation\Application|Factory|View|void
     */
    public function show(WaterDistribution $waterDistribution)
    {
        return view('admin.water_distributions.show',compact('waterDistribution'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param WaterDistribution $waterDistribution
     * @return Factory|View
     */
    public function edit(WaterDistribution $waterDistribution)
    {
        $zones=DB::table('zones')->pluck('name','id');
        return view('admin.water_distributions.edit',compact('waterDistribution','zones'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param Request $request
     * @param WaterDistribution $waterDistribution
     * @return RedirectResponse|Redirector
     */
    public function update(Request $request, WaterDistribution $waterDistribution)
    {
        $data=$request->validate([
            'zone_id'=>'required',
            'province_id'=>'required',
            'provincial_zone_id'=>'required',
            'water_distributed'=>'required'
        ]);
        $waterDistribution->update($data);
        alert()->success('مطلب مورد نظر شما با موفقیت ویرایش شد.');
        return redirect(route('admin.water_distributions.index'));
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param WaterDistribution $waterDistribution
     * @return RedirectResponse
     * @throws \Exception
     */
    public function destroy(WaterDistribution $waterDistribution)
    {
        $waterDistribution->delete();
        alert()->success('مطلب مورد نظر شما با موفقیت حذف شد.');
        return back();
    }
}
