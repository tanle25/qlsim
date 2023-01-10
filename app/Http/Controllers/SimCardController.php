<?php

namespace App\Http\Controllers;

use App\Exports\ExportSim;
use Upload;
use Carbon\Carbon;
use App\Models\Bill;
use App\Models\User;
use App\Models\Pakage;
use App\Models\Invoice;
use App\Models\Partner;
use App\Models\SimCard;
use App\Models\Customer;
use App\Models\SimOwner;
use App\Imports\ImportSim;
use App\Models\SimNetwork;
use App\Models\SimRequest;
use Illuminate\Support\Str;
use Illuminate\Http\Request;
use App\Imports\ImportSimCard;
use App\Models\History;
use App\Models\RequestStatus;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\App;
use Illuminate\Support\Facades\Auth;
use Maatwebsite\Excel\Facades\Excel;

class SimCardController extends Controller
{
    //
    public function index()
    {
        # code...
        // $role = Auth::user()->roles;
        // dd($role);
        $simCards = SimCard::orderBy('created_at', 'desc')->whereNot('status',4)->get();
        $partners = User::role(['dealer', 'collab'])->get();
        $customers = Customer::all();
        $packages = Pakage::all();
        $networks = SimNetwork::all();
        return view('admin.pages.product.index', ['simCards' => $simCards, 'partners' => $partners, 'customers' => $customers, 'packages' => $packages, 'networks' => $networks]);
    }

    public function canceledSim()
    {
        # code...
        $sims = SimCard::whereStatus(4)->get();
        return view('admin.pages.product.canceled-sim',['simCards'=>$sims]);
    }

    public function dealerCancel()
    {
        # code...
        $user = Auth::user();
        // dd($user->sims);
        $sims = $user->sims()->whereRelation('sim','status',4)->get();
        // dd($sims);
        return view('dealer.product.canceled-sim',['simCards'=>$sims]);
    }


    public function import(Request $request)
    {
        # code...
        if ($request->hasFile('file')) {
            $file = $request->file('file');
            Excel::import(new ImportSim, $file);
        } else {
        }
        return back();
    }
    public function store(Request $request)
    {
        # code...
        $request->validate([
            'number' => 'required|digits_between:10,15|unique:sim_cards,phone',
            'iccid' => 'required|digits_between:10,20|unique:sim_cards,iccid',
            'network' => 'required'
        ], [
            'required' => __(':attribute required'),
            'integer' => __(':attribute invalid'),
            'unique' => __(':attribute exists'),
            'digits_between'=>':attribute từ :min - :max'
        ], [
            'number' => __('phone'),
            'iccid' => 'ICCID',
            'network' => __('network')
        ]);

        $sim = SimCard::create([
            'phone' => $request->number,
            'iccid' => $request->iccid,
            'sim_network_id' => $request->network
        ]);

        History::create([
            'sim_card_id'=>$sim->id,
            'user_id'=>Auth::user()->id,
            'action'=>0
        ]);
        return back();
    }

    public function update(Request $request)
    {
        # code...
        $sim = SimCard::find($request->sim_id);
        if (is_null($sim)) {
            return redirect()->back()->withErrors(['not_found' => __('Not Found')]);
        }
        $request->validate([

            'number' => 'required|digits_between:10,15|unique:sim_cards,phone,' . $sim->id,
            'iccid' => 'required|numeric|digits_between:10,20|unique:sim_cards,iccid,' . $sim->id,
            'network' => 'required'
        ], [
            'required' => __(':attribute required'),
            'numeric' => __(':attribute invalid'),
            'unique' => __(':attribute exists'),
        ], [
            'number' => __('phone'),
            'iccid' => 'ICCID',
            'network' => __('network')
        ]);

        $oldIccid = $sim->old_iccid;

        if ($request->iccid != $sim->iccid) {
            $oldIccid = $sim->iccid;
        }

        $oldSim = $sim->load('network')->toJson();

        $sim->update([
            'phone' => $request->number,
            'iccid' => $request->iccid,
            'old_iccid' => $oldIccid,
            'sim_network_id' => $request->network,
        ]);

        History::create([
            'sim_card_id'=>$sim->id,
            'user_id'=>Auth::user()->id,
            'action'=>1,
            'content'=> $oldSim
        ]);
        return back();
    }

