<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\MeterReading;
use Illuminate\Contracts\View\Factory;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Http\Response;
use Illuminate\Routing\Redirector;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\View\View;

class MeterReadingController extends Controller
{
    public function __construct()
    {
        $this->middleware('can:show-meter-readings')->only(['index']);
        $this->middleware('can:create-meter-reading')->only(['create','store']);
        $this->middleware('can:edit-meter-reading')->only(['edit','update']);
        $this->middleware('can:delete-meter-reading')->only(['destroy']);
    }
    /**
     * Display a listing of the resource.
     *
     * @return Factory|View
     */
    public function index()
    {
        $meter_readings=MeterReading::latest()->paginate(10);
        $user=Auth::user();
        return view('admin.meter_readings.all',compact('meter_readings','user'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return Factory|View
     */
    public function create()
    {
        $zones=DB::table('zones')->pluck('name','id');
        return view('admin.meter_readings.create',compact('zones'));
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
           'meter_reader_id'=>'required',
           'total_read'=>'required',
        ]);
        MeterReading::create($data);
        alert()->success('مطلب مورد نظر شما با موفقیت ثبت شد.');
        return redirect(route('admin.meter_readings.index'));
    }

    /**
     * Display the specified resource.
     *
     * @param MeterReading $meterReading
     * @return \Illuminate\Contracts\Foundation\Application|Factory|View|void
     */
    public function show(MeterReading $meterReading)
    {
        return view('admin.meter_readings.show',compact('meterReading'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param MeterReading $meterReading
     * @return Factory|View
     */
    public function edit(MeterReading $meterReading)
    {
        $zones=DB::table('zones')->pluck('name','id');
        return view('admin.meter_readings.edit',compact('meterReading','zones'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param Request $request
     * @param MeterReading $meterReading
     * @return RedirectResponse|Redirector
     */
    public function update(Request $request, MeterReading $meterReading)
    {
        $data=$request->validate([
            'provincial_zone_id'=>'required',
            'zone_id'=>'required',
            'province_id'=>'required',
            'meter_reader_id'=>'required',
            'total_read'=>'required',
        ]);
        $meterReading->update($data);
        alert()->success('مطلب مورد نظر شما با موفقیت ویرایش شد.');
        return redirect(route('admin.meter_readings.index'));
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param MeterReading $meterReading
     * @return RedirectResponse
     * @throws \Exception
     */
    public function destroy(MeterReading $meterReading)
    {
        $meterReading->delete();
        alert()->success('مطلب مورد نظر شما با موفقیت حذف شد.');
        return back();
    }
}
