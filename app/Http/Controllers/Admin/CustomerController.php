<?php

namespace App\Http\Controllers\Admin;

use App\Customer;
use App\Http\Controllers\Controller;
use App\ProvincialZone;
use Exception;
use Illuminate\Contracts\Foundation\Application;
use Illuminate\Contracts\View\Factory;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Http\Response;
use Illuminate\Routing\Redirector;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\View\View;
use Morilog\Jalali\CalendarUtils;

class CustomerController extends Controller
{

    public function __construct()
    {
        $this->middleware('can:show-customers')->only(['index']);
        $this->middleware('can:create-customer')->only(['create','store']);
        $this->middleware('can:edit-customer')->only(['edit','update']);
        $this->middleware('can:delete-customer')->only(['destroy']);
        $this->middleware('can:show-customers-report')->only('show_customer_reports');

    }

    /**
     * Display a listing of the resource.
     *
     * @return Factory|View
     */
    public function index()
    {
        $customers=Customer::query();
        if(request('metric_customers')) {
            $customers->where('faucet_type',1);
        }

        if(request('numeric_customers')){
            $customers->where('faucet_type',0);
        }

        $user=Auth::user();
        $customers=$customers->latest()->paginate(10);
        return view('admin.customers.all',compact('customers','user'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return Factory|View
     */
    public function create()
    {
        $zones=DB::table('zones')->pluck('name','id');

        return view('admin.customers.create',compact('zones'));
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
            'business'=>'required',
            'residential'=>'required',
            'holy_places'=>'required',
            'public_places'=>'required',
            'faucet_type'=>'required',
            'governmental'=>'required',
            'unknown'=>'required',
            'old_new'=>'required'
        ]);
        Customer::create($data);
        alert()->success('مطلب مورد نظر شما با موفقیت ایجاد شد.');
        return redirect(route('admin.customers.index'));
    }

    /**
     * Display the specified resource.
     *
     * @param Customer $customer
     * @return Application|Factory|Response|View
     */
    public function show(Customer $customer)
    {
        return view('admin.customers.show',compact('customer'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param Customer $customer
     * @return Factory|View
     */
    public function edit(Customer $customer)
    {
        $zones=DB::table('zones')->pluck('name','id');
        return view('admin.customers.edit',compact('customer','zones'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param Request $request
     * @param Customer $customer
     * @return RedirectResponse|Redirector
     */
    public function update(Request $request, Customer $customer)
    {
        $data=$request->validate([
            'provincial_zone_id'=>'required',
            'zone_id'=>'required',
            'province_id'=>'required',
            'business'=>'required',
            'residential'=>'required',
            'holy_places'=>'required',
            'public_places'=>'required',
            'faucet_type'=>'required',
            'governmental'=>'required',
            'unknown'=>'required',
            'old_new'=>'required'
        ]);
        $customer->update($data);
        alert()->success('مطلب مورد نظر شما با موفقیت ویرایش شد.');
        return redirect(route('admin.customers.index'));
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param Customer $customer
     * @return RedirectResponse
     * @throws Exception
     */
    public function destroy(Customer $customer)
    {
        $customer->delete();
        alert()->success('مطلب مورد نظر شما با موفقیت حذف شد.');
        return back();

    }


    public function show_customer_reports()
    {
        return view('admin.reports.customers_reports');
    }

    public function get_customer_reports(Request $request){
        $illegal_customers_query='SELECT illegal_customers.total,illegal_customers.action,illegal_customers.created_at,provincial_zones.name as provincial_zone_name,provinces.name as province_name,zones.name as zone_name '.
            'FROM zones,illegal_customers,provincial_zones,provinces '.
            'WHERE illegal_customers.provincial_zone_id=provincial_zones.id AND provincial_zones.province_id = provinces.id AND provinces.zone_id = zones.id';
        $customers_query='SELECT customers.faucet_type,customers.unknown,customers.governmental,customers.business,customers.residential,customers.holy_places,customers.public_places,customers.old_new,customers.created_at,provincial_zones.name as provincial_zone_name,provinces.name as province_name,zones.name as zone_name '.
            'FROM zones,customers,provincial_zones,provinces '.
            'WHERE customers.provincial_zone_id=provincial_zones.id AND provincial_zones.province_id = provinces.id AND provinces.zone_id = zones.id';
        $faucet_query='SELECT faucet_changes.total,faucet_changes.business,faucet_changes.residential,faucet_changes.holy_places,faucet_changes.public_places,faucet_changes.governmental,faucet_changes.created_at,provincial_zones.name as provincial_zone_name,provinces.name as province_name,zones.name as zone_name '.
            'FROM zones,faucet_changes,provincial_zones,provinces '.
            'WHERE faucet_changes.provincial_zone_id=provincial_zones.id AND provincial_zones.province_id = provinces.id AND provinces.zone_id = zones.id';
        $faucet_diameter_query='SELECT faucet_diameter_customers.half,faucet_diameter_customers.one,faucet_diameter_customers.three_quarter,faucet_diameter_customers.created_at,provincial_zones.name as provincial_zone_name,provinces.name as province_name,zones.name as zone_name '.
            'FROM zones,faucet_diameter_customers,provincial_zones,provinces '.
            'WHERE faucet_diameter_customers.provincial_zone_id=provincial_zones.id AND provincial_zones.province_id = provinces.id AND provinces.zone_id = zones.id';
        $signboard_query='SELECT signboards.total,signboards.created_at,provincial_zones.name as provincial_zone_name,provinces.name as province_name,zones.name as zone_name '.
            'FROM zones,signboards,provincial_zones,provinces '.
            'WHERE signboards.provincial_zone_id=provincial_zones.id AND provincial_zones.province_id = provinces.id AND provinces.zone_id = zones.id';
        if($request->zone_id=='all' || $request->zone_id==''){
            if($request->date_type=='yearly'){
                $from_date = \Morilog\Jalali\CalendarUtils::toGregorian($request->year,'01', '01');
                $from_date = $from_date[0] . '-' . $from_date[1] . '-' . $from_date[2];
                $to_date = \Morilog\Jalali\CalendarUtils::toGregorian($request->year, '12', '29');
                $to_date = $to_date[0] . '-' . $to_date[1] . '-' . $to_date[2];
                $customers_query=$customers_query.' and Date(customers.created_at) BETWEEN "'.$from_date.'" AND "'.$to_date.'"';
                $illegal_customers_query=$illegal_customers_query.' and Date(illegal_customers.created_at) BETWEEN "'.$from_date.'" AND "'.$to_date.'"';
                $faucet_query=$faucet_query.' and Date(faucet_changes.created_at) BETWEEN "'.$from_date.'" AND "'.$to_date.'"';
                $faucet_diameter_query=$faucet_diameter_query.' and Date(faucet_diameter_customers.created_at) BETWEEN "'.$from_date.'" AND "'.$to_date.'"';
                $signboard_query=$signboard_query.' and Date(signboards.created_at) BETWEEN "'.$from_date.'" AND "'.$to_date.'"';
            }
            else if($request->date_type=='six_monthly'){
                if($request->six_mont_type=='first') {
                    $from_date = \Morilog\Jalali\CalendarUtils::toGregorian($request->year-1,'10', '01');
                    $from_date = $from_date[0] . '-' . $from_date[1] . '-' . $from_date[2];
                    $to_date = \Morilog\Jalali\CalendarUtils::toGregorian($request->year, '03', '31');
                    $to_date = $to_date[0] . '-' . $to_date[1] . '-' . $to_date[2];
                    $customers_query=$customers_query.' and Date(customers.created_at) BETWEEN "'.$from_date.'" AND "'.$to_date.'"';
                    $illegal_customers_query=$illegal_customers_query.' and Date(illegal_customers.created_at) BETWEEN "'.$from_date.'" AND "'.$to_date.'"';
                    $faucet_query=$faucet_query.' and Date(faucet_changes.created_at) BETWEEN "'.$from_date.'" AND "'.$to_date.'"';
                    $faucet_diameter_query=$faucet_diameter_query.' and Date(faucet_diameter_customers.created_at) BETWEEN "'.$from_date.'" AND "'.$to_date.'"';
                    $signboard_query=$signboard_query.' and Date(signboards.created_at) BETWEEN "'.$from_date.'" AND "'.$to_date.'"';
                }else{
                    $from_date = \Morilog\Jalali\CalendarUtils::toGregorian($request->year,'04', '01');
                    $from_date = $from_date[0] . '-' . $from_date[1] . '-' . $from_date[2];
                    $to_date = \Morilog\Jalali\CalendarUtils::toGregorian($request->year, '09', '29');
                    $to_date = $to_date[0] . '-' . $to_date[1] . '-' . $to_date[2];
                    $customers_query=$customers_query.' and Date(customers.created_at) BETWEEN "'.$from_date.'" AND "'.$to_date.'"';
                    $illegal_customers_query=$illegal_customers_query.' and Date(illegal_customers.created_at) BETWEEN "'.$from_date.'" AND "'.$to_date.'"';
                    $faucet_query=$faucet_query.' and Date(faucet_changes.created_at) BETWEEN "'.$from_date.'" AND "'.$to_date.'"';
                    $faucet_diameter_query=$faucet_diameter_query.' and Date(faucet_diameter_customers.created_at) BETWEEN "'.$from_date.'" AND "'.$to_date.'"';
                    $signboard_query=$signboard_query.' and Date(signboards.created_at) BETWEEN "'.$from_date.'" AND "'.$to_date.'"';
                }
            }
            else if($request->date_type=='quarterly'){
                if($request->quarter=='first'){
                    $from_date = \Morilog\Jalali\CalendarUtils::toGregorian($request->year-1,'10', '01');
                    $from_date = $from_date[0] . '-' . $from_date[1] . '-' . $from_date[2];
                    $to_date = \Morilog\Jalali\CalendarUtils::toGregorian($request->year-1, '12', '29');
                    $to_date = $to_date[0] . '-' . $to_date[1] . '-' . $to_date[2];
                    $customers_query=$customers_query.' and Date(customers.created_at) BETWEEN "'.$from_date.'" AND "'.$to_date.'"';
                    $illegal_customers_query=$illegal_customers_query.' and Date(illegal_customers.created_at) BETWEEN "'.$from_date.'" AND "'.$to_date.'"';
                    $faucet_query=$faucet_query.' and Date(faucet_changes.created_at) BETWEEN "'.$from_date.'" AND "'.$to_date.'"';
                    $faucet_diameter_query=$faucet_diameter_query.' and Date(faucet_diameter_customers.created_at) BETWEEN "'.$from_date.'" AND "'.$to_date.'"';
                    $signboard_query=$signboard_query.' and Date(signboards.created_at) BETWEEN "'.$from_date.'" AND "'.$to_date.'"';
                }
                else if($request->quarter=='second'){
                    $from_date = \Morilog\Jalali\CalendarUtils::toGregorian($request->year,'01', '01');
                    $from_date = $from_date[0] . '-' . $from_date[1] . '-' . $from_date[2];
                    $to_date = \Morilog\Jalali\CalendarUtils::toGregorian($request->year, '03', '31');
                    $to_date = $to_date[0] . '-' . $to_date[1] . '-' . $to_date[2];
                    $customers_query=$customers_query.' and Date(customers.created_at) BETWEEN "'.$from_date.'" AND "'.$to_date.'"';
                    $illegal_customers_query=$illegal_customers_query.' and Date(illegal_customers.created_at) BETWEEN "'.$from_date.'" AND "'.$to_date.'"';
                    $faucet_query=$faucet_query.' and Date(faucet_changes.created_at) BETWEEN "'.$from_date.'" AND "'.$to_date.'"';
                    $faucet_diameter_query=$faucet_diameter_query.' and Date(faucet_diameter_customers.created_at) BETWEEN "'.$from_date.'" AND "'.$to_date.'"';
                    $signboard_query=$signboard_query.' and Date(signboards.created_at) BETWEEN "'.$from_date.'" AND "'.$to_date.'"';
                }
                else if($request->quarter=='thired'){
                    $from_date = \Morilog\Jalali\CalendarUtils::toGregorian($request->year,'04', '01');
                    $from_date = $from_date[0] . '-' . $from_date[1] . '-' . $from_date[2];
                    $to_date = \Morilog\Jalali\CalendarUtils::toGregorian($request->year, '06', '31');
                    $to_date = $to_date[0] . '-' . $to_date[1] . '-' . $to_date[2];
                    $customers_query=$customers_query.' and Date(customers.created_at) BETWEEN "'.$from_date.'" AND "'.$to_date.'"';
                    $illegal_customers_query=$illegal_customers_query.' and Date(illegal_customers.created_at) BETWEEN "'.$from_date.'" AND "'.$to_date.'"';
                    $faucet_query=$faucet_query.' and Date(faucet_changes.created_at) BETWEEN "'.$from_date.'" AND "'.$to_date.'"';
                    $faucet_diameter_query=$faucet_diameter_query.' and Date(faucet_diameter_customers.created_at) BETWEEN "'.$from_date.'" AND "'.$to_date.'"';
                    $signboard_query=$signboard_query.' and Date(signboards.created_at) BETWEEN "'.$from_date.'" AND "'.$to_date.'"';
                }
                else{
                    $from_date = \Morilog\Jalali\CalendarUtils::toGregorian($request->year,'07', '01');
                    $from_date = $from_date[0] . '-' . $from_date[1] . '-' . $from_date[2];
                    $to_date = \Morilog\Jalali\CalendarUtils::toGregorian($request->year, '09', '29');
                    $to_date = $to_date[0] . '-' . $to_date[1] . '-' . $to_date[2];
                    $customers_query=$customers_query.' and Date(customers.created_at) BETWEEN "'.$from_date.'" AND "'.$to_date.'"';
                    $illegal_customers_query=$illegal_customers_query.' and Date(illegal_customers.created_at) BETWEEN "'.$from_date.'" AND "'.$to_date.'"';
                    $faucet_query=$faucet_query.' and Date(faucet_changes.created_at) BETWEEN "'.$from_date.'" AND "'.$to_date.'"';
                    $faucet_diameter_query=$faucet_diameter_query.' and Date(faucet_diameter_customers.created_at) BETWEEN "'.$from_date.'" AND "'.$to_date.'"';
                    $signboard_query=$signboard_query.' and Date(signboards.created_at) BETWEEN "'.$from_date.'" AND "'.$to_date.'"';
                }
            }
            else if($request->date_type=='monthly'){
                if($request->month_id<=6) {
                    $from_date = \Morilog\Jalali\CalendarUtils::toGregorian($request->year, $request->month_id, '1');
                    $from_date = $from_date[0] . '-' . $from_date[1] . '-' . $from_date[2];
                    $to_date = \Morilog\Jalali\CalendarUtils::toGregorian($request->year, $request->month_id, '31');
                    $to_date = $to_date[0] . '-' . $to_date[1] . '-' . $to_date[2];
                }
                elseif($request->month_id>6 && $request->month_id<12){
                    $from_date = \Morilog\Jalali\CalendarUtils::toGregorian($request->year, $request->month_id, '1');
                    $from_date = $from_date[0] . '-' . $from_date[1] . '-' . $from_date[2];
                    $to_date = \Morilog\Jalali\CalendarUtils::toGregorian($request->year, $request->month_id, '30');
                    $to_date = $to_date[0] . '-' . $to_date[1] . '-' . $to_date[2];
                }else{
                    $from_date = \Morilog\Jalali\CalendarUtils::toGregorian($request->year, $request->month_id, '1');
                    $from_date = $from_date[0] . '-' . $from_date[1] . '-' . $from_date[2];
                    $to_date = \Morilog\Jalali\CalendarUtils::toGregorian($request->year, $request->month_id, '29');
                    $to_date = $to_date[0] . '-' . $to_date[1] . '-' . $to_date[2];
                }
                $customers_query=$customers_query.' and Date(customers.created_at) BETWEEN "'.$from_date.'" AND "'.$to_date.'"';
                $illegal_customers_query = $illegal_customers_query. ' and Date(illegal_customers.created_at) BETWEEN "'.$from_date.'" AND "'.$to_date.'"';
                $faucet_query = $faucet_query. ' and Date(faucet_changes.created_at) BETWEEN "'.$from_date.'" AND "'.$to_date.'"';
                $faucet_diameter_query = $faucet_diameter_query. ' and Date(faucet_diameter_customers.created_at) BETWEEN "'.$from_date.'" AND "'.$to_date.'"';
                $signboard_query = $signboard_query. ' and Date(signboards.created_at) BETWEEN "'.$from_date.'" AND "'.$to_date.'"';
            }
            else{
                $from_date=\Morilog\Jalali\CalendarUtils::toGregorian(date('Y', strtotime($request->from_date)),date('m', strtotime($request->from_date)),date('d', strtotime($request->from_date)));
                $from_date=$from_date[0].'-'.$from_date[1].'-'.$from_date[2];
                $to_date=\Morilog\Jalali\CalendarUtils::toGregorian(date('Y', strtotime($request->to_date)),date('m', strtotime($request->to_date)),date('d', strtotime($request->to_date)));
                $to_date=$to_date[0].'-'.$to_date[1].'-'.$to_date[2];
                $customers_query=$customers_query.' and Date(customers.created_at) BETWEEN "'.$from_date.'" AND "'.$to_date.'"';
                $illegal_customers_query=$illegal_customers_query.' and Date(illegal_customers.created_at) BETWEEN "'.$from_date.'" AND "'.$to_date.'"';
                $faucet_query=$faucet_query.' and Date(faucet_changes.created_at) BETWEEN "'.$from_date.'" AND "'.$to_date.'"';
                $faucet_diameter_query=$faucet_diameter_query.' and Date(faucet_diameter_customers.created_at) BETWEEN "'.$from_date.'" AND "'.$to_date.'"';
                $signboard_query=$signboard_query.' and Date(signboards.created_at) BETWEEN "'.$from_date.'" AND "'.$to_date.'"';
            }
        }
        else{
            if($request->province_id=='all' || $request->province_id==''){
                $customers_query=$customers_query.' and zones.id='.$request->zone_id;
                $illegal_customers_query=$illegal_customers_query.' and zones.id='.$request->zone_id;
                $faucet_query=$faucet_query.' and zones.id='.$request->zone_id;
                $signboard_query=$signboard_query.' and zones.id='.$request->zone_id;
                if($request->date_type=='yearly'){
                    $from_date = \Morilog\Jalali\CalendarUtils::toGregorian($request->year,'01', '01');
                    $from_date = $from_date[0] . '-' . $from_date[1] . '-' . $from_date[2];
                    $to_date = \Morilog\Jalali\CalendarUtils::toGregorian($request->year, '12', '29');
                    $to_date = $to_date[0] . '-' . $to_date[1] . '-' . $to_date[2];
                    $customers_query=$customers_query.' and Date(customers.created_at) BETWEEN "'.$from_date.'" AND "'.$to_date.'"';
                    $illegal_customers_query=$illegal_customers_query.' and Date(illegal_customers.created_at) BETWEEN "'.$from_date.'" AND "'.$to_date.'"';
                    $faucet_query=$faucet_query.' and Date(faucet_changes.created_at) BETWEEN "'.$from_date.'" AND "'.$to_date.'"';
                    $faucet_diameter_query=$faucet_diameter_query.' and Date(faucet_diameter_customers.created_at) BETWEEN "'.$from_date.'" AND "'.$to_date.'"';
                    $signboard_query=$signboard_query.' and Date(signboards.created_at) BETWEEN "'.$from_date.'" AND "'.$to_date.'"';
                }
                else if($request->date_type=='six_monthly'){
                    if($request->six_mont_type=='first') {
                        $from_date = \Morilog\Jalali\CalendarUtils::toGregorian($request->year-1,'10', '01');
                        $from_date = $from_date[0] . '-' . $from_date[1] . '-' . $from_date[2];
                        $to_date = \Morilog\Jalali\CalendarUtils::toGregorian($request->year, '03', '31');
                        $to_date = $to_date[0] . '-' . $to_date[1] . '-' . $to_date[2];
                        $customers_query=$customers_query.' and Date(customers.created_at) BETWEEN "'.$from_date.'" AND "'.$to_date.'"';
                        $illegal_customers_query=$illegal_customers_query.' and Date(illegal_customers.created_at) BETWEEN "'.$from_date.'" AND "'.$to_date.'"';
                        $faucet_query=$faucet_query.' and Date(faucet_changes.created_at) BETWEEN "'.$from_date.'" AND "'.$to_date.'"';
                        $faucet_diameter_query=$faucet_diameter_query.' and Date(faucet_diameter_customers.created_at) BETWEEN "'.$from_date.'" AND "'.$to_date.'"';
                        $signboard_query=$signboard_query.' and Date(signboards.created_at) BETWEEN "'.$from_date.'" AND "'.$to_date.'"';
                    }else{
                        $from_date = \Morilog\Jalali\CalendarUtils::toGregorian($request->year,'04', '01');
                        $from_date = $from_date[0] . '-' . $from_date[1] . '-' . $from_date[2];
                        $to_date = \Morilog\Jalali\CalendarUtils::toGregorian($request->year, '09', '29');
                        $to_date = $to_date[0] . '-' . $to_date[1] . '-' . $to_date[2];
                        $customers_query=$customers_query.' and Date(customers.created_at) BETWEEN "'.$from_date.'" AND "'.$to_date.'"';
                        $illegal_customers_query=$illegal_customers_query.' and Date(illegal_customers.created_at) BETWEEN "'.$from_date.'" AND "'.$to_date.'"';
                        $faucet_query=$faucet_query.' and Date(faucet_changes.created_at) BETWEEN "'.$from_date.'" AND "'.$to_date.'"';
                        $faucet_diameter_query=$faucet_diameter_query.' and Date(faucet_diameter_customers.created_at) BETWEEN "'.$from_date.'" AND "'.$to_date.'"';
                        $signboard_query=$signboard_query.' and Date(signboards.created_at) BETWEEN "'.$from_date.'" AND "'.$to_date.'"';
                    }
                }
                else if($request->date_type=='quarterly'){
                    if($request->quarter=='first'){
                        $from_date = \Morilog\Jalali\CalendarUtils::toGregorian($request->year-1,'10', '01');
                        $from_date = $from_date[0] . '-' . $from_date[1] . '-' . $from_date[2];
                        $to_date = \Morilog\Jalali\CalendarUtils::toGregorian($request->year-1, '12', '29');
                        $to_date = $to_date[0] . '-' . $to_date[1] . '-' . $to_date[2];
                        $customers_query=$customers_query.' and Date(customers.created_at) BETWEEN "'.$from_date.'" AND "'.$to_date.'"';
                        $illegal_customers_query=$illegal_customers_query.' and Date(illegal_customers.created_at) BETWEEN "'.$from_date.'" AND "'.$to_date.'"';
                        $faucet_query=$faucet_query.' and Date(faucet_changes.created_at) BETWEEN "'.$from_date.'" AND "'.$to_date.'"';
                        $faucet_diameter_query=$faucet_diameter_query.' and Date(faucet_diameter_customers.created_at) BETWEEN "'.$from_date.'" AND "'.$to_date.'"';
                        $signboard_query=$signboard_query.' and Date(signboards.created_at) BETWEEN "'.$from_date.'" AND "'.$to_date.'"';
                    }
                    else if($request->quarter=='second'){
                        $from_date = \Morilog\Jalali\CalendarUtils::toGregorian($request->year,'01', '01');
                        $from_date = $from_date[0] . '-' . $from_date[1] . '-' . $from_date[2];
                        $to_date = \Morilog\Jalali\CalendarUtils::toGregorian($request->year, '03', '31');
                        $to_date = $to_date[0] . '-' . $to_date[1] . '-' . $to_date[2];
                        $customers_query=$customers_query.' and Date(customers.created_at) BETWEEN "'.$from_date.'" AND "'.$to_date.'"';
                        $illegal_customers_query=$illegal_customers_query.' and Date(illegal_customers.created_at) BETWEEN "'.$from_date.'" AND "'.$to_date.'"';
                        $faucet_query=$faucet_query.' and Date(faucet_changes.created_at) BETWEEN "'.$from_date.'" AND "'.$to_date.'"';
                        $faucet_diameter_query=$faucet_diameter_query.' and Date(faucet_diameter_customers.created_at) BETWEEN "'.$from_date.'" AND "'.$to_date.'"';
                        $signboard_query=$signboard_query.' and Date(signboards.created_at) BETWEEN "'.$from_date.'" AND "'.$to_date.'"';
                    }
                    else if($request->quarter=='thired'){
                        $from_date = \Morilog\Jalali\CalendarUtils::toGregorian($request->year,'04', '01');
                        $from_date = $from_date[0] . '-' . $from_date[1] . '-' . $from_date[2];
                        $to_date = \Morilog\Jalali\CalendarUtils::toGregorian($request->year, '06', '31');
                        $to_date = $to_date[0] . '-' . $to_date[1] . '-' . $to_date[2];
                        $customers_query=$customers_query.' and Date(customers.created_at) BETWEEN "'.$from_date.'" AND "'.$to_date.'"';
                        $illegal_customers_query=$illegal_customers_query.' and Date(illegal_customers.created_at) BETWEEN "'.$from_date.'" AND "'.$to_date.'"';
                        $faucet_query=$faucet_query.' and Date(faucet_changes.created_at) BETWEEN "'.$from_date.'" AND "'.$to_date.'"';
                        $faucet_diameter_query=$faucet_diameter_query.' and Date(faucet_diameter_customers.created_at) BETWEEN "'.$from_date.'" AND "'.$to_date.'"';
                        $signboard_query=$signboard_query.' and Date(signboards.created_at) BETWEEN "'.$from_date.'" AND "'.$to_date.'"';
                    }
                    else{
                        $from_date = \Morilog\Jalali\CalendarUtils::toGregorian($request->year,'07', '01');
                        $from_date = $from_date[0] . '-' . $from_date[1] . '-' . $from_date[2];
                        $to_date = \Morilog\Jalali\CalendarUtils::toGregorian($request->year, '09', '29');
                        $to_date = $to_date[0] . '-' . $to_date[1] . '-' . $to_date[2];
                        $customers_query=$customers_query.' and Date(customers.created_at) BETWEEN "'.$from_date.'" AND "'.$to_date.'"';
                        $illegal_customers_query=$illegal_customers_query.' and Date(illegal_customers.created_at) BETWEEN "'.$from_date.'" AND "'.$to_date.'"';
                        $faucet_query=$faucet_query.' and Date(faucet_changes.created_at) BETWEEN "'.$from_date.'" AND "'.$to_date.'"';
                        $faucet_diameter_query=$faucet_diameter_query.' and Date(faucet_diameter_customers.created_at) BETWEEN "'.$from_date.'" AND "'.$to_date.'"';
                        $signboard_query=$signboard_query.' and Date(signboards.created_at) BETWEEN "'.$from_date.'" AND "'.$to_date.'"';
                    }
                }
                else if($request->date_type=='monthly'){
                    if($request->month_id<=6) {
                        $from_date = \Morilog\Jalali\CalendarUtils::toGregorian($request->year, $request->month_id, '1');
                        $from_date = $from_date[0] . '-' . $from_date[1] . '-' . $from_date[2];
                        $to_date = \Morilog\Jalali\CalendarUtils::toGregorian($request->year, $request->month_id, '31');
                        $to_date = $to_date[0] . '-' . $to_date[1] . '-' . $to_date[2];
                    }
                    elseif($request->month_id>6 && $request->month_id<12){
                        $from_date = \Morilog\Jalali\CalendarUtils::toGregorian($request->year, $request->month_id, '1');
                        $from_date = $from_date[0] . '-' . $from_date[1] . '-' . $from_date[2];
                        $to_date = \Morilog\Jalali\CalendarUtils::toGregorian($request->year, $request->month_id, '30');
                        $to_date = $to_date[0] . '-' . $to_date[1] . '-' . $to_date[2];
                    }else{
                        $from_date = \Morilog\Jalali\CalendarUtils::toGregorian($request->year, $request->month_id, '1');
                        $from_date = $from_date[0] . '-' . $from_date[1] . '-' . $from_date[2];
                        $to_date = \Morilog\Jalali\CalendarUtils::toGregorian($request->year, $request->month_id, '29');
                        $to_date = $to_date[0] . '-' . $to_date[1] . '-' . $to_date[2];
                    }
                    $customers_query=$customers_query.' and Date(customers.created_at) BETWEEN "'.$from_date.'" AND "'.$to_date.'"';
                    $illegal_customers_query = $illegal_customers_query. ' and Date(illegal_customers.created_at) BETWEEN "'.$from_date.'" AND "'.$to_date.'"';
                    $faucet_query = $faucet_query. ' and Date(faucet_changes.created_at) BETWEEN "'.$from_date.'" AND "'.$to_date.'"';
                    $faucet_diameter_query = $faucet_diameter_query. ' and Date(faucet_diameter_customers.created_at) BETWEEN "'.$from_date.'" AND "'.$to_date.'"';
                    $signboard_query = $signboard_query. ' and Date(signboards.created_at) BETWEEN "'.$from_date.'" AND "'.$to_date.'"';
                }
                else{
                    $from_date=\Morilog\Jalali\CalendarUtils::toGregorian(date('Y', strtotime($request->from_date)),date('m', strtotime($request->from_date)),date('d', strtotime($request->from_date)));
                    $from_date=$from_date[0].'-'.$from_date[1].'-'.$from_date[2];
                    $to_date=\Morilog\Jalali\CalendarUtils::toGregorian(date('Y', strtotime($request->to_date)),date('m', strtotime($request->to_date)),date('d', strtotime($request->to_date)));
                    $to_date=$to_date[0].'-'.$to_date[1].'-'.$to_date[2];
                    $customers_query=$customers_query.' and Date(customers.created_at) BETWEEN "'.$from_date.'" AND "'.$to_date.'"';
                    $illegal_customers_query=$illegal_customers_query.' and Date(illegal_customers.created_at) BETWEEN "'.$from_date.'" AND "'.$to_date.'"';
                    $faucet_query=$faucet_query.' and Date(faucet_changes.created_at) BETWEEN "'.$from_date.'" AND "'.$to_date.'"';
                    $faucet_diameter_query=$faucet_diameter_query.' and Date(faucet_diameter_customers.created_at) BETWEEN "'.$from_date.'" AND "'.$to_date.'"';
                    $signboard_query=$signboard_query.' and Date(signboards.created_at) BETWEEN "'.$from_date.'" AND "'.$to_date.'"';
                }
            }
            else{
                if($request->provincial_zone_id=="all" || $request->provincial_zone_id==""){
                    $customers_query=$customers_query.' and zones.id='.$request->zone_id;
                    $customers_query=$customers_query.' and provinces.id='.$request->province_id;
                    $illegal_customers_query=$illegal_customers_query.' and zones.id='.$request->zone_id;
                    $illegal_customers_query=$illegal_customers_query.' and provinces.id='.$request->province_id;
                    $faucet_query=$faucet_query.' and zones.id='.$request->zone_id;
                    $faucet_query=$faucet_query.' and provinces.id='.$request->province_id;
                    $faucet_diameter_query=$faucet_diameter_query.' and zones.id='.$request->zone_id;
                    $faucet_diameter_query=$faucet_diameter_query.' and provinces.id='.$request->province_id;
                    $signboard_query=$signboard_query.' and zones.id='.$request->zone_id;
                    $signboard_query=$signboard_query.' and provinces.id='.$request->province_id;
                    if($request->date_type=='yearly'){
                        $from_date = \Morilog\Jalali\CalendarUtils::toGregorian($request->year,'01', '01');
                        $from_date = $from_date[0] . '-' . $from_date[1] . '-' . $from_date[2];
                        $to_date = \Morilog\Jalali\CalendarUtils::toGregorian($request->year, '12', '29');
                        $to_date = $to_date[0] . '-' . $to_date[1] . '-' . $to_date[2];
                        $customers_query=$customers_query.' and Date(customers.created_at) BETWEEN "'.$from_date.'" AND "'.$to_date.'"';
                        $illegal_customers_query=$illegal_customers_query.' and Date(illegal_customers.created_at) BETWEEN "'.$from_date.'" AND "'.$to_date.'"';
                        $faucet_query=$faucet_query.' and Date(faucet_changes.created_at) BETWEEN "'.$from_date.'" AND "'.$to_date.'"';
                        $faucet_diameter_query=$faucet_diameter_query.' and Date(faucet_diameter_customers.created_at) BETWEEN "'.$from_date.'" AND "'.$to_date.'"';
                        $signboard_query=$signboard_query.' and Date(signboards.created_at) BETWEEN "'.$from_date.'" AND "'.$to_date.'"';
                    }
                    else if($request->date_type=='six_monthly'){
                        if($request->six_mont_type=='first') {
                            $from_date = \Morilog\Jalali\CalendarUtils::toGregorian($request->year-1,'10', '01');
                            $from_date = $from_date[0] . '-' . $from_date[1] . '-' . $from_date[2];
                            $to_date = \Morilog\Jalali\CalendarUtils::toGregorian($request->year, '03', '31');
                            $to_date = $to_date[0] . '-' . $to_date[1] . '-' . $to_date[2];
                            $customers_query=$customers_query.' and Date(customers.created_at) BETWEEN "'.$from_date.'" AND "'.$to_date.'"';
                            $illegal_customers_query=$illegal_customers_query.' and Date(illegal_customers.created_at) BETWEEN "'.$from_date.'" AND "'.$to_date.'"';
                            $faucet_query=$faucet_query.' and Date(faucet_changes.created_at) BETWEEN "'.$from_date.'" AND "'.$to_date.'"';
                            $faucet_diameter_query=$faucet_diameter_query.' and Date(faucet_diameter_customers.created_at) BETWEEN "'.$from_date.'" AND "'.$to_date.'"';
                            $signboard_query=$signboard_query.' and Date(signboards.created_at) BETWEEN "'.$from_date.'" AND "'.$to_date.'"';
                        }else{
                            $from_date = \Morilog\Jalali\CalendarUtils::toGregorian($request->year,'04', '01');
                            $from_date = $from_date[0] . '-' . $from_date[1] . '-' . $from_date[2];
                            $to_date = \Morilog\Jalali\CalendarUtils::toGregorian($request->year, '09', '29');
                            $to_date = $to_date[0] . '-' . $to_date[1] . '-' . $to_date[2];
                            $customers_query=$customers_query.' and Date(customers.created_at) BETWEEN "'.$from_date.'" AND "'.$to_date.'"';
                            $illegal_customers_query=$illegal_customers_query.' and Date(illegal_customers.created_at) BETWEEN "'.$from_date.'" AND "'.$to_date.'"';
                            $faucet_query=$faucet_query.' and Date(faucet_changes.created_at) BETWEEN "'.$from_date.'" AND "'.$to_date.'"';
                            $faucet_diameter_query=$faucet_diameter_query.' and Date(faucet_diameter_customers.created_at) BETWEEN "'.$from_date.'" AND "'.$to_date.'"';
                            $signboard_query=$signboard_query.' and Date(signboards.created_at) BETWEEN "'.$from_date.'" AND "'.$to_date.'"';
                        }
                    }
                    else if($request->date_type=='quarterly'){
                        if($request->quarter=='first'){
                            $from_date = \Morilog\Jalali\CalendarUtils::toGregorian($request->year-1,'10', '01');
                            $from_date = $from_date[0] . '-' . $from_date[1] . '-' . $from_date[2];
                            $to_date = \Morilog\Jalali\CalendarUtils::toGregorian($request->year-1, '12', '29');
                            $to_date = $to_date[0] . '-' . $to_date[1] . '-' . $to_date[2];
                            $customers_query=$customers_query.' and Date(customers.created_at) BETWEEN "'.$from_date.'" AND "'.$to_date.'"';
                            $illegal_customers_query=$illegal_customers_query.' and Date(illegal_customers.created_at) BETWEEN "'.$from_date.'" AND "'.$to_date.'"';
                            $faucet_query=$faucet_query.' and Date(faucet_changes.created_at) BETWEEN "'.$from_date.'" AND "'.$to_date.'"';
                            $faucet_diameter_query=$faucet_diameter_query.' and Date(faucet_diameter_customers.created_at) BETWEEN "'.$from_date.'" AND "'.$to_date.'"';
                            $signboard_query=$signboard_query.' and Date(signboards.created_at) BETWEEN "'.$from_date.'" AND "'.$to_date.'"';
                        }
                        else if($request->quarter=='second'){
                            $from_date = \Morilog\Jalali\CalendarUtils::toGregorian($request->year,'01', '01');
                            $from_date = $from_date[0] . '-' . $from_date[1] . '-' . $from_date[2];
                            $to_date = \Morilog\Jalali\CalendarUtils::toGregorian($request->year, '03', '31');
                            $to_date = $to_date[0] . '-' . $to_date[1] . '-' . $to_date[2];
                            $customers_query=$customers_query.' and Date(customers.created_at) BETWEEN "'.$from_date.'" AND "'.$to_date.'"';
                            $illegal_customers_query=$illegal_customers_query.' and Date(illegal_customers.created_at) BETWEEN "'.$from_date.'" AND "'.$to_date.'"';
                            $faucet_query=$faucet_query.' and Date(faucet_changes.created_at) BETWEEN "'.$from_date.'" AND "'.$to_date.'"';
                            $faucet_diameter_query=$faucet_diameter_query.' and Date(faucet_diameter_customers.created_at) BETWEEN "'.$from_date.'" AND "'.$to_date.'"';
                            $signboard_query=$signboard_query.' and Date(signboards.created_at) BETWEEN "'.$from_date.'" AND "'.$to_date.'"';
                        }
                        else if($request->quarter=='thired'){
                            $from_date = \Morilog\Jalali\CalendarUtils::toGregorian($request->year,'04', '01');
                            $from_date = $from_date[0] . '-' . $from_date[1] . '-' . $from_date[2];
                            $to_date = \Morilog\Jalali\CalendarUtils::toGregorian($request->year, '06', '31');
                            $to_date = $to_date[0] . '-' . $to_date[1] . '-' . $to_date[2];
                            $customers_query=$customers_query.' and Date(customers.created_at) BETWEEN "'.$from_date.'" AND "'.$to_date.'"';
                            $illegal_customers_query=$illegal_customers_query.' and Date(illegal_customers.created_at) BETWEEN "'.$from_date.'" AND "'.$to_date.'"';
                            $faucet_query=$faucet_query.' and Date(faucet_changes.created_at) BETWEEN "'.$from_date.'" AND "'.$to_date.'"';
                            $faucet_diameter_query=$faucet_diameter_query.' and Date(faucet_diameter_customers.created_at) BETWEEN "'.$from_date.'" AND "'.$to_date.'"';
                            $signboard_query=$signboard_query.' and Date(signboards.created_at) BETWEEN "'.$from_date.'" AND "'.$to_date.'"';
                        }
                        else{
                            $from_date = \Morilog\Jalali\CalendarUtils::toGregorian($request->year,'07', '01');
                            $from_date = $from_date[0] . '-' . $from_date[1] . '-' . $from_date[2];
                            $to_date = \Morilog\Jalali\CalendarUtils::toGregorian($request->year, '09', '29');
                            $to_date = $to_date[0] . '-' . $to_date[1] . '-' . $to_date[2];
                            $customers_query=$customers_query.' and Date(customers.created_at) BETWEEN "'.$from_date.'" AND "'.$to_date.'"';
                            $illegal_customers_query=$illegal_customers_query.' and Date(illegal_customers.created_at) BETWEEN "'.$from_date.'" AND "'.$to_date.'"';
                            $faucet_query=$faucet_query.' and Date(faucet_changes.created_at) BETWEEN "'.$from_date.'" AND "'.$to_date.'"';
                            $faucet_diameter_query=$faucet_diameter_query.' and Date(faucet_diameter_customers.created_at) BETWEEN "'.$from_date.'" AND "'.$to_date.'"';
                            $signboard_query=$signboard_query.' and Date(signboards.created_at) BETWEEN "'.$from_date.'" AND "'.$to_date.'"';
                        }
                    }
                    else if($request->date_type=='monthly'){
                        if($request->month_id<=6) {
                            $from_date = \Morilog\Jalali\CalendarUtils::toGregorian($request->year, $request->month_id, '1');
                            $from_date = $from_date[0] . '-' . $from_date[1] . '-' . $from_date[2];
                            $to_date = \Morilog\Jalali\CalendarUtils::toGregorian($request->year, $request->month_id, '31');
                            $to_date = $to_date[0] . '-' . $to_date[1] . '-' . $to_date[2];
                        }
                        elseif($request->month_id>6 && $request->month_id<12){
                            $from_date = \Morilog\Jalali\CalendarUtils::toGregorian($request->year, $request->month_id, '1');
                            $from_date = $from_date[0] . '-' . $from_date[1] . '-' . $from_date[2];
                            $to_date = \Morilog\Jalali\CalendarUtils::toGregorian($request->year, $request->month_id, '30');
                            $to_date = $to_date[0] . '-' . $to_date[1] . '-' . $to_date[2];
                        }else{
                            $from_date = \Morilog\Jalali\CalendarUtils::toGregorian($request->year, $request->month_id, '1');
                            $from_date = $from_date[0] . '-' . $from_date[1] . '-' . $from_date[2];
                            $to_date = \Morilog\Jalali\CalendarUtils::toGregorian($request->year, $request->month_id, '29');
                            $to_date = $to_date[0] . '-' . $to_date[1] . '-' . $to_date[2];
                        }
                        $customers_query=$customers_query.' and Date(customers.created_at) BETWEEN "'.$from_date.'" AND "'.$to_date.'"';
                        $illegal_customers_query = $illegal_customers_query. ' and Date(illegal_customers.created_at) BETWEEN "'.$from_date.'" AND "'.$to_date.'"';
                        $faucet_query = $faucet_query. ' and Date(faucet_changes.created_at) BETWEEN "'.$from_date.'" AND "'.$to_date.'"';
                        $faucet_diameter_query = $faucet_diameter_query. ' and Date(faucet_diameter_customers.created_at) BETWEEN "'.$from_date.'" AND "'.$to_date.'"';
                        $signboard_query = $signboard_query. ' and Date(signboards.created_at) BETWEEN "'.$from_date.'" AND "'.$to_date.'"';
                    }
                    else{
                        $from_date=\Morilog\Jalali\CalendarUtils::toGregorian(date('Y', strtotime($request->from_date)),date('m', strtotime($request->from_date)),date('d', strtotime($request->from_date)));
                        $from_date=$from_date[0].'-'.$from_date[1].'-'.$from_date[2];
                        $to_date=\Morilog\Jalali\CalendarUtils::toGregorian(date('Y', strtotime($request->to_date)),date('m', strtotime($request->to_date)),date('d', strtotime($request->to_date)));
                        $to_date=$to_date[0].'-'.$to_date[1].'-'.$to_date[2];
                        $customers_query=$customers_query.' and Date(customers.created_at) BETWEEN "'.$from_date.'" AND "'.$to_date.'"';
                        $illegal_customers_query=$illegal_customers_query.' and Date(illegal_customers.created_at) BETWEEN "'.$from_date.'" AND "'.$to_date.'"';
                        $faucet_query=$faucet_query.' and Date(faucet_changes.created_at) BETWEEN "'.$from_date.'" AND "'.$to_date.'"';
                        $faucet_diameter_query=$faucet_diameter_query.' and Date(faucet_diameter_customers.created_at) BETWEEN "'.$from_date.'" AND "'.$to_date.'"';
                        $signboard_query=$signboard_query.' and Date(signboards.created_at) BETWEEN "'.$from_date.'" AND "'.$to_date.'"';
                    }
                }
                else{
                    $customers_query=$customers_query.' and zones.id='.$request->zone_id;
                    $customers_query=$customers_query.' and provinces.id='.$request->province_id;
                    $customers_query=$customers_query.' and provincial_zones.id='.$request->provincial_zone_id;
                    $illegal_customers_query=$illegal_customers_query.' and zones.id='.$request->zone_id;
                    $illegal_customers_query=$illegal_customers_query.' and provinces.id='.$request->province_id;
                    $illegal_customers_query=$illegal_customers_query.' and provincial_zones.id='.$request->provincial_zone_id;
                    $faucet_query=$faucet_query.' and zones.id='.$request->zone_id;
                    $faucet_query=$faucet_query.' and provinces.id='.$request->province_id;
                    $faucet_query=$faucet_query.' and provincial_zones.id='.$request->provincial_zone_id;
                    $faucet_diameter_query=$faucet_diameter_query.' and zones.id='.$request->zone_id;
                    $faucet_diameter_query=$faucet_diameter_query.' and provinces.id='.$request->province_id;
                    $faucet_diameter_query=$faucet_diameter_query.' and provincial_zones.id='.$request->provincial_zone_id;
                    $signboard_query=$signboard_query.' and zones.id='.$request->zone_id;
                    $signboard_query=$signboard_query.' and provinces.id='.$request->province_id;
                    $signboard_query=$signboard_query.' and provincial_zones.id='.$request->provincial_zone_id;
                    if($request->date_type=='yearly'){
                        $from_date = \Morilog\Jalali\CalendarUtils::toGregorian($request->year,'01', '01');
                        $from_date = $from_date[0] . '-' . $from_date[1] . '-' . $from_date[2];
                        $to_date = \Morilog\Jalali\CalendarUtils::toGregorian($request->year, '12', '29');
                        $to_date = $to_date[0] . '-' . $to_date[1] . '-' . $to_date[2];
                        $customers_query=$customers_query.' and Date(customers.created_at) BETWEEN "'.$from_date.'" AND "'.$to_date.'"';
                        $illegal_customers_query=$illegal_customers_query.' and Date(illegal_customers.created_at) BETWEEN "'.$from_date.'" AND "'.$to_date.'"';
                        $faucet_query=$faucet_query.' and Date(faucet_changes.created_at) BETWEEN "'.$from_date.'" AND "'.$to_date.'"';
                        $faucet_diameter_query=$faucet_diameter_query.' and Date(faucet_diameter_customers.created_at) BETWEEN "'.$from_date.'" AND "'.$to_date.'"';
                        $signboard_query=$signboard_query.' and Date(signboards.created_at) BETWEEN "'.$from_date.'" AND "'.$to_date.'"';
                    }
                    else if($request->date_type=='six_monthly'){
                        if($request->six_mont_type=='first') {
                            $from_date = \Morilog\Jalali\CalendarUtils::toGregorian($request->year-1,'10', '01');
                            $from_date = $from_date[0] . '-' . $from_date[1] . '-' . $from_date[2];
                            $to_date = \Morilog\Jalali\CalendarUtils::toGregorian($request->year, '03', '31');
                            $to_date = $to_date[0] . '-' . $to_date[1] . '-' . $to_date[2];
                            $customers_query=$customers_query.' and Date(customers.created_at) BETWEEN "'.$from_date.'" AND "'.$to_date.'"';
                            $illegal_customers_query=$illegal_customers_query.' and Date(illegal_customers.created_at) BETWEEN "'.$from_date.'" AND "'.$to_date.'"';
                            $faucet_query=$faucet_query.' and Date(faucet_changes.created_at) BETWEEN "'.$from_date.'" AND "'.$to_date.'"';
                            $faucet_diameter_query=$faucet_diameter_query.' and Date(faucet_diameter_customers.created_at) BETWEEN "'.$from_date.'" AND "'.$to_date.'"';
                            $signboard_query=$signboard_query.' and Date(signboards.created_at) BETWEEN "'.$from_date.'" AND "'.$to_date.'"';
                        }else{
                            $from_date = \Morilog\Jalali\CalendarUtils::toGregorian($request->year,'04', '01');
                            $from_date = $from_date[0] . '-' . $from_date[1] . '-' . $from_date[2];
                            $to_date = \Morilog\Jalali\CalendarUtils::toGregorian($request->year, '09', '29');
                            $to_date = $to_date[0] . '-' . $to_date[1] . '-' . $to_date[2];
                            $customers_query=$customers_query.' and Date(customers.created_at) BETWEEN "'.$from_date.'" AND "'.$to_date.'"';
                            $illegal_customers_query=$illegal_customers_query.' and Date(illegal_customers.created_at) BETWEEN "'.$from_date.'" AND "'.$to_date.'"';
                            $faucet_query=$faucet_query.' and Date(faucet_changes.created_at) BETWEEN "'.$from_date.'" AND "'.$to_date.'"';
                            $faucet_diameter_query=$faucet_diameter_query.' and Date(faucet_diameter_customers.created_at) BETWEEN "'.$from_date.'" AND "'.$to_date.'"';
                            $signboard_query=$signboard_query.' and Date(signboards.created_at) BETWEEN "'.$from_date.'" AND "'.$to_date.'"';
                        }
                    }
                    else if($request->date_type=='quarterly'){
                        if($request->quarter=='first'){
                            $from_date = \Morilog\Jalali\CalendarUtils::toGregorian($request->year-1,'10', '01');
                            $from_date = $from_date[0] . '-' . $from_date[1] . '-' . $from_date[2];
                            $to_date = \Morilog\Jalali\CalendarUtils::toGregorian($request->year-1, '12', '29');
                            $to_date = $to_date[0] . '-' . $to_date[1] . '-' . $to_date[2];
                            $customers_query=$customers_query.' and Date(customers.created_at) BETWEEN "'.$from_date.'" AND "'.$to_date.'"';
                            $illegal_customers_query=$illegal_customers_query.' and Date(illegal_customers.created_at) BETWEEN "'.$from_date.'" AND "'.$to_date.'"';
                            $faucet_query=$faucet_query.' and Date(faucet_changes.created_at) BETWEEN "'.$from_date.'" AND "'.$to_date.'"';
                            $faucet_diameter_query=$faucet_diameter_query.' and Date(faucet_diameter_customers.created_at) BETWEEN "'.$from_date.'" AND "'.$to_date.'"';
                            $signboard_query=$signboard_query.' and Date(signboards.created_at) BETWEEN "'.$from_date.'" AND "'.$to_date.'"';
                        }
                        else if($request->quarter=='second'){
                            $from_date = \Morilog\Jalali\CalendarUtils::toGregorian($request->year,'01', '01');
                            $from_date = $from_date[0] . '-' . $from_date[1] . '-' . $from_date[2];
                            $to_date = \Morilog\Jalali\CalendarUtils::toGregorian($request->year, '03', '31');
                            $to_date = $to_date[0] . '-' . $to_date[1] . '-' . $to_date[2];
                            $customers_query=$customers_query.' and Date(customers.created_at) BETWEEN "'.$from_date.'" AND "'.$to_date.'"';
                            $illegal_customers_query=$illegal_customers_query.' and Date(illegal_customers.created_at) BETWEEN "'.$from_date.'" AND "'.$to_date.'"';
                            $faucet_query=$faucet_query.' and Date(faucet_changes.created_at) BETWEEN "'.$from_date.'" AND "'.$to_date.'"';
                            $faucet_diameter_query=$faucet_diameter_query.' and Date(faucet_diameter_customers.created_at) BETWEEN "'.$from_date.'" AND "'.$to_date.'"';
                            $signboard_query=$signboard_query.' and Date(signboards.created_at) BETWEEN "'.$from_date.'" AND "'.$to_date.'"';
                        }
                        else if($request->quarter=='thired'){
                            $from_date = \Morilog\Jalali\CalendarUtils::toGregorian($request->year,'04', '01');
                            $from_date = $from_date[0] . '-' . $from_date[1] . '-' . $from_date[2];
                            $to_date = \Morilog\Jalali\CalendarUtils::toGregorian($request->year, '06', '31');
                            $to_date = $to_date[0] . '-' . $to_date[1] . '-' . $to_date[2];
                            $customers_query=$customers_query.' and Date(customers.created_at) BETWEEN "'.$from_date.'" AND "'.$to_date.'"';
                            $illegal_customers_query=$illegal_customers_query.' and Date(illegal_customers.created_at) BETWEEN "'.$from_date.'" AND "'.$to_date.'"';
                            $faucet_query=$faucet_query.' and Date(faucet_changes.created_at) BETWEEN "'.$from_date.'" AND "'.$to_date.'"';
                            $faucet_diameter_query=$faucet_diameter_query.' and Date(faucet_diameter_customers.created_at) BETWEEN "'.$from_date.'" AND "'.$to_date.'"';
                            $signboard_query=$signboard_query.' and Date(signboards.created_at) BETWEEN "'.$from_date.'" AND "'.$to_date.'"';
                        }
                        else{
                            $from_date = \Morilog\Jalali\CalendarUtils::toGregorian($request->year,'07', '01');
                            $from_date = $from_date[0] . '-' . $from_date[1] . '-' . $from_date[2];
                            $to_date = \Morilog\Jalali\CalendarUtils::toGregorian($request->year, '09', '29');
                            $to_date = $to_date[0] . '-' . $to_date[1] . '-' . $to_date[2];
                            $customers_query=$customers_query.' and Date(customers.created_at) BETWEEN "'.$from_date.'" AND "'.$to_date.'"';
                            $illegal_customers_query=$illegal_customers_query.' and Date(illegal_customers.created_at) BETWEEN "'.$from_date.'" AND "'.$to_date.'"';
                            $faucet_query=$faucet_query.' and Date(faucet_changes.created_at) BETWEEN "'.$from_date.'" AND "'.$to_date.'"';
                            $faucet_diameter_query=$faucet_diameter_query.' and Date(faucet_diameter_customers.created_at) BETWEEN "'.$from_date.'" AND "'.$to_date.'"';
                            $signboard_query=$signboard_query.' and Date(signboards.created_at) BETWEEN "'.$from_date.'" AND "'.$to_date.'"';
                        }
                    }
                    else if($request->date_type=='monthly'){
                        if($request->month_id<=6) {
                            $from_date = \Morilog\Jalali\CalendarUtils::toGregorian($request->year, $request->month_id, '1');
                            $from_date = $from_date[0] . '-' . $from_date[1] . '-' . $from_date[2];
                            $to_date = \Morilog\Jalali\CalendarUtils::toGregorian($request->year, $request->month_id, '31');
                            $to_date = $to_date[0] . '-' . $to_date[1] . '-' . $to_date[2];
                        }
                        elseif($request->month_id>6 && $request->month_id<12){
                            $from_date = \Morilog\Jalali\CalendarUtils::toGregorian($request->year, $request->month_id, '1');
                            $from_date = $from_date[0] . '-' . $from_date[1] . '-' . $from_date[2];
                            $to_date = \Morilog\Jalali\CalendarUtils::toGregorian($request->year, $request->month_id, '30');
                            $to_date = $to_date[0] . '-' . $to_date[1] . '-' . $to_date[2];
                        }else{
                            $from_date = \Morilog\Jalali\CalendarUtils::toGregorian($request->year, $request->month_id, '1');
                            $from_date = $from_date[0] . '-' . $from_date[1] . '-' . $from_date[2];
                            $to_date = \Morilog\Jalali\CalendarUtils::toGregorian($request->year, $request->month_id, '29');
                            $to_date = $to_date[0] . '-' . $to_date[1] . '-' . $to_date[2];
                        }
                        $customers_query=$customers_query.' and Date(customers.created_at) BETWEEN "'.$from_date.'" AND "'.$to_date.'"';
                        $illegal_customers_query = $illegal_customers_query. ' and Date(illegal_customers.created_at) BETWEEN "'.$from_date.'" AND "'.$to_date.'"';
                        $faucet_query = $faucet_query. ' and Date(faucet_changes.created_at) BETWEEN "'.$from_date.'" AND "'.$to_date.'"';
                        $faucet_diameter_query = $faucet_diameter_query. ' and Date(faucet_diameter_customers.created_at) BETWEEN "'.$from_date.'" AND "'.$to_date.'"';
                        $signboard_query = $signboard_query. ' and Date(signboards.created_at) BETWEEN "'.$from_date.'" AND "'.$to_date.'"';
                    }
                    else{
                        $from_date=\Morilog\Jalali\CalendarUtils::toGregorian(date('Y', strtotime($request->from_date)),date('m', strtotime($request->from_date)),date('d', strtotime($request->from_date)));
                        $from_date=$from_date[0].'-'.$from_date[1].'-'.$from_date[2];
                        $to_date=\Morilog\Jalali\CalendarUtils::toGregorian(date('Y', strtotime($request->to_date)),date('m', strtotime($request->to_date)),date('d', strtotime($request->to_date)));
                        $to_date=$to_date[0].'-'.$to_date[1].'-'.$to_date[2];
                        $customers_query=$customers_query.' and Date(customers.created_at) BETWEEN "'.$from_date.'" AND "'.$to_date.'"';
                        $illegal_customers_query=$illegal_customers_query.' and Date(illegal_customers.created_at) BETWEEN "'.$from_date.'" AND "'.$to_date.'"';
                        $faucet_query=$faucet_query.' and Date(faucet_changes.created_at) BETWEEN "'.$from_date.'" AND "'.$to_date.'"';
                        $faucet_diameter_query=$faucet_diameter_query.' and Date(faucet_diameter_customers.created_at) BETWEEN "'.$from_date.'" AND "'.$to_date.'"';
                        $signboard_query=$signboard_query.' and Date(signboards.created_at) BETWEEN "'.$from_date.'" AND "'.$to_date.'"';
                    }
                }
            }
        }

        $customers=DB::select($customers_query);
        $illegal_customers=DB::select($illegal_customers_query);
        $faucet_changes=DB::select($faucet_query);
        $faucet_diameter=DB::select($faucet_diameter_query);
        $signboard=DB::select($signboard_query);
        return view('admin.reports.customers_reports')->with('customers',$customers)->with('illegal_customers',$illegal_customers)->with('faucet_changes',$faucet_changes)->with('faucet_diameters',$faucet_diameter)->with('signboards',$signboard)->with('date_type',$request->date_type)->with('year',$request->year)->with('six_month_type',$request->six_mont_type)->with('month_id',$request->month_id)->with('quarter',$request->quarter)->with('from_date',$request->from_date)->with('to_date',$request->to_date);
    }
}
