<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\ImpairedPump;
use Exception;
use Illuminate\Contracts\Foundation\Application;
use Illuminate\Contracts\View\Factory;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Http\Response;
use Illuminate\Routing\Redirector;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\View\View;
use phpDocumentor\Reflection\Types\Compound;

class ImpairedPumpController extends Controller
{
    public function __construct()
    {
        $this->middleware('can:show-impaired-pumps')->only(['index']);
        $this->middleware('can:create-impaired-pump')->only(['create','store']);
        $this->middleware('can:edit-impaired-pump')->only(['edit','update']);
        $this->middleware('can:delete-impaired-pump')->only(['destroy']);
    }
    /**
     * Display a listing of the resource.
     *
     * @return Factory|View
     */
    public function index()
    {
        $impaired_pumps=ImpairedPump::latest()->paginate(20);
        $user=Auth::user();
        return view('admin.impaired_pumps.all',compact('impaired_pumps','user'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return Factory|View
     */
    public function create()
    {
        $zones=DB::table('zones')->pluck('name','id');
        return view('admin.impaired_pumps.create',compact('zones'));
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
            'reason'=>'nullable',
           'total_impaired'=>'required',
           'fixed'=>'required'
        ]);
        ImpairedPump::create($data);
        alert()->success('مطلب مورد نظر شما با موفقیت ثبت شد.');
        return redirect(route('admin.impaired_pumps.index'));
    }

    /**
     * Display the specified resource.
     *
     * @param ImpairedPump $impairedPump
     * @return Application|Factory|Response|View
     */
    public function show(ImpairedPump $impairedPump)
    {
        return view('admin.impaired_pumps.show',compact('impairedPump'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param ImpairedPump $impairedPump
     * @return Factory|View
     */
    public function edit(ImpairedPump $impairedPump)
    {
        $zones=DB::table('zones')->pluck('name','id');
        return view('admin.impaired_pumps.edit',compact('impairedPump','zones'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param Request $request
     * @param ImpairedPump $impairedPump
     * @return RedirectResponse|Redirector
     */
    public function update(Request $request, ImpairedPump $impairedPump)
    {
        $data=$request->validate([
            'provincial_zone_id'=>'required',
            'zone_id'=>'required',
            'province_id'=>'required',
            'reason'=>'nullable',
            'total_impaired'=>'required',
            'fixed'=>'required'
        ]);
        $impairedPump->update($data);
        alert()->success('مطلب مورد نظر شما با موفقیت ویرایش شد.');
        return redirect(route('admin.impaired_pumps.index'));
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param ImpairedPump $impairedPump
     * @return RedirectResponse
     * @throws Exception
     */
    public function destroy(ImpairedPump $impairedPump)
    {
        $impairedPump->delete();
        alert()->success('مطلب مورد نظر شما با موفقیت حذف شد.');
        return back();
    }
}
