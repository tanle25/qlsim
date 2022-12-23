<?php

namespace App\Http\Controllers;

use App\Models\Customer;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class CustomerController extends Controller
{
    //
    public function index(Request $request)
    {
        # code...
        $custommers = Customer::all();
        return view('admin.customer.index',['customers'=>$custommers]);
    }
}
