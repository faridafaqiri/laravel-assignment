<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Signboard;
use Exception;
use Illuminate\Contracts\View\Factory;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Http\Response;
use Illuminate\Routing\Redirector;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\View\View;

class SignboardController extends Controller
{
    public function __construct()
    {
        $this->middleware('can:show-signboards')->only(['index']);
        $this->middleware('can:create-signboard')->only(['create','store']);
        $this->middleware('can:edit-signboard')->only(['edit','update']);
        $this->middleware('can:delete-signboard')->only(['destroy']);
    }
    /**
     * Display a listing of the resource.
     *
     * @return Factory|View
     */
    public function index()
    {
        $signboards=Signboard::latest()->paginate(10);
        $user=Auth::user();
        return view('admin.signboards.all',compact('signboards','user'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return Factory|View
     */
    public function create()
    {
        $zones=DB::table('zones')->pluck('name','id');
        return view('admin.signboards.create',compact('zones'));

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
            'total'=>'required'
        ]);
        Signboard::create($data);
        alert()->success('مطلب مورد نظر شما با موفقیت ثبت شد');
        return redirect(route('admin.signboards.index'));
    }

    /**
     * Display the specified resource.
     *
     * @param Signboard $signboard
     * @return \Illuminate\Contracts\Foundation\Application|Factory|View|void
     */
    public function show(Signboard $signboard)
    {
        return view('admin.signboards.show',compact('signboard'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param Signboard $signboard
     * @return Factory|View
     */
    public function edit(Signboard $signboard)
    {
        $zones=DB::table('zones')->pluck('name','id');
        return view('admin.signboards.edit',compact('signboard','zones'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param Request $request
     * @param Signboard $signboard
     * @return RedirectResponse|Redirector
     */
    public function update(Request $request, Signboard $signboard)
    {
        $data=$request->validate([
            'provincial_zone_id'=>'required',
            'zone_id'=>'required',
            'province_id'=>'required',
            'total'=>'required'
        ]);
        $signboard->update($data);
        alert()->success('مطلب مورد نظر شما با موفقیت ویرایش شد');
        return redirect(route('admin.signboards.index'));
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param Signboard $signboard
     * @return RedirectResponse
     * @throws Exception
     */
    public function destroy(Signboard $signboard)
    {
        $signboard->delete();
        alert()->success('مطلب مورد نظر شما با موفقیت حذف شد');
        return back();
    }
}
