<?php

namespace App\Http\Controllers;

use App\Models\Invoice;
use App\Models\PartnerInvoice;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class InvoiceController extends Controller
{
    //
    public function index()
    {
        # code...
        $invoices = Invoice::with('sim')->get();
        return view('admin.pages.statis',['statis'=>$invoices]);
    }

    public function showStatis()
    {
        # code...
        $partner = Auth::user()->partner;
        $invoices = $partner->invoices;
        // dd($invoices);
        return view('dealer.statis.index',['statis'=>$invoices]);
    }
}
