<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Role;
use Illuminate\Contracts\View\Factory;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Http\Response;
use Illuminate\Routing\Redirector;
use Illuminate\Validation\Rule;
use Illuminate\View\View;

class RoleController extends Controller
{

    public function __construct()
    {
        $this->middleware('can:show-roles')->only(['index']);
        $this->middleware('can:create-role')->only(['create','store']);
        $this->middleware('can:edit-role')->only(['edit','update']);
        $this->middleware('can:delete-role')->only(['destroy']);
    }
    /**
     * Display a listing of the resource.
     *
     * @return Factory|View
     */
    public function index()
    {
        $roles=Role::query();
        if($keyword=request('search')){
            $roles->where('name','LIKE',"%{$keyword}%")
                ->orWhere('label','LIKE',"%{$keyword}%");
        }

        $roles=$roles->latest()->paginate(20);
        return view('admin.roles.all',compact('roles'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return Factory|View
     */
    public function create()
    {
        return view('admin.roles.create');
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
            'name' => ['required', 'string', 'max:255', 'unique:roles'],
            'label' => ['required', 'string', 'max:255'],
            'permissions'=>['required','array']
        ]);
       $role= Role::create($data);
       $role->permissions()->sync($data['permissions']);
        return redirect(route('admin.roles.index'));


    }

    /**
     * Display the specified resource.
     *
     * @param Role $role
     * @return Response
     */
    public function show(Role $role)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param Role $role
     * @return Factory|View
     */
    public function edit(Role $role)
    {
        return view('admin.roles.edit',compact('role'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param Request $request
     * @param Role $role
     * @return RedirectResponse|Redirector
     */
    public function update(Request $request, Role $role)
    {
        $data=$request->validate([
            'name' => ['required', 'string', 'max:255', Rule::unique('roles')->ignore($role->id)],
            'label' => ['required', 'string', 'max:255'],
            'permissions'=>['required','array']
        ]);
        $role->update($data);
        $role->permissions()->sync($data['permissions']);
        alert()->success('مطلب مورد نظر شما با موفقیت ویرایش شد.');
        return redirect(route('admin.roles.index'));
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param Role $role
     * @return RedirectResponse
     * @throws \Exception
     */
    public function destroy(Role $role)
    {
        $role->delete();
        alert()->success('مطلب مورد نظر شما با موفقیت حذف شد');
        return back();
    }
}
