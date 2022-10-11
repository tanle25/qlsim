<?php

namespace App\Http\Controllers;

use App\Models\SimCard;
use App\Models\Customer;
use App\Models\SimOwner;
use App\Models\SimRequest;
use App\Models\WifiNetwork;
use App\Models\WifiPackage;
use App\Models\WifiRequest;
use Carbon\Carbon;
use Illuminate\Support\Str;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Auth;

class RequestController extends Controller
{
    //
    public function index()
    {
        # code...
        $custommers = Customer::all();
        $networks = WifiNetwork::all();
        $packages = WifiPackage::all();
        $requests = WifiRequest::all();
        return response()->view('dealer.wifi.index',['customers'=>$custommers,'networks'=>$networks,'packages'=>$packages,'requests'=>$requests]);
    }

    public function showRequestSim()
    {
        # code...
        $requestest = SimRequest::all();
        return view('admin.pages.product.request',['requestest'=>$requestest]);
    }

    public function replyRequest(Request $request)
    {
        # code...
        // dd($request->all());
        $request->validate([
            'sims'=>'required',
            'sim.*'=>'required|exists:sim_requests,id'
        ],[
            'required'=>__(':attribute required'),
            'exists'=>__(':attribute not exists')
        ],[
            'sims'=>__('request')
        ]);
        $requests = SimRequest::whereIn('id',$request->sims)->get();
        if($request->reply == 1){
            foreach ($requests as $req) {
                # code...
                $req->delete();
            }

        }else{
            foreach ($requests as $req) {
                # code...
                SimOwner::create([
                    'partner_id'=>$req->partner->id,
                    'sim_card_id'=>$req->sim->id,
                    'origin_price'=>$req->sim->lease_price
                ]);
                $req->delete();
            }
        }
        return back();
    }

    public function showNetwork()
    {
        # code...
        $networks = WifiNetwork::all();
        return view('dealer.wifi.network',['networks'=>$networks]);
    }

    public function showPackage()
    {
        # code...
        $packages = WifiPackage::all();
        $networks = WifiNetwork::all();
        return view('dealer.wifi.package',['packages'=>$packages,'networks'=>$networks]);
    }

    public function createOldRequest(Request $request)
    {
        # code...
        $user = Auth::user();
        // dd($user->partner);
        $request->validate([
            'customer_id'=>'required|exists:customers,id',
            'wifi_package_id'=>'required|exists:wifi_packages,id'

        ],[
            'required'=>__(':attribute required'),
            'exists'=>__(':attribute not exists')
        ],[
            'customer_id'=>__('custommers'),
            'wifi_package_id'=>__('pakage')
        ]);
        if($user->partner){
            $request->request->add(['partner_id'=>$user->partner->id]);
        }
        DB::beginTransaction();
            try {
                //code...
                $wifi = WifiRequest::create($request->all());
            $imageUrl ='';
            $wifiPackage = WifiPackage::find($request->wifi_package_id);
            $start_at = Carbon::today()->toDateString();
            $end_at = Carbon::today()->addMonths($wifiPackage->duration)->toDateString();
            if($request->hasFile('image')){
                $image = $request->file('image');

                $ext = $image->getClientOriginalExtension();
                $fileName = Str::random(16).'.'.$ext;
                $request->file('image')->storeAs('/public/images',$fileName);
                $imageUrl = 'storage/images/'.$fileName;
            }
            $bill = $wifi->bill()->create([
                'customer_id'=>$request->customer_id,
                'image'=>$imageUrl,
                'start_at'=>$start_at,
                'end_at'=>$end_at
            ]);

            $wifi->invoice()->create([
                'bill_id'=>$bill->id,
                'origin_price'=>$wifi->package->price,
                'lease_price'=>$wifi->package->price + $wifi->package->fee,
                'type'=>3
            ]);

            $wifi->partnerInvoice()->create([
                'partner_id'=>Auth::user()->partner_id,
                'bill_id'=>$bill->id,
                'origin_price'=>$wifi->package->price,
                'lease_price'=>$wifi->package->price + $wifi->package->fee,
                'type'=>3
            ]);
            DB::commit();

        } catch (\Throwable $th) {
            //throw $th;
            DB::rollBack();
            dd($th);

        }


        return back();

    }

