<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\WaterTest;
use App\Zone;
use Illuminate\Contracts\Foundation\Application;
use Illuminate\Contracts\View\Factory;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Http\Response;
use Illuminate\Routing\Redirector;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\View\View;

class WaterTestController extends Controller
{
    public function __construct()
    {
        $this->middleware('can:show-water-tests')->only(['index']);
        $this->middleware('can:create-water-test')->only(['create','store']);
        $this->middleware('can:edit-water-test')->only(['edit','update']);
        $this->middleware('can:delete-water-test')->only(['destroy']);
    }
    /**
     * Display a listing of the resource.
     *
     * @return Application|Factory|View|void
     */
    public function index()
    {
        $water_tests=WaterTest::latest()->paginate(10);
        $user=Auth::user();
        return view('admin.water_tests.all',compact('water_tests','user'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return Application|Factory|Response|View
     */
    public function create()
    {
        $zones=DB::table('zones')->pluck('name','id');
        return view('admin.water_tests.create',compact('zones'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param Request $request
     * @return Application|RedirectResponse|Response|Redirector
     */
    public function store(Request $request)
    {
        $data=$request->validate([
           'zone_id'=>'required',
           'province_id'=>'required',
           'provincial_zone_id'=>'required',
            'count_of_instance'=>'required',
            'parameters'=>'required'
        ]);

        WaterTest::create($data);
        alert()->success('مطلب مورد نظر شما با موفقیت ثبت شد.');
        return redirect(route('admin.water_tests.index'));
    }

    /**
     * Display the specified resource.
     *
     * @param WaterTest $waterTest
     * @return Application|Factory|View|void
     */
    public function show(WaterTest $waterTest)
    {
        return view('admin.water_tests.show',compact('waterTest'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param WaterTest $waterTest
     * @return Application|Factory|View|void
     */
    public function edit(WaterTest $waterTest)
    {
        $zones=DB::table('zones')->pluck('name','id');
        return view('admin.water_tests.edit',compact('waterTest','zones'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param Request $request
     * @param WaterTest $waterTest
     * @return Application|RedirectResponse|Redirector|void
     */
    public function update(Request $request, WaterTest $waterTest)
    {
        $data=$request->validate([
            'zone_id'=>'required',
            'province_id'=>'required',
            'provincial_zone_id'=>'required',
            'count_of_instance'=>'required',
            'parameters'=>'required'
        ]);

        $waterTest->update($data);
        alert()->success('مطلب مورد نظر شما با موفقیت ویرایش شد.');
        return redirect(route('admin.water_tests.index'));
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param WaterTest $waterTest
     * @return void
     */
    public function destroy(WaterTest  $waterTest)
    {
        $waterTest->delete();
        alert()->success('مطلب مورد نظر شما با موفقیت ویرایش شد.');
        return back();

    }
}
