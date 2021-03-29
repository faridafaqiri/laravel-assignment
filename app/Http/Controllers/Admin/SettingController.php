<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Setting;
use Illuminate\Http\Request;

class SettingController extends Controller
{
    public function __construct()
    {
        $this->middleware('can:show-settings')->only(['index']);
    }

    public function index(){

        return view('admin.settings.settings')->with('settings',Setting::first());
    }


    public function update()
    {
        $this->validate(request(),[
            'site_name' => 'required',
        ]);
        $settings=Setting::first();
        $settings->site_name=request()->site_name;
        $settings->save();
        return redirect(route('admin.'));
    }
}
