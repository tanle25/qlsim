<?php

namespace App\Http\Controllers\Partner;

use Carbon\Carbon;
use App\Models\Pakage;
use App\Models\SimCard;
use App\Models\Customer;
use Illuminate\Support\Str;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use App\Http\Controllers\Controller;
use App\Models\Bill;
use App\Models\PartnerPackage;
use App\Models\SimOwner;
use Illuminate\Support\Facades\Auth;
use Upload;

class SimCardController extends Controller
{
    //

    public function index()
    {
        # code...
        $user = Auth::user();
        $simCards = $user->sims;
        $customers = Customer::all();
        // $packages = PartnerPackage::all();


        return view('dealer.product.index',['simCards'=>$simCards,'customers'=>$customers]);

    }

    public function rentSim(Request $request)
    {
        # code...

        DB::beginTransaction();


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
        try {

            $sim = SimCard::find($request->sim);
            if($sim->status == 4){
                return redirect()->back()->withErrors(['fail'=>__('Cannot rent because canceled status')]);
            }
            $simOwner = SimOwner::where(['partner_id'=>Auth::user()->partner_id,'sim_card_id'=>$sim->id])->first();

            $imageUrl = '';
            if($request->hasFile('image')){
                $image = $request->file('image');

                $ext = $image->getClientOriginalExtension();
                $fileName = Str::random(16).'.'.$ext;
                $request->file('image')->storeAs('/public/images',$fileName);
                $imageUrl = 'storage/images/'.$fileName;
            }
            $package = PartnerPackage::find($request->package);
            $bill = $sim->bill()->create([
                'image'=>$imageUrl,
                'partner_id'=>Auth::user()->partner_id,
                'customer_id'=>$request->customer,
                'packageable_type'=>Pakage::class,
                'packageable_id'=>$package->package->id,
                'start_at'=>Carbon::today()->toDateString(),
                'end_at'=>Carbon::today()->addMonths($package->package->duration)->toDateString()
            ]);

            // dd($bill);
            $sim->invoice()->create([
                'bill_id'=>$bill->id,
                'partner_id'=>Auth::user()->partner_id,
                'origin_price'=>$package->package->origin_price,
                'lease_price'=>$package->package->rent_price,
                'type'=>1
            ]);
            $sim->partnerInvoice()->create([
                'partner_id'=>Auth::user()->partner_id,
                'bill_id'=>$bill->id,
                'origin_price'=>$package->package->rent_price,
                'lease_price'=>$package->lease_price,
                'type'=>1
            ]);
            $sim->update([
                'status'=>2
            ]);
            DB::commit();
        } catch (\Throwable $th) {
            //throw $th;
            DB::rollBack();

        }


        return back();
    }

    public function rentSimNewCustomer(Request $request)
    {
        # code...
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

            $sim = SimCard::find($request->sim);
            if($sim->status == 4){
                return redirect()->back()->withErrors(['fail'=>__('Cannot rent because canceled status')]);
            }
            $simOwner = SimOwner::where(['partner_id'=>Auth::user()->partner_id,'sim_card_id'=>$sim->id])->first();

            if(is_null($simOwner->lease_price)){
                return redirect()->back()->withErrors(['errors'=>__('no lease price')]);
            }

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
            $package = PartnerPackage::find($request->package);
            $start_at = Carbon::today()->toDateString();
            $end_at = Carbon::today()->addMonths($package->package->duration)->toDateString();

            $bill = $sim->bill()->create([
                'customer_id'=>$customer->id,
                'partner_id'=>Auth::user()->partner_id,
                'packageable_type'=>Pakage::class,
                'packageable_id'=>$package->package->id,
                'image'=>$imageUrl,
                'start_at'=>$start_at,
                'end_at'=>$end_at
            ]);

            // Create in voice for admin
            $sim->invoice()->create([
                'bill_id'=>$bill->id,
                'origin_price'=>$package->package->origin_price,
                'lease_price'=>$package->package->rent_price,
                'type'=>1
            ]);

            // Create invoice for partner

            $sim->partnerInvoice()->create([
                'partner_id'=>Auth::user()->partner_id,
                'bill_id'=>$bill->id,
                'origin_price'=>$package->package->rent_price,
                'lease_price'=>$package->lease_price,
                'type'=>1
            ]);
            DB::commit();
        } catch (\Throwable $th) {
            //throw $th;
            DB::rollBack();
        }



        return back();
    }

    public function extendContract(Request $request)
    {
        # code...
        // dd($request->all());
        $request->validate([
            'sim_id'=>'required|exists:sim_owners,id',
            'image'=>'required|image|mimes:png,jpg,jpeg'
        ],[
            'required'=>__(':attribute required'),
            'exists'=>__(':attribute not exists'),
            'image'=>__(':attribute invalid')
        ],[
            'sim_id'=>__('bill'),
            'image'=>__('Photo')
        ]);
        $imageUrl = Upload::store($request->file('image'));

        $sim = SimOwner::find($request->sim_id);

        return back()->with(['success'=>__('Update success')]);
    }
}
