<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Zone;
use Illuminate\Contracts\View\Factory;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Http\Response;
use Illuminate\Routing\Redirector;
use Illuminate\View\View;

class ZoneController extends Controller
{

    public function __construct()
    {
        $this->middleware('can:show-zones')->only(['index']);
        $this->middleware('can:create-zone')->only(['create','store']);
        $this->middleware('can:edit-zone')->only(['edit','update']);
        $this->middleware('can:delete-zone')->only(['destroy']);
    }
    /**
     * Display a listing of the resource.
     *
     * @return Factory|View
     */
    public function index()
    {
        $zones=Zone::latest()->paginate(20);
        return view('admin.zones.all',compact('zones'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return Factory|View
     */
    public function create()
    {
        return view('admin.zones.create');
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
        ]);
        $zone=Zone::create($data);
        alert()->success('مطلب مورد نظر شما با موفقیت ایجاد شد.');
        return redirect(route('admin.zones.index'));
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param Zone $zone
     * @return Factory|View
     */
    public function edit(Zone $zone)
    {
        return view('admin.zones.edit',compact('zone'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param Request $request
     * @param Zone $zone
     * @return RedirectResponse|Redirector
     */
    public function update(Request $request, Zone $zone)
    {
        $data=$request->validate([
            'name' => ['required', 'string', 'max:255'],
        ]);
        $zone->update($data);
        alert()->success('مطلب مورد نظر شما با موفقیت ویرایش شد.');
        return redirect(route('admin.zones.index'));
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param Zone $zone
     * @return RedirectResponse
     * @throws \Exception
     */
    public function destroy(Zone $zone)
    {
        $zone->delete();
        alert()->success('مطلب مورد نظر شما با موفقیت حذف شد.');
        return back();
    }
}
