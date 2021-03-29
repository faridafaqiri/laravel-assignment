<?php

namespace App\Http\Controllers\Admin;
use App\Customer;
use App\Http\Controllers\Controller;
use App\Income;
use App\Setting;
use App\WaterProduction;
use Carbon\Carbon;
use Illuminate\Support\Facades\DB;

class AdminController extends Controller
{

    public function login()
    {
        $month=12;
      $waterProductions=WaterProduction::spanningIncome($month);
     $income=Income::spanningIncome($month);

     $labels=$this->getLastMonths($month);

     $values['waterProduction']=$this->CheckCount($waterProductions->pluck('published'),$month);
     $values['income']=$this->CheckCount($income->pluck('published'),$month);

        $site_name= Setting::first()->site_name;

        $business=DB::table('customers')->sum('customers.business');
        $residential=DB::table('customers')->sum('customers.residential');
        $holy_places=DB::table('customers')->sum('customers.holy_places');
        $public_places=DB::table('customers')->sum('customers.public_places');
        $governmental=DB::table('customers')->sum('customers.governmental');
        $unknown=DB::table('customers')->sum('customers.unknown');
        $all_customers=$business+$residential+$holy_places+$public_places+$governmental+$unknown;

        $faucet_changes=DB::table('faucet_changes')->sum('faucet_changes.total');

        $business=DB::table('customers')->where('customers.faucet_type','=',1)->sum('customers.business');
        $residential=DB::table('customers')->where('customers.faucet_type','=',1)->sum('customers.residential');
        $holy_places=DB::table('customers')->where('customers.faucet_type','=',1)->sum('customers.holy_places');
        $public_places=DB::table('customers')->where('customers.faucet_type','=',1)->sum('customers.public_places');
        $governmental=DB::table('customers')->where('customers.faucet_type','=',1)->sum('customers.governmental');
        $unknown=DB::table('customers')->where('customers.faucet_type','=',1)->sum('customers.unknown');

        $meter_customers=$business+$residential+$holy_places+$public_places+$governmental+$unknown+$faucet_changes;

        $business=DB::table('customers')->where('customers.faucet_type','=',0)->sum('customers.business');
        $residential=DB::table('customers')->where('customers.faucet_type','=',0)->sum('customers.residential');
        $holy_places=DB::table('customers')->where('customers.faucet_type','=',0)->sum('customers.holy_places');
        $public_places=DB::table('customers')->where('customers.faucet_type','=',0)->sum('customers.public_places');
        $governmental=DB::table('customers')->where('customers.faucet_type','=',0)->sum('customers.governmental');
        $unknown=DB::table('customers')->where('customers.faucet_type','=',0)->sum('customers.unknown');
        $numeric_customers=$business+$residential+$holy_places+$public_places+$governmental+$unknown-$faucet_changes;

        $water_production=DB::table('water_productions')->sum('water_productions.produce_water');
        $water_distribution=DB::table('water_distributions')->sum('water_distributions.water_distributed');
        $water_wastage=DB::table('water_wastages')->sum('water_wastages.wasted_water');
        $illegal_customer=DB::table('illegal_customers')->sum('illegal_customers.total');
        $illegal_customer_system=DB::table('illegal_customers')->where('action','=','1')->sum('illegal_customers.total');
        return view('admin.index',compact('site_name','all_customers','meter_customers','numeric_customers','labels','values','water_production','water_distribution','water_wastage','illegal_customer','illegal_customer_system'));
    }
    public function dashboard(){

        return view('admin.index');
    }

    private function getLastMonths(int $month)
    {
        for($i=0;$i<$month;$i++){
            $labels[]=jdate(Carbon::now()->subMonths($i))->format('%B');
        }
        return array_reverse($labels);
    }

    private function CheckCount($count, $month)
    {
        for($i=0; $i<$month; $i++){
            $new[$i]=empty($count[$i]) ? 0 : $count[$i];
        }
        return array_reverse($new);
    }

}
