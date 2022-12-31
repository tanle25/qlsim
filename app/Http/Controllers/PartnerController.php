<?php

namespace App\Http\Controllers;

use App\Models\Partner;
use App\Models\SimCard;
use App\Models\SimOwner;
use App\Models\User;
use Illuminate\Http\Request;

class PartnerController extends Controller
{
    //
    public function index()
    {
        # code...
        $partners = Partner::all();
        // $users = User::all();
        $users = User::role(['dealer','collab'])->get();
        // dd($users);

        return view('admin.pages.partner.index',['partners'=>$partners,'users'=>$users]);
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
        dd($request);
        return back();
    }

    public function update(Request $request)
    {
        # code...
        $request->validate([
            'partner_id'=>'required|exists:partners,id',
            'name'=>'required',
            'phone'=>'required',
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
        // dd($request->all());
        $sims = SimOwner::whereIn('partner_id',$request->partner)->get();
        // dd($sims);
        return view('admin.pages.list-sim',['sims'=>$sims]);
    }

    public function showProduct($id)
    {
        # code...

        $partner = User::findOrFail($id);
        // dd($partner);
        // dd($partner->sims);
        return view('admin.pages.list-sim',['sims'=>$partner->sims,'user'=>$partner]);

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
