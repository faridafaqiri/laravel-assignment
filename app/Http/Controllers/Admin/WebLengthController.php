<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\WebLength;
use Illuminate\Contracts\Foundation\Application;
use Illuminate\Contracts\View\Factory;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Http\Response;
use Illuminate\Routing\Redirector;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\View\View;

class WebLengthController extends Controller
{

    public function __construct()
    {
        $this->middleware('can:show-web-lengths')->only(['index']);
        $this->middleware('can:create-web-length')->only(['create','store']);
        $this->middleware('can:edit-web-length')->only(['edit','update']);
        $this->middleware('can:delete-web-length')->only(['destroy']);
    }
    /**
     * Display a listing of the resource.
     *
     * @return Application|Factory|Response|View
     */
    public function index()
    {
        $web_lengths=WebLength::latest()->paginate(20);
        $user=Auth::user();
        return view('admin.web_lengths.all',compact('web_lengths','user'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return Application|Factory|Response|View
     */
    public function create()
    {
        $zones=DB::table('zones')->pluck('name','id');
        return view('admin.web_lengths.create',compact('zones'));
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
           'distributive_web_length'=>'required',
           'transitive_web_length'=>'required',
        ]);
        WebLength::create($data);
        alert()->success('مطلب مورد نظر شما با موفقیت ثبت شد.');
        return redirect(route('admin.web_lengths.index'));
    }

    /**
     * Display the specified resource.
     *
     * @param WebLength $webLength
     * @return Application|Factory|View|void
     */
    public function show(WebLength $webLength)
    {
        return view('admin.web_lengths.show',compact('webLength'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param WebLength $webLength
     * @return Application|Factory|View|void
     */
    public function edit(WebLength $webLength)
    {
        $zones=DB::table('zones')->pluck('name','id');
        return view('admin.web_lengths.edit',compact('webLength',compact('zones')));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param Request $request
     * @param WebLength $webLength
     * @return Application|RedirectResponse|Redirector|void
     */
    public function update(Request $request, WebLength  $webLength)
    {
        $data=$request->validate([
            'zone_id'=>'required',
            'province_id'=>'required',
            'provincial_zone_id'=>'required',
            'distributive_web_length'=>'required',
            'transitive_web_length'=>'required',
        ]);
        $webLength->update($data);
        alert()->success('مطلب مورد نظر شما با موفقیت ویرایش شد.');
        return redirect(route('admin.web_lengths.index'));
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param WebLength $webLength
     * @return RedirectResponse
     * @throws \Exception
     */
    public function destroy(WebLength $webLength)
    {
        $webLength->delete();
        alert()->success('مطلب مورد نظر شما با موفقیت حذف شد.');
        return back();
    }
}
