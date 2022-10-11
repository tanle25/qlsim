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
}
