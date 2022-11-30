<?php

namespace App\Http\Controllers;

use Carbon\Carbon;
use App\Models\User;
use App\Models\Invoice;
use App\Models\Partner;
use App\Models\SimCard;
use App\Models\Customer;
use App\Models\PartnerInvoice;
use App\Models\RequestStatus;
use App\Models\SimOwner;
use Carbon\CarbonPeriod;
use App\Models\WifiRequest;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Auth;

class DashBoardController extends Controller
{
    //

    public function index()
    {
        # code...


        $simCount = SimCard::all()->count();
        $customers = Customer::all()->count();
        $requestStatus = RequestStatus::all();
        $dealers = Partner::all()->count();
        $wifiRequests = WifiRequest::whereNot('status',3)->get();
        $simAlerts = SimCard::where('expired','=>',Carbon::today()->subDays(5)->toDateString())->get();
        $year = Carbon::today()->year;
        $month = Carbon::today()->month;
        $data = [];
        for ($i=1; $i <= Carbon::today()->daysInMonth; $i++) {
            $t = Carbon::create($year, $month, $i);
            # code...
            // dd($t->toDateString());
            $invoices = Invoice::whereDate('created_at',$t->toDateString())->sum('price');
            $data[$i]= $invoices;
        }
        return view('admin.pages.dashboard',['simCount'=>$simCount,'customers'=>$customers,'dealers'=>$dealers,'wifiRequests'=>$wifiRequests,'simAlerts'=>$simAlerts,'requestStatus'=>$requestStatus, 'data'=>$data]);
    }

    public function userIndex()
    {
        # code...
        $user = Auth::user();
        $simCount = $user->simS->count();
        $customers = Customer::all()->count();
        $dealers = Partner::all()->count();
        $wifiRequests = WifiRequest::whereNot('status',3)->get();
        // $invoices_wifi = PartnerInvoice::whereBetween('created_at',[Carbon::now()->startOfWeek()->toDateString(),Carbon::now()->endOfWeek()->toDateString()])
        // ->where('invoiceable_type',WifiRequest::class)
        // ->get()
        // ->groupBy(function($date) {
        //     return Carbon::parse($date->created_at)->dayOfWeek;
        // });

        // $invoices_sim = PartnerInvoice::whereBetween('created_at',[Carbon::now()->startOfWeek()->toDateString(),Carbon::now()->endOfWeek()->toDateString()])
        // ->where('invoiceable_type',SimCard::class)
        // ->get()
        // ->groupBy(function($date) {
        //     return Carbon::parse($date->created_at)->dayOfWeek;
        // });
        // $data_sim = [];
        // $data_wifi = [];
        // for ($i=0; $i <= 6; $i++) {
        //     # code...
        //     if(isset($invoices_sim[$i])){
        //         $data_sim[$i] =$invoices_sim[$i]->sum('lease_price');
        //     }else{
        //         $data_sim[$i] =0;
        //     }
        //     if(isset($invoices_wifi[$i])){
        //         $data_wifi[$i] =$invoices_wifi[$i]->sum('lease_price');
        //     }else{
        //         $data_wifi[$i] =0;
        //     }
        // }

        // $end_date = Carbon::today()->addDays(5);
        // $simAlerts = SimOwner::where('partner_id', Auth::user()->partner_id)->whereRelation('sim.bills', function($q) use ($end_date){
        //     return $q->where('end_at','<=', $end_date->toDateString())->where('end_at','>=',Carbon::today()->toDateString());
        // })->get();
        // $simAlerts = collect();
        return view('dealer.dashboard',['simCount'=>$simCount,'customers'=>$customers,'dealers'=>$dealers,'wifiRequests'=>$wifiRequests]);
    }

}
