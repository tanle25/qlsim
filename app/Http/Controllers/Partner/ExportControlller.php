<?php

namespace App\Http\Controllers\Partner;

use App\Exports\PartnerExport;
use App\Exports\PartnerExportSingle;
use Carbon\Carbon;
use Illuminate\Http\Request;
use App\Models\PartnerInvoice;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;
use Maatwebsite\Excel\Facades\Excel;

class ExportControlller extends Controller
{
    //
    public function index()
    {
        # code...
        $invoices = PartnerInvoice::where('partner_id', Auth::user()->partner_id)->get();
        // dd($invoices);
        return view('dealer.statis.index',['statis'=>$invoices]);
    }

    public function exportToday()
    {
        # code...
        $date = Carbon::today()->toDateString();

        return Excel::download(new PartnerExportSingle,"doanh-thu-{$date}.xlsx");
    }
    public function exportInWeek()
    {
        # code...
        $date = Carbon::today();

        $start = $date->startOfWeek()->toDateString();
        $end = $date->endOfWeek()->toDateString();
        return Excel::download(new PartnerExport($start, $end),"doanh-thu-tuan-{$date->month}.xlsx");

    }
    public function exportInMonth()
    {
        # code...
        $date = Carbon::today();

        $start = $date->firstOfMonth()->toDateString();
        $end = $date->lastOfMonth()->toDateString();
        return Excel::download(new PartnerExport($start, $end),"doanh-thu-thang.xlsx");
    }
    public function customExport(Request $request)
    {
        # code...
        $ranger = explode(' - ',$request->daterange);
        $start = Carbon::createFromFormat('d/m/Y',$ranger[0])->toDateString();
        $end = Carbon::createFromFormat('d/m/Y',$ranger[1])->toDateString();
        return Excel::download(new PartnerExport($start, $end),"doanh-thu-tu-{$start}-den-{$end}.xlsx");

    }
}
