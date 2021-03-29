<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\WaterStorage;
use Illuminate\Contracts\View\Factory;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Http\Response;
use Illuminate\Routing\Redirector;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\View\View;

class WaterStorageController extends Controller
{
    public function __construct()
    {
        $this->middleware('can:show-water-storages')->only(['index']);
        $this->middleware('can:create-water-storage')->only(['create','store']);
        $this->middleware('can:edit-water-storage')->only(['edit','update']);
        $this->middleware('can:delete-water-storage')->only(['destroy']);
    }
    /**
     * Display a listing of the resource.
     *
     * @return Factory|View
     */
    public function index()
    {
        $water_storages=WaterStorage::latest()->paginate(20);
        $user=Auth::user();
        return view('admin.water_storages.all',compact('water_storages','user'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return Factory|View
     */
    public function create()
    {
        $zones=DB::table('zones')->pluck('name','id');
        return view('admin.water_storages.create',compact('zones'));
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
           'storage_type'=>'required',
           'height_type'=>'required',
           'activation'=>'required',
           'capacity'=>'required'
        ]);
        WaterStorage::create($data);
        alert()->success('مطلب مورد نظر شما با موفقیت ثبت شد.');
        return redirect(route('admin.water_storages.index'));
    }

    /**
     * Display the specified resource.
     *
     * @param WaterStorage $waterStorage
     * @return \Illuminate\Contracts\Foundation\Application|Factory|View|void
     */
    public function show(WaterStorage $waterStorage)
    {
        return view('admin.water_storages.show',compact('waterStorage'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param WaterStorage $waterStorage
     * @return Factory|View
     */
    public function edit(WaterStorage $waterStorage)
    {
        $zones=DB::table('zones')->pluck('name','id');
        return view('admin.water_storages.edit',compact('waterStorage','zones'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param Request $request
     * @param WaterStorage $waterStorage
     * @return RedirectResponse|Redirector
     */
    public function update(Request $request, WaterStorage $waterStorage)
    {
        $data=$request->validate([
            'zone_id'=>'required',
            'province_id'=>'required',
            'provincial_zone_id'=>'required',
            'storage_type'=>'required',
            'height_type'=>'required',
            'activation'=>'required',
            'capacity'=>'required'
        ]);
        $waterStorage->update($data);
        alert()->success('مطلب مورد نظر شما با موفقیت ویرایش شد.');
        return redirect(route('admin.water_storages.index'));
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param WaterStorage $waterStorage
     * @return RedirectResponse
     * @throws \Exception
     */
    public function destroy(WaterStorage $waterStorage)
    {
        $waterStorage->delete();
        alert()->success('مطلب مورد نظر شما با موفقیت حذف شد.');
        return back();
    }
}
