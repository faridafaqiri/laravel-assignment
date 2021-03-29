<?php

namespace App\Http\Controllers\Admin\User;

use App\Http\Controllers\Controller;
use App\Permission;
use App\User;
use App\Zone;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class PermissionController extends Controller
{
    public function __construct()
    {
        $this->middleware('can:staff-user-permissions')->only(['create','store']);

    }

    public function create(User $user){
        $zones=DB::table('zones')->pluck('name','id');
        return view('admin.users.permissions',compact('user','zones'));
    }

    public function store(Request $request,User $user){

        $data=$request->validate([

            'roles'=>['required','array'],
            'selectedProvincialZones'=>['required','array'],
        ]);
        $user->permissions()->sync($request->permissions);
        $user->provincialZones()->sync($data['selectedProvincialZones']);
        $user->roles()->sync($data['roles']);
        alert()->success('مطلب مورد نظر شما با موفقیت ثبت شد.');
        return redirect(route('admin.users.index'));
    }
}
