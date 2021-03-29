<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\WallControlling;
use Illuminate\Contracts\Foundation\Application;
use Illuminate\Contracts\View\Factory;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Http\Response;
use Illuminate\Routing\Redirector;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\View\View;

class WallControllingController extends Controller
{
    public function __construct()
    {
        $this->middleware('can:show-wall-controllings')->only(['index']);
        $this->middleware('can:create-wall-controlling')->only(['create','store']);
        $this->middleware('can:edit-wall-controlling')->only(['edit','update']);
        $this->middleware('can:delete-wall-controlling')->only(['destroy']);
    }
    /**
     * Display a listing of the resource.
     *
     * @return Application|Factory|Response|View
     */
    public function index()
    {
        $wall_controllings=WallControlling::latest()->paginate(10);
        $user=Auth::user();
        return view('admin.wall_controllings.all',compact('wall_controllings','user'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return Application|Factory|Response|View
     */
    public function create()
    {
        $zones=DB::table('zones')->pluck('name','id');
        return view('admin.wall_controllings.create',compact('zones'));
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
            'number'=>'required',
            'active'=>'required'
        ]);
        WallControlling::create($data);
        alert()->success('مطلب مورد نظر شما با موفقیت ثبت شد.');
        return redirect(route('admin.wall_controllings.index'));
    }

    /**
     * Display the specified resource.
     *
     * @param WallControlling $wallControlling
     * @return Application|Factory|View|void
     */
    public function show(WallControlling $wallControlling)
    {
        return view('admin.wall_controllings.show',compact('wallControlling'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param WallControlling $wallControlling
     * @return Application|Factory|Response|View
     */
    public function edit(WallControlling $wallControlling)
    {
        $zones=DB::table('zones')->pluck('name','id');
        return view('admin.wall_controllings.edit',compact('wallControlling','zones'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param Request $request
     * @param WallControlling $wallControlling
     * @return Application|RedirectResponse|Redirector|void
     */
    public function update(Request $request, WallControlling $wallControlling)
    {
        $data=$request->validate([
            'zone_id'=>'required',
            'province_id'=>'required',
            'provincial_zone_id'=>'required',
            'number'=>'required',
            'active'=>'required'
        ]);
        $wallControlling->update($data);
        alert()->success('مطلب مورد نظر شما با موفقیت ویرایش شد.');
        return redirect(route('admin.wall_controllings.index'));
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param WallControlling $wallControlling
     * @return RedirectResponse
     * @throws \Exception
     */
    public function destroy(WallControlling $wallControlling)
    {
        $wallControlling->delete();
        alert()->success('مطلب مورد نظر شما با موفقیت حذف شد.');
        return back();
    }
}
