<?php

namespace App\Http\Controllers;

use App\Models\Pakage;
use App\Models\PartnerPackage;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class PakageController extends Controller
{
    //
    public function index()
    {
        # code...
        $pakages = Pakage::all();
        return view('admin.pages.pakage.index',['pakages'=>$pakages]);
    }

    public function userIndex()
    {
        # code...
        $packages = Pakage::all();
        $partnerpackages = PartnerPackage::all();
        return view('dealer.package.index',['packages'=>$packages,'partnerpackages'=>$partnerpackages]);
    }

    public function store(Request $request)
    {
        # code...
        $request->validate([
            'name'=>'required',
            'type'=>'required',
            'origin_price'=>'required',
            'rent_price'=>'required'
        ],[
            'required'=>__(':attribute required')
        ],[
            'name'=>__('pakage name'),
            'type'=>__('pakage type'),
            'origin_price'=>__('origin price'),
            'rent_price'=>__('rent price')
        ]);



        $pakageCollection = config('constrain.pakage');
        $request->request->add(['duration'=>$pakageCollection[$request->type]['value']]);


        Pakage::create($request->all());

        return back();

    }

    public function storePartnerPackage(Request $request)
    {
        # code...
        $request->validate([
            'package_id'=>'required|exists:pakages,id',
            'rent_price'=>'required'
        ],[
            'required'=>__(':attribute required'),
            'exists'=>__(':attribute not exists')
        ],[
            'package_id'=>__('pakage'),
            'rent_price'=>__('rent price')
        ]);

        PartnerPackage::updateOrCreate([
            'pakage_id'=>$request->package_id,
            'partner_id'=>Auth::user()->partner_id
        ],[
            'lease_price'=>$request->rent_price
        ]);
        return back();
    }

}
