<?php

namespace App\Http\Controllers;

use App\Imports\ImportSim;
use Carbon\Carbon;
use App\Models\Partner;
use App\Models\SimCard;
use App\Models\Customer;
use Illuminate\Support\Str;
use Illuminate\Http\Request;
use App\Imports\ImportSimCard;
use App\Models\Bill;
use App\Models\Pakage;
use App\Models\SimNetwork;
use App\Models\SimRequest;
use Illuminate\Support\Facades\App;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Maatwebsite\Excel\Facades\Excel;

class SimCardController extends Controller
{
    //
    public function index()
    {
        # code...
        // $role = Auth::user()->roles;
        // dd($role);
        $simCards = SimCard::all();
        $partners = Partner::all();
        $customers = Customer::all();
        $packages = Pakage::all();
        $networks = SimNetwork::all();
        return view('admin.pages.product.index',['simCards'=>$simCards,'partners'=>$partners,'customers'=>$customers,'packages'=>$packages,'networks'=>$networks]);
    }


    public function import(Request $request)
    {
        # code...
        if($request->hasFile('file')){
            $file = $request->file('file');
            Excel::import(new ImportSim, $file);
        }else{
            dd($request->all());
        }
        return back();
    }
    public function store(Request $request)
    {
        # code...
        $request->validate([
            'number'=>'required|unique:sim_cards,phone',
            'iccid'=>'required|numeric|unique:sim_cards,iccid',
            'network'=>'required'
        ],[
            'required'=>__(':attribute required'),
            'numeric'=>__(':attribute invalid'),
            'unique'=>__(':attribute exists'),
        ],[
            'number'=>__('phone'),
            'iccid'=>'ICCID',
            'network'=>__('network')
        ]);

        SimCard::create([
            'phone'=>$request->number,
            'iccid'=>$request->iccid,
            'sim_network_id'=>$request->network
        ]);
        return back();
    }

    public function update(Request $request)
    {
        # code...
        $sim = SimCard::find($request->sim_id);
        if (is_null($sim)) {
            # code...
            return redirect()->back()->withErrors(['not_found'=>__('Not Found')]);
        }
        $request->validate([
            'number'=>'required|unique:sim_cards,phone,'.$sim->id,
            'iccid'=>'required|numeric|unique:sim_cards,iccid,'.$sim->id,
            'network'=>'required'
        ],[
            'required'=>__(':attribute required'),
            'numeric'=>__(':attribute invalid'),
            'unique'=>__(':attribute exists'),
        ],[
            'number'=>__('phone'),
            'iccid'=>'ICCID',
            'network'=>__('network')
        ]);

        $oldIccid = $sim->old_iccid;

        if($request->iccid != $sim->iccid){
            $oldIccid = $sim->iccid;
        }

        $sim->update([
            'phone'=> $request->number,
            'iccid'=>$request->iccid,
            'old_iccid'=>$oldIccid,
            'sim_network_id'=>$request->network,
            'origin_price'=>$request->origin_price,
            'lease_price'=>$request->lease_price
        ]);
        return back();
    }

    public function updateStatus(Request $request)
    {
        # code...
        $status = config('constrain.sim_status');

        $sim = SimCard::find($request->sim_id);
        if(is_null($sim)){
            return redirect()->back()->withErrors(['not_found'=>__('Not Found')]);
        }else if(!isset($status[$request->status])){
            return redirect()->back()->withErrors(['not_found'=>__(':attribute invalid',['attribute'=>__('status')])]);
        }
        else{
            $sim->update([
                'status'=>$request->status
            ]);
            return back();
        }
    }

    public function distribution(Request $request)
    {
        # code...
        $sims = SimCard::whereIn('id',$request->sims)->get();
        // dd($sims->whereNull('origin_price'));
        if($sims->whereNull('origin_price')->count() > 0 || $sims->whereNull('lease_price')->count() > 0)
        {
            return back()->withErrors(['loi'=>'Có một số sim chưa có giá nhập vào hoặc giá cho thuê']);
        }
        foreach ($sims as $sim) {
            # code...
            $sim->partner()->updateOrCreate([
                'partner_id'=>$request->partner
            ],
            [
                'origin_price'=>$sim->lease_price
            ]
        );
        }
        return back();
    }

