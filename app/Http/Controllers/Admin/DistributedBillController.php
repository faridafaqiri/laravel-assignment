<?php

namespace App\Http\Controllers\Admin;

use App\DistributedBill;
use App\Http\Controllers\Controller;
use Illuminate\Contracts\View\Factory;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Http\Response;
use Illuminate\Routing\Redirector;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\View\View;

class DistributedBillController extends Controller
{

    public function __construct()
    {
        $this->middleware('can:show-distributed-bills')->only(['index']);
        $this->middleware('can:create-distributed-bill')->only(['create','store']);
        $this->middleware('can:edit-distributed-bill')->only(['edit','update']);
        $this->middleware('can:delete-distributed-bill')->only(['destroy']);
    }

    /**
     * Display a listing of the resource.
     *
     * @return Factory|View
     */
    public function index()
    {
        $distributed_bills=DistributedBill::latest()->paginate(20);
        $user=Auth::user();
        return view('admin.distributed_bills.all',compact('distributed_bills','user'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return Factory|View
     */
    public function create()
    {
        $zones=DB::table('zones')->pluck('name','id');
        return view('admin.distributed_bills.create',compact('zones'));
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
           'total_distributed'=>'required'
        ]);
        DistributedBill::create($data);
        alert()->success('مطلب مورد نظر شما با موفقیت ثبت شد.');
        return redirect(route('admin.distributed_bills.index'));

    }

    /**
     * Display the specified resource.
     *
     * @param DistributedBill $distributedBill
     * @return \Illuminate\Contracts\Foundation\Application|Factory|View|void
     */
    public function show(DistributedBill $distributedBill)
    {
        return view('admin.distributed_bills.show',compact('distributedBill'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param DistributedBill $distributedBill
     * @return Factory|View
     */
    public function edit(DistributedBill $distributedBill)
    {
        $zones=DB::table('zones')->pluck('name','id');
        return view('admin.distributed_bills.edit',compact('distributedBill','zones'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param Request $request
     * @param DistributedBill $distributedBill
     * @return RedirectResponse|Redirector
     */
    public function update(Request $request, DistributedBill $distributedBill)
    {
        $data=$request->validate([
            'zone_id'=>'required',
            'province_id'=>'required',
            'provincial_zone_id'=>'required',
            'total_distributed'=>'required'
        ]);
        $distributedBill->update($data);
        alert()->success('مطلب مورد نظر شما با موفقیت ویرایش شد.');
        return redirect(route('admin.distributed_bills.index'));
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param DistributedBill $distributedBill
     * @return RedirectResponse
     * @throws \Exception
     */
    public function destroy(DistributedBill $distributedBill)
    {
        $distributedBill->delete();
        alert()->success('مطلب مورد نظر شما با موفقیت حذش شد');
        return back();

    }
}
