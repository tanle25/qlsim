<?php

namespace App\Http\Controllers;

use App\Exports\ExportPartnerSim;
use Carbon\Carbon;
use App\Models\SimCard;
use App\Exports\ExportSim;
use App\Exports\ExportSimOfPartner;
use Illuminate\Http\Request;
use App\Exports\StatisExport;
use App\Exports\StatisExportToday;
use App\Models\Invoice as ModelsInvoice;
use Auth;
use Invoice;
use Maatwebsite\Excel\Facades\Excel;

class ExportController extends Controller
{
    //
    public function exportToday()
    {
        # code...
        $date = Carbon::today()->toDateString();

        return Excel::download(new StatisExportToday,"doanh-thu-{$date}.xlsx");
    }

    public function exportWeek()
    {
        # code...
        $date = Carbon::today();
        $start = $date->startOfWeek()->toDateString();
        $end = $date->endOfWeek()->toDateString();

        return (new StatisExport($start, $end))->download("doanh-thu-tuan-{$date->month}.xlsx");
    }
    public function exportMonth()
    {
        # code...
        $date = Carbon::today();
        // dd($date->firstOfMonth()->toDateString());
        $start = $date->firstOfMonth()->toDateString();
        $end = $date->lastOfMonth()->toDateString();

        return (new StatisExport($start, $end))->download("doanh-thu-thang-{$date->month}.xlsx");
    }

    public function exportCustom(Request $request)
    {
        # code...
        $ranger = explode(' - ',$request->daterange);
        $start = Carbon::createFromFormat('d/m/Y',$ranger[0])->toDateString();
        $end = Carbon::createFromFormat('d/m/Y',$ranger[1])->toDateString();
        return (new StatisExport($start, $end))->download("doanh-thu-tu-{$start}-den-{$end}.xlsx");

    }

    public function exportStatis()
    {
        # code...
        $date = Carbon::today()->toDateString();
        // dd(ModelsInvoice::all());
        $invoices = ModelsInvoice::all();
        return Excel::download(new StatisExport($invoices),"$date.xlsx");
    }

    public function exportAll()
    {
        # code...
        $sims = SimCard::all();
        return Excel::download(new ExportSim($sims),'danh-sach-sim.xlsx');
    }

    public function exportPartner()
    {
        # code...
        $sims = Auth::user()->sims;
        return Excel::download(new ExportPartnerSim($sims),'danh-sach-sim.xlsx');
    }

    public function exportPartNer2($id)
    {
        # code...

        return Excel::download(new ExportSimOfPartner($id),'danh-sach-sim.xlsx');
    }
}
