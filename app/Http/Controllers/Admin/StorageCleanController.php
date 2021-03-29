<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\StorageClean;
use Exception;
use foo\bar;
use Illuminate\Contracts\View\Factory;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Http\Response;
use Illuminate\Routing\Redirector;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\View\View;

class StorageCleanController extends Controller
{
    public function __construct()
    {
        $this->middleware('can:show-storage-cleans')->only(['index']);
        $this->middleware('can:create-storage-clean')->only(['create','store']);
        $this->middleware('can:edit-storage-clean')->only(['edit','update']);
        $this->middleware('can:delete-storage-clean')->only(['destroy']);
    }
    /**
     * Display a listing of the resource.
     *
     * @return Factory|View
     */
    public function index()
    {
        $storage_cleans=StorageClean::latest()->paginate(10);
        $user=Auth::user();
        return view('admin.storage_cleans.all',compact('storage_cleans','user'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return Factory|View
     */
    public function create()
    {
        $zones=DB::table('zones')->pluck('name','id');
        return view('admin.storage_cleans.create',compact('zones'));
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
           'chlorine_type'=>'required',
           'chlorine_amount'=>'required',
           'unite'=>'required',
            'count'=>'required'
        ]);
        StorageClean::create($data);
        alert()->success('مطلب مورد نظر شما با موفقیت ثبت شد.');
        return redirect(route('admin.storage_cleans.index'));
    }

    /**
     * Display the specified resource.
     *
     * @param StorageClean $storageClean
     * @return \Illuminate\Contracts\Foundation\Application|Factory|View|void
     */
    public function show(StorageClean $storageClean)
    {
        return view('admin.storage_cleans.show',compact('storageClean'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param StorageClean $storageClean
     * @return Factory|View
     */
    public function edit(StorageClean $storageClean)
    {
        $zones=DB::table('zones')->pluck('name','id');
        return view('admin.storage_cleans.edit',compact('storageClean','zones'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param Request $request
     * @param StorageClean $storageClean
     * @return RedirectResponse|Redirector
     */
    public function update(Request $request, StorageClean $storageClean)
    {
        $data=$request->validate([
            'provincial_zone_id'=>'required',
            'zone_id'=>'required',
            'province_id'=>'required',
            'chlorine_type'=>'required',
            'chlorine_amount'=>'required',
            'unite'=>'required',
            'count'=>'required'
        ]);
        $storageClean->update($data);
        alert()->success('مطلب مورد نظر شما با موفقیت ویرایش شد.');
        return redirect(route('admin.storage_cleans.index'));
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param StorageClean $storageClean
     * @return RedirectResponse
     * @throws Exception
     */
    public function destroy(StorageClean $storageClean)
    {
        $storageClean->delete();
        alert()->success('مطلب مورد نظر شما با موفقیت ویرایش شد.');
        return back();
    }
}