    public function rentSim(Request $request)
    {
        # code...

        DB::beginTransaction();

        try {
            //code...
            $request->validate([
                'customer'=>'required',
                'package'=>'required|exists:pakages,id',
                'image'=>'required|image|mimes:png,jpg,jpeg'
            ],[

                'required'=>__(':attribute required'),
                'date_format'=>__(':attribute invalid')
            ],[
                'customer'=>__('custommers'),
                'image'=>__('Photo')
            ]);
            $imageUrl = '';
            if($request->hasFile('image')){
                $image = $request->file('image');

                $ext = $image->getClientOriginalExtension();
                $fileName = Str::random(16).'.'.$ext;
                $request->file('image')->storeAs('/public/images',$fileName);
                $imageUrl = 'storage/images/'.$fileName;
            }
            $sim = SimCard::find($request->sim_id);
            if($sim->status == 4){
                return redirect()->back()->withErrors(['fail'=>__('Cannot rent because canceled status')]);
            }
            $package = Pakage::find($request->package);
            $bill = $sim->bill()->create([
                'image'=>$imageUrl,
                'customer_id'=>$request->customer,
                'packageable_type'=>Pakage::class,
                'packageable_id'=>$package->id,
                'start_at'=>Carbon::today()->toDateString(),
                'end_at'=>Carbon::today()->addMonths($package->duration)->toDateString()
            ]);

            // dd($bill);
            $sim->invoice()->create([
                'bill_id'=>$bill->id,
                'origin_price'=>$sim->origin_price,
                'lease_price'=>$sim->lease_price,
                'type'=>1,
            ]);
            $sim->update([
                'status'=>2
            ]);
            DB::commit();
        } catch (\Throwable $th) {
            //throw $th;
            DB::rollBack();
            // dd($th);

        }


        return back();
    }

    public function rentSimNewCustomer(Request $request)
    {
        # code...

        // dd($request->all());
        $re = '/(?:(?:http|https):\/\/)(?:www.)?facebook.com\/(?:(?:\w)*#!\/)?(?:pages\/)?(?:[?\w\-]*\/)?(?:profile.php\?id=(?=\d.*))?([\w\-]*)?/i';

        $request->validate([
            'name'=>'required',
            'sim'=>'required|exists:sim_cards,id',
            'address'=>'required',
            'image'=>'required|image|mimes:png,jpg,jpeg',
            'facebook'=>['nullable','regex:'.$re],
            'package'=>'required|exists:pakages,id',
        ],[
            'required'=>__(':attribute required'),
            'image'=>__(':attribute invalid'),
            'regex'=>__(':attribute invalid'),
            'exists'=>__(':attribute not exists')
        ],[
            'name'=>__('Full name'),
            'address'=>__('Address'),
            'image'=>__('Photo'),
            'facebook'=>__('Facebook'),
            'package'=>__('pakage'),
            'sim'=>__('sim')
        ]);

        DB::beginTransaction();
        try {
            //code...
            $customer = Customer::create([
                'name'=>$request->name,
                'address'=>$request->address,
                'facebook'=>$request->facebook
            ]);
            $imageUrl = '';
            if($request->hasFile('image')){
                $image = $request->file('image');

                $ext = $image->getClientOriginalExtension();
                $fileName = Str::random(16).'.'.$ext;
                $request->file('image')->storeAs('/public/images',$fileName);
                $imageUrl = 'storage/images/'.$fileName;
            }
            $package = Pakage::find($request->package);
            $start_at = Carbon::today()->toDateString();
            $end_at = Carbon::today()->addMonths($package->duration)->toDateString();
            // Bill::create([
            //     'sim_card_id'=>$request->sim,

            // ]);
            $sim = SimCard::find($request->sim);
            if($sim->status == 4){
                return redirect()->back()->withErrors(['fail'=>__('Cannot rent because canceled status')]);
            }
            $bill = $sim->bill()->create([
                'customer_id'=>$customer->id,
                'image'=>$imageUrl,
                'packageable_type'=>Pakage::class,
                'packageable_id'=>$package->id,
                'start_at'=>$start_at,
                'end_at'=>$end_at
            ]);
            $sim->invoice()->create([
                'bill_id'=>$bill->id,
                'origin_price'=>$sim->origin_price,
                'lease_price'=>$sim->lease_price,
                'type'=>1
            ]);
            DB::commit();
        } catch (\Throwable $th) {
            //throw $th;
            DB::rollBack();
            dd($th);
        }



        return back();
    }

