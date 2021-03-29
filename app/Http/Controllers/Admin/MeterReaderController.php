<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\MeterReader;
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

class MeterReaderController extends Controller
{
    public function __construct()
    {
        $this->middleware('can:show-meter-readers')->only(['index']);
        $this->middleware('can:create-meter-reader')->only(['create','store']);
        $this->middleware('can:edit-meter-reader')->only(['edit','update']);
        $this->middleware('can:delete-meter-reader')->only(['destroy']);
    }

    /**
     * Display a listing of the resource.
     *
     * @return Factory|View
     */
    public function index()
    {
        $meter_readers=MeterReader::latest()->paginate(10);
        $user=Auth::user();
        return view('admin.meter_readers.all',compact('meter_readers','user'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return Factory|View
     */
    public function create()
    {
        $zones=DB::table('zones')->pluck('name','id');
        return view('admin.meter_readers.create',compact('zones'));
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
           'name'=>'required',
            'age'=>'required',
            'address'=>'nullable',
            'degree'=>'required',
            'area'=>'required'
        ]);
        MeterReader::create($data);
        alert()->success('مطلب مورد نظر شما با موفقیت ثبت شد.');
        return redirect(route('admin.meter_readers.index'));

    }

    /**
     * Display the specified resource.
     *
     * @param MeterReader $meterReader
     * @return Application|Factory|View|void
     */
    public function show(MeterReader $meterReader)
    {
        return view('admin.meter_readers.show',compact('meterReader'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param MeterReader $meterReader
     * @return Factory|View
     */
    public function edit(MeterReader $meterReader)
    {
        $zones=DB::table('zones')->pluck('name','id');
        return view('admin.meter_readers.edit',compact('meterReader','zones'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param Request $request
     * @param MeterReader $meterReader
     * @return RedirectResponse|Redirector
     */
    public function update(Request $request, MeterReader $meterReader)
    {
        $data=$request->validate([
            'zone_id'=>'required',
            'province_id'=>'required',
            'provincial_zone_id'=>'required',
            'name'=>'required',
            'age'=>'required',
            'address'=>'nullable',
            'degree'=>'required',
            'area'=>'required'
        ]);
        $meterReader->update($data);
        alert()->success('مطلب مورد نظر شما با موفقیت ویرایش شد.');
        return redirect(route('admin.meter_readers.index'));
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param MeterReader $meterReader
     * @return RedirectResponse
     * @throws Exception
     */
    public function destroy(MeterReader $meterReader)
    {
        $meterReader->delete();
        alert()->success('مطلب مورد نظر شما با موفقیت حذف شد.');
        return back();
    }
}
