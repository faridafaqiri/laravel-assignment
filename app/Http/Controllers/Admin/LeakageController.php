<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Leakage;
use Exception;
use Illuminate\Contracts\View\Factory;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Routing\Redirector;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\View\View;

class LeakageController extends Controller
{
    public function __construct()
    {
        $this->middleware('can:show-leakages')->only(['index']);
        $this->middleware('can:create-leakage')->only(['create','store']);
        $this->middleware('can:edit-leakage')->only(['edit','update']);
        $this->middleware('can:delete-leakage')->only(['destroy']);
    }

    /**
     * Display a listing of the resource.
     *
     * @return Factory|View
     */
    public function index()
    {
        $leakages=Leakage::latest()->paginate(20);
        $user=Auth::user();
        return view('admin.leakages.all',compact('leakages','user'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return Factory|View
     */
    public function create()
    {
        $zones=DB::table('zones')->pluck('name','id');
        return view('admin.leakages.create',compact('zones'));
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
            'provincial_zone_id' => 'required',
            'zone_id'=>'required',
            'province_id'=>'required',
            'total'=>'required',
            'fixation'=>'required',
            'type_of_web'=>'required'
        ]);
        Leakage::create($data);
        alert()->success('مطلب مورد نظر شما با موفقیت ایجاد شد.');
        return redirect(route('admin.leakages.index'));
    }

    /**
     * Display the specified resource.
     *
     * @param Leakage $leakage
     * @return \Illuminate\Contracts\Foundation\Application|Factory|View|void
     */
    public function show(Leakage $leakage)
    {
        return view('admin.leakages.show',compact('leakage'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param Leakage $leakage
     * @return Factory|View
     */
    public function edit(Leakage $leakage)
    {
        $zones=DB::table('zones')->pluck('name','id');
        return view('admin.leakages.edit',compact('leakage','zones'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param Request $request
     * @param Leakage $leakage
     * @return RedirectResponse|Redirector
     */
    public function update(Request $request, Leakage $leakage)
    {
        $data=$request->validate([
            'provincial_zone_id' => 'required',
            'zone_id'=>'required',
            'province_id'=>'required',
            'total'=>'required',
            'fixation'=>'required',
            'type_of_web'=>'required'
        ]);
        $leakage->update($data);
        alert()->success('مطلب مورد نظر شما با موفقیت ویرایش شد.');
        return redirect(route('admin.leakages.index'));
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param Leakage $leakage
     * @return RedirectResponse
     * @throws Exception
     */
    public function destroy(Leakage $leakage)
    {
        $leakage->delete();
        alert()->success('مطلب مورد نظر شما با موفقیت حذف شد.');
        return back();
    }
}