    public function getBill($id)
    {
        # code...
        $sim = SimCard::with(['bill.customer','bill.modelable'])->where('id',$id)->first();
        return response()->json($sim->bill);
    }

    public function showRequest(Request $request)
    {
        # code...
        $all = SimCard::whereNotNull(['origin_price','lease_price'])->doesntHave('partner')->doesntHave('request')->get();
        $requestest = Auth::user()->partner->requests;
        return view('dealer.product.request',['all'=>$all,'requestest'=>$requestest]);
    }

    public function simRequest(Request $request)
    {
        # code...
        // dd($request->all());
        $request->validate([
            'sims'=>'required',
            'sims.*'=>'required|exists:sim_cards,id'
        ],[
            'required'=>__(':attribute required'),
            'exists'=>__(':attribute not exists')
        ],[
            'sims'=>__('sim')
        ]);
        $user = Auth::user();
        if($user->partner == null){
            return redirect()->back()->withErrors(['error'=>__('not is partner')]);
        }

        foreach ($request->sims as $sim) {
            # code...
            // dd($sim);
            SimRequest::create([
                'partner_id'=>$user->partner->id,
                'sim_card_id'=>$sim
            ]);
        }
        return redirect()->back()->with(['success'=>__('requested')]);
    }

    public function extendContract(Request $request)
    {
        # code...
        // dd($request->all());
        $request->validate([
            'sim_id'=>'required|exists:sim_cards,id',
            'package'=>'required|exists:pakages,id',
            'image'=>'required|image|mimes:png,jpg,jpeg'
        ],[
            'required'=>__(':attribute required'),
            'exists'=>__(':attribute not exists'),
            'image'=>__(':attribute invalid')
        ],[
            'sim_id'=>__('bill'),
            'package'=>__('pakage'),
            'image'=>__('Photo')
        ]);
        DB::beginTransaction();
        try {
            //code...
            $imageUrl = '';
            if($request->hasFile('image')){
                $image = $request->file('image');

                $ext = $image->getClientOriginalExtension();
                $fileName = Str::random(16).'.'.$ext;
                $request->file('image')->storeAs('/public/images',$fileName);
                $imageUrl = 'storage/images/'.$fileName;
            }
            $sim = SimCard::find($request->sim_id);
            $package = Pakage::find($request->package);
            $bill = $sim->bill;
            $end_date = Carbon::parse($bill->end_at)->addMonths($package->duration);
            $bill->update([
                'end_at'=>$end_date->toDateString(),
                'image'=>$imageUrl
            ]);
            $sim->invoice()->create([
                'bill_id'=>$bill->id,
                'origin_price'=>$package->origin_price,
                'lease_price'=>$package->rent_price,
                'type'=>2
            ]);
            DB::commit();
            return back()->with(['success'=>__('Update success')]);
        } catch (\Throwable $th) {
            //throw $th;

            DB::rollBack();
            dd($th);
            return back()->withErrors(['fail'=>__('Update Fail')]);
        }


    }

    public function changeStatus($status, Request $request)
    {
        # code...
        $listStatus = config('constrain.sim_status');
        // dd(config('constrain.sim_status'));
        if(!isset($listStatus[$status])){
            return back()->withErrors(['fail'=>'Mã trạng thái không hợp lệ']);
        }

    }

    public function delete($id)
    {
        # code...
        $sim = SimCard::findOrFail($id)->delete();
        return back()->with(['success'=>__('Delete successfully')]);
    }

}
