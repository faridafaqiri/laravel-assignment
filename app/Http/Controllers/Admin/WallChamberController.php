<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\WallChamber;
use App\Zone;
use Illuminate\Contracts\Foundation\Application;
use Illuminate\Contracts\View\Factory;
use Illuminate\Http\Request;
use Illuminate\Http\Response;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\View\View;

class WallChamberController extends Controller
{
    public function __construct()
    {
        $this->middleware('can:show-wall-chambers')->only(['index']);
        $this->middleware('can:create-wall-chamber')->only(['create','store']);
        $this->middleware('can:edit-wall-chamber')->only(['edit','update']);
        $this->middleware('can:delete-wall-chamber')->only(['destroy']);
    }

    /**
     * Display a listing of the resource.
     *
     * @return Application|Factory|Response|View
     */
    public function index()
    {
        $wall_chambers=WallChamber::latest()->paginate(10);
        $user=Auth::user();
        return view('admin.wall_chambers.all',compact('wall_chambers','user'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return Application|Factory|Response|View
     */
    public function create()
    {
        $zones=DB::table('zones')->pluck('name','id');
        return view('admin.wall_chambers.create',compact('zones'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param Request $request
     * @return Application|\Illuminate\Http\RedirectResponse|Response|\Illuminate\Routing\Redirector
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
        WallChamber::create($data);
        alert()->success('مطلب مورد نظر شما با موفقیت ثبت شد.');
        return redirect(route('admin.wall_chambers.index'));
    }

    /**
     * Display the specified resource.
     *
     * @param WallChamber $wallChamber
     * @return Application|Factory|View|void
     */
    public function show(WallChamber $wallChamber)
    {
        return view('admin.wall_chambers.show',compact('wallChamber'));

    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param WallChamber $wallChamber
     * @return Application|Factory|Response|View
     */
    public function edit(WallChamber $wallChamber)
    {
        $zones=DB::table('zones')->pluck('name','id');
        return view('admin.wall_chambers.edit',compact('wallChamber','zones'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param Request $request
     * @param WallChamber $wallChamber
     * @return Application|\Illuminate\Http\RedirectResponse|Response|\Illuminate\Routing\Redirector
     */
    public function update(Request $request, WallChamber $wallChamber)
    {
        $data=$request->validate([
            'zone_id'=>'required',
            'province_id'=>'required',
            'provincial_zone_id'=>'required',
            'number'=>'required',
            'active'=>'required'
        ]);
        $wallChamber->update($data);
        alert()->success('مطلب مورد نظر شما با موفقیت ویرایش شد.');
        return redirect(route('admin.wall_chambers.index'));
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param WallChamber $wallChamber
     * @return \Illuminate\Http\RedirectResponse|void
     */
    public function destroy(WallChamber $wallChamber)
    {
        $wallChamber->delete();
        alert()->success('مطلب مورد نظر شما با موفقیت حذف شد.');
        return back();
    }
}
