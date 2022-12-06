<?php

namespace App\Exports;

use App\Models\Invoice;
use Maatwebsite\Excel\Concerns\FromQuery;
use Maatwebsite\Excel\Concerns\Exportable;
use Maatwebsite\Excel\Concerns\FromCollection;
use Maatwebsite\Excel\Concerns\WithMapping;
use Maatwebsite\Excel\Concerns\WithHeadings;
use PhpOffice\PhpSpreadsheet\Style\NumberFormat;
use Maatwebsite\Excel\Concerns\WithColumnFormatting;
use PhpOffice\PhpSpreadsheet\Shared\Date;

class StatisExport implements FromCollection, WithMapping, WithHeadings, WithColumnFormatting
{
    /**
    * @return \Illuminate\Support\Collection
    */
    use Exportable;

    protected $invoices;

    public function __construct($invoices)
    {
        $this->invoices = $invoices;
    }
    public function collection()
    {
        return Invoice::all();
    }

    public function map($invoice): array
    {
        # code...
        return [
            $invoice->invoiceable->name,
            $invoice->type,
            $invoice->sim->phone,
            $invoice->sim->network->price,
            $invoice->price,
            Date::dateTimeToExcel($invoice->created_at),

        ];
    }
    public function headings(): array
    {
        return [
            'Khách hàng',
            'Loại',
            'Số điện thoại',
            'Giá nhập',
            'Giá cho thuê',
            'Ngày tạo'
        ];
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
