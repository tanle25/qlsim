<?php

namespace App\Http\Controllers;

use App\Exports\StatisExport;
use App\Exports\StatisExportToday;
use Carbon\Carbon;
use Illuminate\Http\Request;
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
        // dd($date->firstOfMonth()->toDateString());
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
}
