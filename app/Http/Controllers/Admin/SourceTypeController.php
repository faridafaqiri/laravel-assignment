<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Source_type;
use Illuminate\Contracts\View\Factory;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Http\Response;
use Illuminate\Routing\Redirector;
use Illuminate\Support\Facades\Auth;
use Illuminate\View\View;

class SourceTypeController extends Controller
{
    public function __construct()
    {
        $this->middleware('can:show-source-types')->only(['index']);
        $this->middleware('can:create-source-type')->only(['create','store']);
        $this->middleware('can:edit-source-type')->only(['edit','update']);
        $this->middleware('can:delete-source-type')->only(['destroy']);
    }
    /**
     * Display a listing of the resource.
     *
     * @return Factory|View
     */
    public function index()
    {
        $source_types=Source_type::latest()->paginate(20);
        $user=Auth::user();
        return view('admin.source_types.all',compact('source_types','user'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return Factory|View
     */
    public function create()
    {
        return  view('admin.source_types.create');
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
           'name'=>'required',
        ]);
        Source_type::create($data);
        alert()->success('مطلب مورد نظر شما با موفقیت ثبت شد.');
        return redirect(route('admin.source_types.index'));
    }

    /**
     * Display the specified resource.
     *
     * @param int $id
     * @return void
     */
    public function show()
    {

    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param Source_type $source_type
     * @return Factory|View
     */
    public function edit(Source_type $source_type)
    {
        return view('admin.source_types.edit',compact('source_type'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param Request $request
     * @param Source_type $source_type
     * @return RedirectResponse|Redirector
     */
    public function update(Request $request, Source_type $source_type)
    {
        $data=$request->validate([
           'name'=>'required',
        ]);
        $source_type->update($data);
        alert()->success('مطلب مورد نظر شما با موفقیت ویرایش شد');
        return redirect(route('admin.source_types.index'));
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param Source_type $source_type
     * @return RedirectResponse
     * @throws \Exception
     */
    public function destroy(Source_type $source_type)
    {
        $source_type->delete();
        alert()->success('مطلب مورد نظر ما با موفقیت حذف شد');
        return back();
    }
}
