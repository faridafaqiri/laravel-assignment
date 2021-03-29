<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Source;
use Illuminate\Contracts\View\Factory;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Http\Response;
use Illuminate\Routing\Redirector;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\View\View;

class SourceController extends Controller
{

    public function __construct()
    {
        $this->middleware('can:show-sources')->only(['index']);
        $this->middleware('can:create-source')->only(['create','store']);
        $this->middleware('can:edit-source')->only(['edit','update']);
        $this->middleware('can:delete-source')->only(['destroy']);
    }
    /**
     * Display a listing of the resource.
     *
     * @return Factory|View
     */
    public function index()
    {
        $sources=Source::latest()->paginate(20);
        $user=Auth::user();
        return view('admin.sources.all',compact('sources','user'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return Factory|View
     */
    public function create()
    {
        $zones=DB::table('zones')->pluck('name','id');
        return view('admin.sources.create',compact('zones'));
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
           'total_source'=>'required',
           'source_type_id'=>'required',
           'total_pumps'=>'required',
            'total_active'=>'required',
        ]);
        Source::create($data);
        alert()->success('مطلب مورد نظر شما با موفقیت ایجاد شد.');
        return redirect(route('admin.sources.index'));
    }

    /**
     * Display the specified resource.
     *
     * @param Source $source
     * @return \Illuminate\Contracts\Foundation\Application|Factory|View|void
     */
    public function show(Source $source)
    {
        return view('admin.sources.show',compact('source'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param Source $source
     * @return Factory|View
     */
    public function edit(Source $source)
    {
        $zones=DB::table('zones')->pluck('name','id');
        return view('admin.sources.edit',compact('source','zones'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param Request $request
     * @param Source $source
     * @return RedirectResponse|Redirector
     */
    public function update(Request $request, Source $source)
    {
        $data=$request->validate([
            'provincial_zone_id'=>'required',
            'zone_id'=>'required',
            'province_id'=>'required',
            'source_type_id'=>'required',
            'total_source'=>'required',
            'total_pumps'=>'required',
            'total_active'=>'required'
        ]);
        $source->update($data);
        alert()->success('مطلب مورد نظر شما با موفقیت ویرایش شد.');
        return redirect(route('admin.sources.index'));

    }

    /**
     * Remove the specified resource from storage.
     *
     * @param Source $source
     * @return RedirectResponse
     * @throws \Exception
     */
    public function destroy(Source $source)
    {
        $source->delete();
        alert()->success('مطلب مورد نظر شما با موفقیت حذف شد.');
        return back();
    }
}
