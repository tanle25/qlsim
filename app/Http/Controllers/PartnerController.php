<?php

namespace App\Http\Controllers;

use Carbon\Carbon;
use App\Models\User;
use App\Models\History;
use App\Models\Partner;
use App\Models\SimCard;
use App\Models\SimOwner;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class PartnerController extends Controller
{
    //
    public function index()
    {
        # code...
        // $partners = Partner::all();
        $users = User::role(['dealer','collab'])->get();
        return view('admin.pages.partner.index',['users'=>$users]);
    }

    public function store(Request $request)
    {
        # code...
        $types = config('constrain.partner');
        $request->validate([
            'name'=>'required',
            'phone'=>'required',
            'type'=>'required',
            'address'=>'required'
        ],[
            'required'=>__(':attribute required'),
            'in_array'=>__(':attribute not exists')
        ],[
            'name'=>__('agent or collaborator name'),
            'phone'=>__('phone'),
            'type'=>__('dealer & colllab'),
            'address'=>__('Address')
        ]);
        $request->request->add(['status'=>1]);
        Partner::create($request->all());
        // dd($request);
        return back();
    }

    public function update(Request $request)
    {
        # code...
        $request->validate([
            'partner_id'=>'required|exists:partners,id',
            'name'=>'required',
            'phone'=>'required|digits_between:10,15',
            'type'=>'required',
            'address'=>'required'
        ],[
            'required'=>__(':attribute required'),
            'in_array'=>__(':attribute not exists'),
            'exists'=>__(':attribute exists')
        ],[
            'name'=>__('agent or collaborator name'),
            'phone'=>__('phone'),
            'type'=>__('dealer & colllab'),
            'address'=>__('Address'),
            'partner_id'=>__('dealer & colllab'),
        ]);
        $partner = Partner::find($request->partner_id);
        $partner->update($request->all());
        return back()->with(['success'=>__('Updated.')]);

    }

    public function showListSim(Request $request)
    {
        # code...

        $sims = SimOwner::whereIn('partner_id',$request->partner)->get();


        return view('admin.pages.list-sim',['sims'=>$sims]);
    }

    public function showProduct($id)
    {
        # code...

        $partner = User::findOrFail($id);
        $sims = $partner->sims()->whereRelation('sim','deleted_at',null)->get();
        $sim_not_rent = SimCard::has('network')->doesntHave('partner')->where('status',1)->limit(30)->get();

        // dd($sim_not_rent);
        return view('admin.pages.list-sim',['sims'=>$sims,'user'=>$partner,'sim_not_rent'=>$sim_not_rent]);

    }

    public function addSim(Request $request, User $user)
    {
        # code...
        // dd($user, $request->all());
        foreach($request->sim as $sim){
            $simCard = SimCard::find($sim);
            $user->sims()->create([
                'sim_card_id'=>$sim,
                'expired'=> Carbon::today()->addMonths($simCard->network->duration)->toDateString(),
                'origin_price'=>$simCard->network->lease_price
            ]);

            History::create([
                'sim_card_id'=>$sim,
                'user_id'=>Auth::user()->id,
                'action'=>4
            ]);
        }
        return back()->with(['success'=>'Đã thêm sim vào đại lý']);
    }

    public function delete(Request $request)
    {
        # code...
        $request->validate([
            'partner_id'=>'required|exists:partners,id'
        ],[
            'required'=>__(':attribute required'),
            'exists'=>__(':attribute exists')
        ],[
            'partner_id'=>__('dealer & colllab')
        ]);
        $partner = Partner::find($request->partner_id);
        $users = User::where('partner_id',$partner->id)->update(['partner_id'=>null]);
        $partner->delete();
        return back()->with(['success'=>__('Delete successfully')]);
    }

    public function addOwner(Request $request)
    {
        # code...
        // dd($request->all());
        $request->validate([
            'user_id'=>'required|exists:users,id',
            'partner_id'=>'required|exists:partners,id',
        ],[
            'required'=>__(':attribute required'),
            'exists'=>__(':attribute not exists')
        ],[
            'user_id'=>__('user'),
            'partner_id'=>__('dealer & colllab')
        ]);

        $user = User::find($request->user_id);
        $user->update([
            'partner_id'=>$request->partner_id
        ]);
        $user->partnerRole()->updateOrCreate([
            'role'=>1
        ],[

            'partner_id'=>$request->partner_id
        ]);
        $user->syncPermissions(['user manager','add package']);

        return back()->with(['success'=>__('Success')]);
    }
}
