<?php

namespace App\Exports;

use Carbon\Carbon;
use App\Models\PartnerInvoice;
use Illuminate\Support\Facades\Auth;
use Maatwebsite\Excel\Concerns\FromQuery;
use PhpOffice\PhpSpreadsheet\Shared\Date;
use Maatwebsite\Excel\Concerns\WithMapping;
use Maatwebsite\Excel\Concerns\WithHeadings;
use Maatwebsite\Excel\Concerns\FromCollection;
use PhpOffice\PhpSpreadsheet\Style\NumberFormat;
use Maatwebsite\Excel\Concerns\WithColumnFormatting;

class PartnerExportSingle implements  FromQuery, WithMapping, WithHeadings, WithColumnFormatting
{
    /**
    * @return \Illuminate\Support\Collection
    */

    public function query()
    {
        //
        return PartnerInvoice::where('partner_id',Auth::user()->partner_id)->whereDate('created_at', Carbon::today()->toDateString());
    }
    public function map($invoice): array
    {
        # code...
        return [
            __($invoice->model_name),
            $invoice->origin_price,
            $invoice->lease_price,
            Date::dateTimeToExcel($invoice->created_at),

        ];
    }
    public function headings(): array
    {
        return [__('type'), __('origin price'), __('rent price'), __('Created at')];
    }
    public function columnFormats(): array
    {
        return [
            'B' => NumberFormat::FORMAT_NUMBER,
            'C' => NumberFormat::FORMAT_NUMBER,
            'D' => NumberFormat::FORMAT_DATE_DDMMYYYY,
        ];
    }
}
