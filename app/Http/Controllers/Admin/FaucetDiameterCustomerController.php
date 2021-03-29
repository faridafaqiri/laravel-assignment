<?php

namespace App\Http\Controllers\Admin;

use App\FaucetDiameterCustomers;
use App\Http\Controllers\Controller;
use Illuminate\Contracts\View\Factory;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Http\Response;
use Illuminate\Routing\Redirector;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\View\View;

class FaucetDiameterCustomerController extends Controller
{
    public function __construct(){
        $this->middleware('can:show-faucet-diameter-customers')->only(['index']);
        $this->middleware('can:create-faucet-diameter-customer')->only(['create','store']);
        $this->middleware('can:edit-faucet-diameter-customer')->only(['edit','update']);
        $this->middleware('can:delete-faucet-diameter-customer')->only(['destroy']);
    }
    /**
     * Display a listing of the resource.
     *
     * @return Factory|View
     */
    public function index()
    {
        $faucetDiameterCustomers=FaucetDiameterCustomers::latest()->paginate(10);
        $user=Auth::user();
        return view('admin.faucet_diameter_customers.all',compact('faucetDiameterCustomers','user'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return Factory|View
     */
    public function create()
    {
        $zones=DB::table('zones')->pluck('name','id');
        return view('admin.faucet_diameter_customers.create',compact('zones'));
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
            'half'=>'required',
            'one'=>'required',
            'three_quarter'=>'required'
        ]);
        FaucetDiameterCustomers::create($data);
        alert()->success('مطلب مورد نظر شما با موفقیت ثبت شد');
        return redirect(route('admin.faucet_diameter_customers.index'));
    }

    /**
     * Display the specified resource.
     *
     * @param FaucetDiameterCustomers $faucet_diameter_customer
     * @return \Illuminate\Contracts\Foundation\Application|Factory|View|void
     */
    public function show(FaucetDiameterCustomers $faucet_diameter_customer)
    {
        return view('admin.faucet_diameter_customers.show',compact('faucet_diameter_customer'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param FaucetDiameterCustomers $faucetDiameterCustomer
     * @return Factory|View
     */
    public function edit(FaucetDiameterCustomers $faucetDiameterCustomer)
    {
        $zones=DB::table('zones')->pluck('name','id');
        return view('admin.faucet_diameter_customers.edit',compact('faucetDiameterCustomer','zones'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param Request $request
     * @param FaucetDiameterCustomers $faucetDiameterCustomer
     * @return RedirectResponse|Redirector
     */
    public function update(Request $request, FaucetDiameterCustomers $faucetDiameterCustomer)
    {
        $data=$request->validate([
            'provincial_zone_id'=>'required',
            'zone_id'=>'required',
            'province_id'=>'required',
            'half'=>'required',
            'one'=>'required',
            'three_quarter'=>'required'
        ]);
        $faucetDiameterCustomer->update($data);
        alert()->success('مطلب مورد نظر شما با موفقیت ویرایش شد');
        return redirect(route('admin.faucet_diameter_customers.index'));
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param FaucetDiameterCustomers $faucetDiameterCustomer
     * @return RedirectResponse
     * @throws \Exception
     */
    public function destroy(FaucetDiameterCustomers $faucetDiameterCustomer)
    {
        $faucetDiameterCustomer->delete();

        return back();
    }
}