    public function createNewRequest(Request $request)
    {
        # code...
        // dd($request->all());
        $re = '/(?:(?:http|https):\/\/)(?:www.)?facebook.com\/(?:(?:\w)*#!\/)?(?:pages\/)?(?:[?\w\-]*\/)?(?:profile.php\?id=(?=\d.*))?([\w\-]*)?/i';
        $request->validate([
            'custommer_name'=>'required',
            'address'=>'required',
            'wifi_package_id'=>'required|exists:wifi_packages,id',
            'facebook'=>['nullable','regex:'.$re]
        ],[
            'required'=>__(':attribute required'),
            'exists'=>__(':attribute not exists'),
            'regex'=>__(':attribute invalid')
        ],[
            'custommer_name'=>__('Full name'),
            'address'=>__('Address'),
            'wifi_package_id'=>__('pakage'),
            'facebook'=>'Facebook'
        ]);
        // dd('passed');
        DB::beginTransaction();
        try {
            //code...
            $custommer = Customer::create([
                'name'=>$request->custommer_name,
                'address'=>$request->address,
                'facebook'=>$request->facebook
            ]);
            $user = Auth::user();
            $partner_id = null;
            if ($user->partner) {
                # code...
                $partner_id = $user->partner->id;
            }

            $req = WifiRequest::create([
                'partner_id'=>$partner_id,
                'customer_id'=>$custommer->id,
                'wifi_package_id'=>$request->wifi_package_id,
                'content'=>$request->content
            ]);
            $imageUrl ='';
            $wifiPackage = WifiPackage::find($request->wifi_package_id);
            $start_at = Carbon::today()->toDateString();
            $end_at = Carbon::today()->addMonths($wifiPackage->duration)->toDateString();
            if($request->hasFile('image')){
                $image = $request->file('image');
                $ext = $image->getClientOriginalExtension();
                $fileName = Str::random(16).'.'.$ext;
                $request->file('image')->storeAs('/public/images',$fileName);
                $imageUrl = 'storage/images/'.$fileName;
            }
            $bill = $req->bill()->create([
                'customer_id'=>$custommer->id,
                'image'=>$imageUrl,
                'start_at'=>$start_at,
                'end_at'=>$end_at
            ]);
            $req->invoice()->create([
                'bill_id'=>$bill->id,
                'origin_price'=>$req->package->price,
                'lease_price'=>$req->package->price + $req->package->fee,
                'type'=>3
            ]);

            $req->partnerInvoice()->create([
                'partner_id'=>Auth::user()->partner_id,
                'bill_id'=>$bill->id,
                'origin_price'=>$req->package->price,
                'lease_price'=>$req->package->price + $req->package->fee,
                'type'=>3
            ]);
            DB::commit();
            return back();
        } catch (\Throwable $th) {
            //throw $th;
            dd($th);
            DB::rollBack();
            return back()->withErrors('loi',__('Server Error'));


        }



    }

    public function createPackage(Request $request)
    {
        # code...
        // dd($request->all());
        $request->validate([
            'name' =>'required',
            'network'=>'required',
            'duration'=>'required|numeric',
            'price'=>'required',
            'fee'=>'required'
        ],[
            'required'=>__(':attribute required'),
            'numeric'=>__(':attribute invalid')
        ],[
            'name'=>__('pakage name'),
            'network'=>__('network'),
            'duration'=>__('duration'),
            'price'=>__('price'),
            'fee'=>__('Fee')
        ]);

        WifiPackage::create([
            'name'=>$request->name,
            'wifi_network_id'=>$request->network,
            'number_of_month'=>$request->duration,
            'price'=>$request->price,
            'fee'=>$request->fee
        ]);
        return back();
    }
    public function createNetwork(Request $request)
    {
        // dd($request->all());
        $request->validate([
            'name'=>'required|unique:wifi_networks,name'
        ],[
            'required'=>__(':attribute required'),
            'unique'=>__(':attribute exists')
        ],[
            'name'=>__('network name')
        ]);
        WifiNetwork::create($request->all());
        return back();
        # code...
    }
}
