<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\PrintedBill;
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

class PrintedBillController extends Controller
{
    public function __construct()
    {
        $this->middleware('can:show-printed-bills')->only(['index']);
        $this->middleware('can:create-printed-bill')->only(['create','store']);
        $this->middleware('can:edit-printed-bill')->only(['edit','update']);
        $this->middleware('can:delete-printed-bill')->only(['destroy']);
    }
    /**
     * Display a listing of the resource.
     *
     * @return Factory|View
     */
    public function index()
    {
        $printed_bills=PrintedBill::latest()->paginate(20);
        $user=Auth::user();
        return view('admin.printed_bills.all',compact('printed_bills','user'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return Factory|View
     */
    public function create()
    {
        $zones=DB::table('zones')->pluck('name','id');
       return view('admin.printed_bills.create',compact('zones'));
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
           'total_printed'=>'required',
           'total_price'=>'required',
           'reprinted'=>'required',
            'description'=>'nullable',
            'type'=>'required'
        ]);
        PrintedBill::create($data);
        alert()->success('مطلب مورد نظر شما با موفقیت ثبت شد');
        return redirect(route('admin.printed_bills.index'));
    }

    /**
     * Display the specified resource.
     *
     * @param PrintedBill $printedBill
     * @return Application|Factory|View|void
     */
    public function show(PrintedBill $printedBill)
    {
        return view('admin.printed_bills.show',compact('printedBill'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param PrintedBill $printedBill
     * @return Factory|View
     */
    public function edit(PrintedBill $printedBill)
    {
        $zones=DB::table('zones')->pluck('name','id');
        return view('admin.printed_bills.edit',compact('printedBill','zones'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param Request $request
     * @param PrintedBill $printedBill
     * @return RedirectResponse|Redirector
     */
    public function update(Request $request, PrintedBill $printedBill)
    {
        $data=$request->validate([
            'zone_id'=>'required',
            'province_id'=>'required',
            'provincial_zone_id'=>'required',
            'total_printed'=>'required',
            'total_price'=>'required',
            'reprinted'=>'required',
            'description'=>'nullable',
            'type'=>'required'
        ]);
        $printedBill->update($data);
        alert()->success('مطلب مورد نظر شما با موفقیت ویرایش شد');
        return redirect(route('admin.printed_bills.index'));
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param PrintedBill $printedBill
     * @return RedirectResponse
     * @throws Exception
     */
    public function destroy(PrintedBill $printedBill)
    {
        $printedBill->delete();
        alert()->success('مطلب مورد نظر شما با موفقیت حذف شد.');
        return back();
    }
}
