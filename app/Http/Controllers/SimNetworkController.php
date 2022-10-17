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
            'name'=>'required|unique:sim_networks,name'
        ],[
            'required'=>__(':attribute required'),
            'unique'=>__(':attribute exists')
        ],[
            'name'=>__('network name')
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
            'name'=>'required'
        ],[
            'required'=>__(':attribute required')
        ],[
            'name'=>__('network name')
        ]);
        $network = SimNetwork::findOrFail($request->id);
        $network->update([
            'name'=>$request->name
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
