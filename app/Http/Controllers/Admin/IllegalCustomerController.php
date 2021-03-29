<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\IllegalCustomer;
use Exception;
use Illuminate\Contracts\View\Factory;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Http\Response;
use Illuminate\Routing\Redirector;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\View\View;

class IllegalCustomerController extends Controller
{

    public function __construct()
    {
        $this->middleware('can:show-illegal-customers')->only(['index']);
        $this->middleware('can:create-illegal-customer')->only(['create','store']);
        $this->middleware('can:edit-illegal-customer')->only(['edit','update']);
        $this->middleware('can:delete-illegal-customer')->only(['destroy']);
    }

    /**
     * Display a listing of the resource.
     *
     * @return Factory|View
     */
    public function index()
    {
        $illegal_customers=IllegalCustomer::latest()->paginate();
        $user=Auth::user();
        return view('admin.illegal_customers.all',compact('illegal_customers','user'));

    }

    /**
     * Show the form for creating a new resource.
     *
     * @param IllegalCustomer $illegalCustomer
     * @return Factory|View
     */
    public function create(IllegalCustomer $illegalCustomer)
    {
        $zones=DB::table('zones')->pluck('name','id');
        return view('admin.illegal_customers.create',compact('zones','illegalCustomer'));
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
        'total'=>'required',
        'action'=>'required'
    ]);
        IllegalCustomer::create($data);
        alert()->success('مطلب مورد نظر شما با موفقیت ایجاد شد.');

        if($request->register=='system_register') {
            return redirect(route('admin.customers.create'));
        }
        else {
            return redirect(route('admin.illegal_customers.index'));
        }



    }

    /**
     * Display the specified resource.
     *
     * @param IllegalCustomer $illegalCustomer
     * @return \Illuminate\Contracts\Foundation\Application|Factory|View|void
     */
    public function show(IllegalCustomer $illegalCustomer)
    {
        return view('admin.illegal_customers.show',compact('illegalCustomer'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param IllegalCustomer $illegalCustomer
     * @return Factory|View
     */
    public function edit(IllegalCustomer $illegalCustomer)
    {
        $zones=DB::table('zones')->pluck('name','id');
        return view('admin.illegal_customers.edit',compact('illegalCustomer','zones'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param Request $request
     * @param IllegalCustomer $illegalCustomer
     * @return RedirectResponse|Redirector
     */
    public function update(Request $request, IllegalCustomer $illegalCustomer)
    {
        $data=$request->validate([
            'provincial_zone_id'=>'required',
            'zone_id'=>'required',
            'province_id'=>'required',
            'total'=>'required',
            'action'=>'required'
        ]);
        $illegalCustomer->update($data);
        alert()->success('مطلب مورد نظر شما با موفقیت ویرایش شد.');

        if($request->register=='system_register') {
            return redirect(route('admin.customers.create'));
        }
        else {
            return redirect(route('admin.illegal_customers.index'));
        }
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param IllegalCustomer $illegalCustomer
     * @return RedirectResponse
     * @throws Exception
     */
    public function destroy(IllegalCustomer $illegalCustomer)
    {
        $illegalCustomer->delete();
        alert()->success('مطلب مورد نظر شما با موفقیت حذف شد.');
        return back();

    }
}
