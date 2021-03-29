<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Province;
use App\Zone;
use Exception;
use Illuminate\Contracts\View\Factory;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Http\Response;
use Illuminate\Routing\Redirector;
use Illuminate\View\View;

class ProvinceController extends Controller
{
    public function __construct()
    {
        $this->middleware('can:show-provinces')->only(['index']);
        $this->middleware('can:create-province')->only(['create','store']);
        $this->middleware('can:edit-province')->only(['edit','update']);
        $this->middleware('can:delete-province')->only(['destroy']);
    }
    /**
     * Display a listing of the resource.
     *
     * @return Factory|View
     */
    public function index()
    {
        $provinces=Province::latest()->paginate(20);
        return view('admin.provinces.all',compact('provinces'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return Factory|View
     */
    public function create()
    {
        $zones=Zone::all();
        return view('admin.provinces.create',compact('zones'));
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
            'unit'=>'required',
            'zone_id'=>'required'
        ]);
        $province=Province::create($data);
        alert()->success('مطلب مورد نظر شما با موفقیت ایجاد شد.');
        return redirect(route('admin.provinces.index'));
    }

    /**
     * Display the specified resource.
     *
     * @param Province $province
     * @return \Illuminate\Contracts\Foundation\Application|Factory|View|void
     */
    public function show(Province $province)
    {
        return view('admin.provinces.show',compact('province'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param Province $province
     * @return Factory|View
     */
    public function edit(Province $province)
    {
        return view('admin.provinces.edit',compact('province'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param Request $request
     * @param Province $province
     * @return RedirectResponse|Redirector
     */
    public function update(Request $request, Province $province)
    {
        $data=$request->validate([
            'name' => ['required', 'string', 'max:255'],
            'unit'=>'required',
            'zone_id'=>'required'
        ]);
        $province->update($data);
        alert()->success('مطلب مورد نظر شما با موفقیت ویرایش شد.');
        return redirect(route('admin.provinces.index'));
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param Province $province
     * @return RedirectResponse
     * @throws Exception
     */
    public function destroy(Province $province)
    {
        $province->delete();
        alert()->success('مطلب مورد نظر شما با موفقیت حذف شد.');
        return back();
    }
}
