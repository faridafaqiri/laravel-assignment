<?php

namespace App\Http\Controllers\Admin;

use App\ChangeWebLength;
use App\Http\Controllers\Controller;
use Illuminate\Contracts\Foundation\Application;
use Illuminate\Contracts\View\Factory;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Http\Response;
use Illuminate\Support\Facades\DB;
use Illuminate\View\View;
use Illuminate\Support\Facades\Auth;

class ChangeWebLengthController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return Application|Factory|Response|View
     */
    public function index()
    {
        $change_web_lengths=ChangeWebLength::latest()->paginate(10);
        $user=Auth::user();
        return view('admin.change_web_lengths.all',compact('change_web_lengths','user'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return Application|Factory|Response|View
     */
    public function create()
    {
        $zones=DB::table('zones')->pluck('name','id');
        return view('admin.change_web_lengths.create',compact('zones'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param Request $request
     * @return Application|Factory|View|void
     */
    public function store(Request $request)
    {
        $data=$request->validate([
            'zone_id'=>'required',
            'province_id'=>'required',
            'provincial_zone_id'=>'required',
            'tran_dist'=>'required',
            'length'=>'required',
        ]);
        ChangeWebLength::create($data);
        alert()->success('مطلب مورد نظر با موفقیت ثبت شد.');
        return redirect(route('admin.change_web_lengths.index'));

    }

    /**
     * Display the specified resource.
     *
     * @param ChangeWebLength $changeWebLength
     * @return Application|Factory|View|void
     */
    public function show(ChangeWebLength $changeWebLength)
    {
        return view('admin.change_web_lengths.show',compact('changeWebLength'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param ChangeWebLength $changeWebLength
     * @return Application|Factory|Response|View
     */
    public function edit(ChangeWebLength $changeWebLength)
    {
        $zones=DB::table('zones')->pluck('name','id');
        return view('admin.change_web_lengths.edit',compact('changeWebLength','zones'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param Request $request
     * @param ChangeWebLength $changeWebLength
     * @return Application|Factory|Response|View
     */
    public function update(Request $request, ChangeWebLength $changeWebLength)
    {
        $data=$request->validate([
            'zone_id'=>'required',
            'province_id'=>'required',
            'provincial_zone_id'=>'required',
            'tran_dist'=>'required',
            'length'=>'required',
        ]);
        $changeWebLength->update($data);
        alert()->success('مطلب مورد نظر با موفقیت ویرایش شد.');
        return redirect(route('admin.change_web_lengths.index'));
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param ChangeWebLength $changeWebLength
     * @return RedirectResponse
     * @throws \Exception
     */
    public function destroy(ChangeWebLength $changeWebLength)
    {
        $changeWebLength->delete();
        alert()->success('مطلب مورد نظر با موفقیت حذف شد.');
        return  back();
    }
}