    public function updates(Request $request)
    {
        # code...
        dd($request->all());
        $sims = SimCard::whereIn('id', $request->sims)->get();
        if (is_null($sims)) {
            # code...
            return redirect()->back()->withErrors(['not_found' => __('Not Found')]);
        }
    }

    public function updateStatus(Request $request)
    {
        # code...
        $status = config('constrain.sim_status');

        // dd($request->all());

        $sim = SimCard::find($request->sim_id);
        if (is_null($sim)) {
            return redirect()->back()->withErrors(['not_found' => __('Not Found')]);
        } else if (!isset($status[$request->status])) {
            return redirect()->back()->withErrors(['not_found' => __(':attribute invalid', ['attribute' => __('status')])]);
        } else {
            if($request->status == 4){
                $sim->update([
                'is_rent'=>false,
                'expired'=>null
                ]);
                SimOwner::where('sim_card_id', $sim->id)->delete();
            }
            $action = 1;
            $status = $request->status;
            if($status == 1){
                $action = 8;
            }else if($status == 2){
                $action = 8;
            }else if($status == 3){
                $action = 7;
            }else if($status == 4){
                $action =6;
            }else if($status == 5){
                $action = 9;
            }
            History::create([
                'sim_card_id'=>$sim->id,
                'user_id'=>Auth::user()->id,
                'action'=>$action,
                'content'=> $sim->load('network')->toJson()
            ]);
            $sim->update([
                'status' => $request->status
            ]);
            return back();
        }
    }

    public function distribution(Request $request)
    {
        # code...

        $request->validate([
            'image'=>'image|mimes:png,jpg,jpeg|required'
        ],[
            'required'=>__(':attribute required'),
            'image'=>__(':attribute invalid'),
            'mimes'=>__(':attribute invalid'),
        ],[
            'image' =>__('Photo')
        ]);

        $sims = SimCard::whereIn('id', $request->sims)->get();
        if ($sims->whereNull('sim_network_id')->count() > 0) {
            return back()->withErrors(['loi' => 'Một số sim chưa có gói cước']);
        }
        if($sims->where('status','!=',1)->count() > 0 || $sims->where('is_rent',1)->count() > 0){
            return back()->withErrors(['loi' => 'Không thể thực hiện. một số sim dang cho thuê']);
        }
        $user = User::find($request->partner);
        $image = Upload::store($request->file('image'));
        foreach ($sims as $sim) {
            # code...
            $user->sims()->updateOrCreate([
                'sim_card_id'=>$sim->id,
            ],[
                'expired'=>Carbon::today()->addMonths($sim->network->duration)->toDateString(),
                'origin_price' => $sim->network->lease_price,
            ]);
            History::create([
                'sim_card_id'=>$sim->id,
                'user_id'=>Auth::user()->id,
                'action'=>4,
                'content'=> $sim->load('network')->toJson()
            ]);
            $sim->update([
                'is_rent'=>true,
                'expired'=>Carbon::today()->addMonths($sim->network->duration)->toDateString()
            ]);


            $user->invoices()->create([
                'sim_card_id'=>$sim->id,
                'price'=>$sim->network->lease_price,
                'image'=>$image,
                'from_date'=>Carbon::today()->toDateString(),
                'to_date'=>Carbon::today()->addMonths($sim->network->duration)->toDateString()
            ]);
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
                'customer' => 'required',
                'image' => 'required|image|mimes:png,jpg,jpeg'
            ], [

                'required' => __(':attribute required'),
                'date_format' => __(':attribute invalid')
            ], [
                'customer' => __('custommers'),
                'image' => __('Photo')
            ]);
            $imageUrl = Upload::store($request->file('image'));

            $sim = SimCard::find($request->sim_id);
            if ($sim->status != 1 || $sim->is_rent ) {
                return redirect()->back()->withErrors(['fail' => __('Cannot rent because canceled status')]);
            }
            $customer = Customer::find($request->customer);
            $customer->invoice()->create([
                'sim_card_id' => $sim->id,
                'price' => $sim->network->price,
                'image' => $imageUrl,
                'from_date'=> Carbon::today()->toDateString(),
                'to_date'=>Carbon::today()->addMonths($sim->network->duration)->toDateString()
            ]);

