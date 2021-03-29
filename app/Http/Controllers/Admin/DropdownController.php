<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\MeterReader;
use App\Province;
use App\ProvincialZone;
use App\Zone;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;


class DropdownController extends Controller
{
    public function getProvinceList(Request $request){

        $provinces=Province::where('zone_id',$request->zone_id)
            ->pluck('name','id');
        return response()->json($provinces);

    }


    public function getProvincialZoneList(Request $request){

        $user=Auth::user();
        $provincial_zones=$user->provincialZones->where('province_id',$request->province_id)->pluck('name','id');

        return response()->json($provincial_zones);
    }

    public function getProvincialZoneListForRole(Request $request){

        $provincial_zones=ProvincialZone::where('province_id',$request->province_id)
            ->pluck('name','id');

        return response()->json($provincial_zones);
    }


    public function getMeterReaderList(Request $request){

        $meter_readers=MeterReader::where('provincial_zone_id',$request->provincial_zone_id)->pluck('name','id');
        return response()->json($meter_readers);
    }

}
