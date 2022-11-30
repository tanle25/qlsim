<?php

namespace App\Http\Controllers;

use App\Models\SimNetwork;
use Illuminate\Http\Request;

class SimNetworkController extends Controller
{
    //
    public function index()
    {
        # code...
        $networks = SimNetwork::all();
        return view('admin.pages.product.network',['networks'=>$networks]);
    }
    public function store(Request $request)
    {
        # code...
        $request->validate([
            'name'=>'required|unique:sim_networks,name',
            'price'=>'required|numeric',
            'lease_price'=>'required|numeric',
            'duration'=>'required|integer'
        ],[
            'required'=>__(':attribute required'),
            'unique'=>__(':attribute exists'),
            'numeric'=>__(':attribute invalid'),
            'integer'=>__(':attribute invalid')
        ],[
            'name'=>__('network name'),
            'price'=>__('price'),
            'lease_price'=>__('rent price'),
            'duration'=>__('duration')
        ]);

        SimNetwork::create($request->all());
        return back()->with(['success'=>__('Success')]);

    }
    public function edit($id)
    {
        # code...
        $network = SimNetwork::find($id);
        if($network){
            return response()->json($network,200);

        }else{
            return response()->json($network,404);

        }

    }
    public function update(Request $request)
    {
        # code...
        $request->validate([
            'name'=>'required',
            'price'=>'required|integer',
            'lease_price'=>'required|integer',
            'duration'=>'required|integer'
        ],[
            'required'=>__(':attribute required'),
            'integer'=>__(':attribute invalid')
        ],[
            'name'=>__('network name')
        ]);
        $network = SimNetwork::findOrFail($request->id);
        $network->update([
            'name'=>$request->name,
            'price'=>$request->price,
            'lease_price'=>$request->lease_price,
            'duration'=>$request->duration
        ]);
        return back();
    }
    public function delete($id)
    {
        # code...
        $network = SimNetwork::find($id);
        $network->delete();
        return back();

    }
}
