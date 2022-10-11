<?php

namespace App\Http\Controllers;

use Exception;
use App\Models\User;
use App\Models\Invite;
use Illuminate\Support\Str;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Auth;
use App\Notifications\InviteNotification;
use Illuminate\Support\Facades\Notification;


class InviteController extends Controller
{
    //

    public function searchUser(Request $request)
    {
        # code...
        $users =  User::whereNull('partner_id')->where('phone','LIKE',"%$request->keyword%")->orWhere('email','LIKE',"%$request->keyword%")
        ->notRole('admin')->limit(5)->get();
        return response()->json($users);
    }
    public function invite(Request $request)
    {
        // dd($request->all());
        do {
            # code...
            $token = Str::random();
        } while (Invite::where('token', $token)->first());
        $user = User::find($request->user_id);
        $partner = Auth::user()->partner;
        $invite = Invite::create([
            'token'=>$token,
            'partner_id'=>$partner->id
        ]);
        Notification::send($user,new InviteNotification($invite));
        return back()->with(['success'=>__('The action was executed successfully.')]);
    }
    public function decline($token, $notify)
    {
        // process the form submission and send the invite by email
        DB::beginTransaction();
        try{
            $invite = Invite::where('token',$token)->firstOrFail();
            $notification = Auth::user()->notifications()->where('id',$notify)->firstOrFail();
            $notification->delete();
            $invite->delete();
            DB::commit();
            return back();

        }catch(Exception $e){
            DB::rollBack();
            return back()->withErrors(['fail'=>__('Server Error')]);
        }


    }
    public function accept($token, $notify)
    {
        DB::beginTransaction();
        try{
            $invite = Invite::where('token',$token)->firstOrFail();
            $notification = Auth::user()->notifications()->where('id',$notify)->firstOrFail();
            $user = Auth::user();
            $user->update(['partner_id'=>$invite->partner->id]);
            $user->syncRoles('dealer');
            $notification->delete();
            $invite->delete();
            DB::commit();
            return back();

        }catch(Exception $e){
            DB::rollBack();
            return back()->withErrors(['fail'=>__('Server Error')]);
        }


    }
}
