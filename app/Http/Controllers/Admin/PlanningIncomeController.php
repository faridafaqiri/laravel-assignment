<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\PlanningIncome;
use App\Zone;
use Illuminate\Contracts\Foundation\Application;
use Illuminate\Contracts\View\Factory;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Routing\Redirector;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\View\View;

class PlanningIncomeController extends Controller
{

    public function __construct()
    {
        $this->middleware('can:show-planning-incomes')->only(['index']);
        $this->middleware('can:create-planning-income')->only(['create','store']);
        $this->middleware('can:edit-planning-income')->only(['edit','update']);
        $this->middleware('can:delete-planning-income')->only(['destroy']);
    }

    /**
     * Display a listing of the resource.
     *
     * @return Application|Factory|Response|View|Application|Factory|View
     */
    public function index()
    {
        $planning_incomes=PlanningIncome::latest()->paginate(10);
        $user=Auth::user();
        return view('admin.planning_incomes.all',compact('planning_incomes','user'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return Application|Factory|Response|View
     */
    public function create()
    {
        $zones=DB::table('zones')->pluck('name','id');
        return view('admin.planning_incomes.create',compact('zones'));
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
            'planningIncome'=>'required',
            'BillingIncome'=>'required'
        ]);
        PlanningIncome::create($data);
        alert()->success('مطلب مورد نظر شما با موفقیت ثبت شد.');
        return redirect(route('admin.planning_incomes.index'));
    }

    /**
     * Display the specified resource.
     *
     * @param PlanningIncome $planningIncome
     * @return Application|Factory|View|void
     */
    public function show(PlanningIncome $planningIncome)
    {
        return view('admin.planning_incomes.show',compact('planningIncome'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param PlanningIncome $planningIncome
     * @return Application|Factory|View|void
     */
    public function edit(PlanningIncome $planningIncome)
    {
        $zones=DB::table('zones')->pluck('name','id');
        return view('admin.planning_incomes.edit',compact('planningIncome','zones'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param Request $request
     * @param PlanningIncome $planningIncome
     * @return Application|Redirector|RedirectResponse|Application|RedirectResponse|Redirector|void
     */
    public function update(Request $request, PlanningIncome $planningIncome)
    {
        $data=$request->validate([
            'zone_id'=>'required',
            'province_id'=>'required',
            'provincial_zone_id'=>'required',
            'planningIncome'=>'required',
            'BillingIncome'=>'required'
        ]);
        $planningIncome->update($data);
        alert()->success('مطلب مورد نظر شما با موفقیت ویرایش شد.');
        return redirect(route('admin.planning_incomes.index'));
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param PlanningIncome $planningIncome
     * @return RedirectResponse|void
     */
    public function destroy(PlanningIncome $planningIncome)
    {
        $planningIncome->delete();
        alert()->success('مطلب مورد نظر شما با موفقیت حذف شد.');
        return back();
    }
}
