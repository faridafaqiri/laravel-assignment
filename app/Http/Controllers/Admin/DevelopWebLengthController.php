<?php

namespace App\Http\Controllers\Admin;

use App\DevelopWebLength;
use App\Http\Controllers\Controller;
use Illuminate\Contracts\Foundation\Application;
use Illuminate\Contracts\View\Factory;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Http\Response;
use Illuminate\Routing\Redirector;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\View\View;

class DevelopWebLengthController extends Controller
{

    public function __construct()
    {
        $this->middleware('can:show-develop-web-lengths')->only(['index']);
        $this->middleware('can:create-develop-web-length')->only(['create','store']);
        $this->middleware('can:edit-develop-web-length')->only(['edit','update']);
        $this->middleware('can:delete-develop-web-length')->only(['destroy']);
    }

    /**
     * Display a listing of the resource.
     *
     * @return Application|Factory|Response|View
     */
    public function index()
    {
        $develop_web_lengths=DevelopWebLength::latest()->paginate(10);
        $user=Auth::user();
        return view('admin.develop_web_lengths.all',compact('develop_web_lengths','user'));

    }

    /**
     * Show the form for creating a new resource.
     *
     * @return Application|Factory|Response|View
     */
    public function create()
    {
        $zones=DB::table('zones')->pluck('name','id');
        return view('admin.develop_web_lengths.create',compact('zones'));
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
            'develop_distributive_web_length'=>'required',
            'develop_transitive_web_length'=>'required'
        ]);
        DevelopWebLength::create($data);
        alert()->success('مطلب مورد نظر شما با موفقیت ثبت شد.');
        return redirect(route('admin.develop_web_lengths.index'));
    }

    /**
     * Display the specified resource.
     *
     * @param DevelopWebLength $developWebLength
     * @return Application|Factory|View|void
     */
    public function show(DevelopWebLength $developWebLength)
    {
        return view('admin.develop_web_lengths.show',compact('developWebLength'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param DevelopWebLength $developWebLength
     * @return Application|Factory|View|void
     */
    public function edit(DevelopWebLength $developWebLength)
    {
        $zones=DB::table('zones')->pluck('name','id');
        return view('admin.develop_web_lengths.edit',compact('developWebLength','zones'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param Request $request
     * @param DevelopWebLength $developWebLength
     * @return Application|RedirectResponse|Redirector|void
     */
    public function update(Request $request, DevelopWebLength $developWebLength)
    {
        $data=$request->validate([
            'zone_id'=>'required',
            'province_id'=>'required',
            'provincial_zone_id'=>'required',
            'develop_distributive_web_length'=>'required',
            'develop_transitive_web_length'=>'required'
        ]);
        $developWebLength->update($data);
        alert()->success('مطلب مورد نظر شما با موفقیت ویرایش شد.');
        return redirect(route('admin.develop_web_lengths.index'));
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param DevelopWebLength $developWebLength
     * @return RedirectResponse|void
     */
    public function destroy(DevelopWebLength $developWebLength)
    {
        $developWebLength->delete();
        alert()->success('مطلب مورد نظر شما با موفقیت حذف شد.');
        return back();
    }
}