            History::create([
                'sim_card_id'=>$sim->id,
                'user_id'=>Auth::user()->id,
                'action'=>4,
                'content'=> $sim->load('network')->toJson()
            ]);
            $customer->sims()->create([
                'sim_card_id'=>$sim->id,
                'expired'=>Carbon::today()->addMonths($sim->network->duration)->toDateString(),
                'origin_price'=>$sim->network->lease_price,
                // 'lease_price'=>$sim->nerwork->lease_price
            ]);
            $sim->update([
                'is_rent'=>true,
                'expired'=>Carbon::today()->addMonths($sim->network->duration)->toDateString()
            ]);
            DB::commit();
        } catch (\Throwable $th) {
            DB::rollBack();
        }


        return back();
    }

    public function rentSimNewCustomer(Request $request)
    {
        # code...

        // dd($request->all());
        $re = '/(?:(?:http|https):\/\/)(?:www.)?facebook.com\/(?:(?:\w)*#!\/)?(?:pages\/)?(?:[?\w\-]*\/)?(?:profile.php\?id=(?=\d.*))?([\w\-]*)?/i';

        $request->validate([
            'name' => 'required',
            'sim' => 'required|exists:sim_cards,id',
            'address' => 'required',
            'image' => 'required|image|mimes:png,jpg,jpeg',
            'facebook' => ['nullable', 'regex:' . $re],
        ], [
            'required' => __(':attribute required'),
            'image' => __(':attribute invalid'),
            'regex' => __(':attribute invalid'),
            'exists' => __(':attribute not exists')
        ], [
            'name' => __('Full name'),
            'address' => __('Address'),
            'image' => __('Photo'),
            'facebook' => __('Facebook'),
            'sim' => __('sim')
        ]);

        DB::beginTransaction();
        try {
            //code...
            $sim = SimCard::find($request->sim);

            $customer = Customer::create([
                'name' => $request->name,
                'address' => $request->address,
                'facebook' => $request->facebook
            ]);
            $imageUrl = Upload::store($request->file('image'));

            if ($sim->status != 1 || $sim->is_rent) {
                return redirect()->back()->withErrors(['fail' => __('Cannot rent because canceled status')]);
            }

            $customer->invoice()->create([
                'sim_card_id' => $sim->id,
                'price' => $sim->network->price,
                'image' => $imageUrl,
                'from_date'=> Carbon::today()->toDateString(),
                'to_date'=>Carbon::today()->addMonths($sim->network->duration)->toDateString()
            ]);
            History::create([
                'sim_card_id'=>$sim->id,
                'user_id'=>Auth::user()->id,
                'action'=>4,
                'content'=> $sim->load('network')->toJson()
            ]);
            $customer->sims()->create([
                'sim_card_id'=>$sim->id,
                'expired'=>Carbon::today()->addMonths($sim->network->duration)->toDateString(),
                'origin_price'=>$sim->network->lease_price,
                // 'lease_price'=>$sim->nerwork->lease_price
            ]);
            $sim->update([
                'is_rent'=>true,
                'expired'=>Carbon::today()->addMonths($sim->network->duration)->toDateString()
            ]);

            DB::commit();
        } catch (\Throwable $th) {
            //throw $th;
            DB::rollBack();
        }



        return back();
    }

    public function getBill($id)
    {
        # code...
        $sim = SimCard::with('last_invoice.invoiceable')->where('id', $id)->first();
        // return 'test';
        return response()->json($sim);
    }

    public function showRequest(Request $request)
    {
        # code...
        $requests = RequestStatus::where('user_id', Auth::user()->id)->get();
        return view('dealer.product.request', [  'requestes' => $requests]);
    }

    public function simRequest(Request $request)
    {
        # code...
        // dd($request->all());
        $request->validate([
            'sims' => 'required',
            'sims.*' => 'required|exists:sim_cards,id'
        ], [
            'required' => __(':attribute required'),
            'exists' => __(':attribute not exists')
        ], [
            'sims' => __('sim')
        ]);
        $user = Auth::user();
        if ($user->partner == null) {
            return redirect()->back()->withErrors(['error' => __('not is partner')]);
        }

        foreach ($request->sims as $sim) {
            # code...
            // dd($sim);
            SimRequest::create([
                'partner_id' => $user->partner->id,
                'sim_card_id' => $sim
            ]);
        }
        return redirect()->back()->with(['success' => __('requested')]);
    }

    public function extendContract(Request $request)
    {
        # code...
        // dd($request->all());
        $request->validate([
            'sim_id' => 'required|exists:sim_cards,id',
            'image' => 'required|image|mimes:png,jpg,jpeg'
        ], [
            'required' => __(':attribute required'),
            'exists' => __(':attribute not exists'),
            'image' => __(':attribute invalid')
        ], [
            'sim_id' => __('bill'),
            'image' => __('Photo')
        ]);
        DB::beginTransaction();
        try {
            //code...
            $imageUrl = Upload::store($request->file('image'));
            $sim = SimCard::find($request->sim_id);
            $simOwner = SimOwner::where('sim_card_id', $sim->id)->first();
            $simOwner->update([
                'expired'=>Carbon::today()->addMonths($sim->network->duration)->toDateString(),
            ]);
            $invoice = $sim->invoice->first();
            $invoice->invoiceable->invoices()->create([
                'sim_card_id' => $sim->id,
                'price' => $sim->network->price,
                'image' => $imageUrl,
                'from_date'=> $invoice->from_date,
                'to_date'=>Carbon::parse($invoice->to_date)->addMonths($sim->network->duration)->toDateString()
            ]);
            History::create([
                'sim_card_id'=>$sim->id,
                'user_id'=>Auth::user()->id,
                'action'=>5,
                'content'=> $sim->load('network')->toJson()
            ]);
            $sim->update([
                'expired'=>Carbon::today()->addMonths($sim->network->duration)->toDateString()
            ]);
            DB::commit();
            return back()->with(['success' => __('Update success')]);
        } catch (\Throwable $th) {
            //throw $th;

            DB::rollBack();
            dd($th);
            return back()->withErrors(['fail' => __('Update Fail')]);
        }
    }

    public function changeStatus($status, Request $request)
    {
        # code...
        $listStatus = config('constrain.sim_status');
        // dd(config('constrain.sim_status'));
        if (!isset($listStatus[$status])) {
            return back()->withErrors(['fail' => 'Mã trạng thái không hợp lệ']);
        }
    }

    public function delete($id)
    {
        # code...
        $sim = SimCard::findOrFail($id);
        History::create([
            'sim_card_id'=>$sim->id,
            'user_id'=>Auth::user()->id,
            'action'=>3,
            'content'=> $sim->load('network')->toJson()
        ]);
        $sim->delete();
        return back()->with(['success' => __('Delete successfully')]);
    }

    public function history(SimCard $sim)
    {
        # code...

        $invoices = $sim->invoice;

        // dd($invoices);

        return view('admin.pages.product.history',['invoices'=>$invoices]);
    }

    public function invoiceImage(Invoice $invoice)
    {
        # code...
        $image = $invoice->image;
        return view('admin.component.invoice-image',['image'=>$image]);
    }

    public function deleteHistory(Request $request)
    {
        # code...
        // dd($request->all());
        Invoice::whereIn('id', $request->id)->delete();
        return back();
    }

    public function historyChange(SimCard $sim)
    {
        # code...
        // dd($sim->histories);
        return view('admin.pages.history-change',['histories'=>$sim->histories->load('sim.network')]);
    }

    public function deleteHistoryChange(History $history)
    {
        # code...
        $history->delete();
        return back();
    }

    public function updateExpired(SimCard $sim, Request $request)
    {
        # code...
        // dd($request->all());
        // $sim= SimCard::find($request->sim);
        $sim->update([
            'expired'=>$request->date
        ]);
        $owner = SimOwner::where('sim_card_id',$sim->id)->first();
        if($owner){
            $owner->update([
                'expired'=>$request->date
            ]);
        }
        return back();
    }

    public function updateRentedAt(SimCard $sim, Request $request)
    {
        # code...
        $owner = SimOwner::where('sim_card_id',$sim->id)->first();
        if($owner){
            $owner->update([
                'created_at'=>$request->date
            ]);
        }
        return back();
    }

    public function updateCreated(SimCard $sim, Request $request)
    {
        # code...
        $sim->update([
            'created_at'=>$request->date
        ]);
        return back();
    }


}
