<?php

namespace App\Http\Controllers\Admin;

use App\CoveredPopulation;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;

class CoveredPopulationController extends Controller
{

    public function __construct()
    {
        $this->middleware('can:show-covered-populations')->only(['index']);
        $this->middleware('can:create-covered-population')->only(['create','store']);
        $this->middleware('can:edit-covered-population')->only(['edit','update']);
        $this->middleware('can:delete-covered-population')->only(['destroy']);
    }
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Contracts\Foundation\Application|\Illuminate\Contracts\View\Factory|\Illuminate\Http\Response|\Illuminate\View\View
     */
    public function index()
    {
        $covered_populations=CoveredPopulation::latest()->paginate(10);
        $user=Auth::user();
        return view('admin.covered_populations.all',compact('covered_populations','user'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Contracts\Foundation\Application|\Illuminate\Contracts\View\Factory|\Illuminate\Http\Response|\Illuminate\View\View
     */
    public function create()
    {
        $zones=DB::table('zones')->pluck('name','id');
        return view('admin.covered_populations.create',compact('zones'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Contracts\Foundation\Application|\Illuminate\Http\RedirectResponse|\Illuminate\Http\Response|\Illuminate\Routing\Redirector
     */
    public function store(Request $request)
    {
        $data=$request->validate([
           'zone_id'=>'required',
           'population'=>'required',
           'year'=>'required',
           'm_residential'=>'required',
           'm_business'=>'required',
           'm_holyPlaces'=>'required',
           'm_public'=>'required',
           'm_governmental'=>'required'
        ]);
        CoveredPopulation::create($data);
        alert()->success('مطلب مورد نظر شما با موفقیت ثبت شد.');
        return redirect(route('admin.covered_populations.index'));
    }

    /**
     * Display the specified resource.
     *
     * @param CoveredPopulation $coveredPopulation
     * @return \Illuminate\Contracts\Foundation\Application|\Illuminate\Contracts\View\Factory|\Illuminate\View\View|void
     */
    public function show(CoveredPopulation $coveredPopulation)
    {
        return view('admin.covered_populations.show',compact('coveredPopulation'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param CoveredPopulation $coveredPopulation
     * @return \Illuminate\Contracts\Foundation\Application|\Illuminate\Contracts\View\Factory|\Illuminate\View\View|void
     */
    public function edit(CoveredPopulation $coveredPopulation)
    {
        $zones=DB::table('zones')->pluck('name','id');
        return view('admin.covered_populations.edit',compact('coveredPopulation','zones'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param \Illuminate\Http\Request $request
     * @param CoveredPopulation $coveredPopulation
     * @return \Illuminate\Contracts\Foundation\Application|\Illuminate\Http\RedirectResponse|\Illuminate\Http\Response|\Illuminate\Routing\Redirector
     */
    public function update(Request $request, CoveredPopulation $coveredPopulation)
    {
        $data=$request->validate([
            'zone_id'=>'required',
            'population'=>'required',
            'year'=>'required',
            'm_residential'=>'required',
            'm_business'=>'required',
            'm_holyPlaces'=>'required',
            'm_public'=>'required',
            'm_governmental'=>'required'
        ]);
        $coveredPopulation->update($data);
        alert()->success('مطلب مورد نظر شما با موفقیت ویرایش شد.');
        return redirect(route('admin.covered_populations.index'));
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param CoveredPopulation $coveredPopulation
     * @return \Illuminate\Http\RedirectResponse|void
     */
    public function destroy(CoveredPopulation $coveredPopulation)
    {
        $coveredPopulation->delete();
        alert()->success('مطلب مورد نظر شما با موفقیت حذف شد.');
        return back();
    }
}
