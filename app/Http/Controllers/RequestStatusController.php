<?php

namespace App\Http\Controllers;

use App\Models\RequestStatus;
use App\Models\SimCard;
use App\Models\SimOwner;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;

class RequestStatusController extends Controller
{
    //
    public function index()
    {
        # code...

    }
    public function sendRequest(Request $request)
    {
        # code...
        // dd($request);
        $status = config('constrain.sim_status');
        $request->validate([
            'sim_id'=>'required|exists:sim_owners,id'
        ],[
            'required'=>__(':attribute required'),
            'exists'=>__(':attribute not exists'),
        ],[
            'sim_id'=>__('sim')
        ]);
        if(!isset($status[$request->status])){
            return back()->withErrors(['fail'=>__(':attribute not exists',['attribute'=>__('status')])]);
        }

        $sim = SimOwner::find($request->sim_id);

        // dd($sim);

        RequestStatus::create([
            'sim_card_id'=>$sim->sim_card_id,
            'partner_id'=>Auth::user()->partner_id,
            'request'=>$request->status,
        ]);
        return back()->with(['success'=>__('Success')]);
    }

    public function changeStatus($id)
    {
        # code...
        $request = RequestStatus::findOrFail($id);
        DB::beginTransaction();
        try {
            //code...
            $request->sim()->update([
                'request'=> $request->status,
                'status'=>1
            ]);
            // $request->delete();
            DB::commit();
        } catch (\Throwable $th) {
            //throw $th;
            DB::rollBack();
        }


        return back();
    }

    public function delete($id)
    {
        # code...
        $request = RequestStatus::findOrFail($id);

        // $request->delete();
        return back();
    }
}
