<?php

namespace App\Http\Controllers\Admin;

use App\FaucetChange;
use App\Http\Controllers\Controller;
use Illuminate\Contracts\View\Factory;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Http\Response;
use Illuminate\Routing\Redirector;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\View\View;

class FaucetChangeController extends Controller
{

    public function __construct()
    {
        $this->middleware('can:show-faucet-changes')->only(['index']);
        $this->middleware('can:create-faucet-change')->only(['create','store']);
        $this->middleware('can:edit-faucet-change')->only(['edit','update']);
        $this->middleware('can:delete-faucet-change')->only(['destroy']);
    }

    /**
     * Display a listing of the resource.
     *
     * @return Factory|View
     */
    public function index()
    {
        $faucet_changes=FaucetChange::latest()->paginate(20);
        $user=Auth::user();
        return view('admin.faucet_changes.all',compact('faucet_changes','user'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return Factory|View
     */
    public function create()
    {
        $zones=DB::table('zones')->pluck('name','id');
        return view('admin.faucet_changes.create',compact('zones'));
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
           'province_id'=>'required',
           'zone_id'=>'required',
           'total'=>'required',
           'business'=>'required',
            'residential'=>'required',
            'holy_places'=>'required',
            'public_places'=>'required',
            'governmental'=>'required'
        ]);
        FaucetChange::create($data);
        alert()->success('مطلب مورد نظر شما با موف
        قیت ایجاد شد.');
        return redirect(route('admin.faucet_changes.index'));
    }

    /**
     * Display the specified resource.
     *
     * @param FaucetChange $faucetChange
     * @return \Illuminate\Contracts\Foundation\Application|Factory|View|void
     */
    public function show(FaucetChange $faucetChange)
    {
        return view('admin.faucet_changes.show',compact('faucetChange'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param FaucetChange $faucetChange
     * @return Factory|View
     */
    public function edit(FaucetChange $faucetChange)
    {
        $zones=DB::table('zones')->pluck('name','id');
        return view('admin.faucet_changes.edit',compact('faucetChange','zones'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param Request $request
     * @param FaucetChange $faucetChange
     * @return RedirectResponse|Redirector
     */
    public function update(Request $request, FaucetChange $faucetChange)
    {
        $data=$request->validate([
            'provincial_zone_id'=>'required',
            'province_id'=>'required',
            'zone_id'=>'required',
            'total'=>'required',
            'business'=>'required',
            'residential'=>'required',
            'holy_places'=>'required',
            'public_places'=>'required',
            'governmental'=>'required'
        ]);
        $faucetChange->update($data);

        alert()->success('مطلب مورد نظر شما با موفقیت ویرایش شد.');
        return redirect(route('admin.faucet_changes.index'));

    }

    /**
     * Remove the specified resource from storage.
     *
     * @param FaucetChange $faucetChange
     * @return RedirectResponse
     * @throws \Exception
     */
    public function destroy(FaucetChange $faucetChange)
    {
        $faucetChange->delete();
        alert()->success('مطلب مورد نظر شما با موفقیت حذف شد.');
        return back();
    }
}
