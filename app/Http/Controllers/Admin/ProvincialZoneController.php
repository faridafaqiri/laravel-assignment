<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Province;
use App\ProvincialZone;
use Exception;
use Illuminate\Contracts\Foundation\Application;
use Illuminate\Contracts\View\Factory;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Http\Response;
use Illuminate\Routing\Redirector;
use Illuminate\Support\Facades\DB;
use Illuminate\View\View;

class ProvincialZoneController extends Controller
{
    public function __construct()
    {
        $this->middleware('can:show-provincial-zones')->only(['index']);
        $this->middleware('can:create-provincial-zone')->only(['create','store']);
        $this->middleware('can:edit-provincial-zone')->only(['edit','update']);
        $this->middleware('can:delete-provincial-zone')->only(['destroy']);
    }
    /**
     * Display a listing of the resource.
     *
     * @return Factory|View
     */
    public function index()
    {
        $provincial_zones=ProvincialZone::latest()->paginate(20);
        return view('admin.provincial_zones.all',compact('provincial_zones'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return Factory|View
     */
    public function create()
    {
        $provinces=Province::pluck('name','id');

        return view('admin.provincial_zones.create',compact('provinces'));
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
            'name' => ['required', 'string', 'max:255'],
            'province_id'=>'required',

        ]);
        ProvincialZone::create($data);
        alert()->success('مطلب مورد نظر شما با موفقیت ایجاد شد.');
        return redirect(route('admin.provincial-zones.index'));
    }

    /**
     * Display the specified resource.
     *
     * @param ProvincialZone $provincialZone
     * @return Application|Factory|View|void
     */
    public function show(ProvincialZone $provincialZone)
    {
        return view('admin.provincial_zones.show',compact('provincialZone'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param ProvincialZone $provincialZone
     * @return Factory|View
     */
    public function edit(ProvincialZone $provincialZone)
    {
        $provinces=Province::pluck('name','id');
        return view('admin.provincial_zones.edit',compact('provincialZone','provinces'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param Request $request
     * @param ProvincialZone $provincialZone
     * @return RedirectResponse|Redirector
     */
    public function update(Request $request, ProvincialZone $provincialZone)
    {
        $data=$request->validate([
            'name' => ['required', 'string', 'max:255'],
            'province_id'=>'required'
        ]);
        $provincialZone->update($data);
        alert()->success('مطلب مورد نظر شما با موفقیت ویرایش شد.');
        return redirect(route('admin.provincial-zones.index'));
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param ProvincialZone $provincialZone
     * @return RedirectResponse
     * @throws Exception
     */
    public function destroy(ProvincialZone $provincialZone)
    {
        $provincialZone->delete();
        alert()->success('مطلب مورد نظر شما با موفقیت حذف شد.');
        return back();
    }
}
