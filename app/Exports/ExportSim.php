<?php

namespace App\Exports;

use App\Models\SimCard;
use Maatwebsite\Excel\Concerns\FromCollection;
use Maatwebsite\Excel\Concerns\WithHeadings;
use Maatwebsite\Excel\Concerns\WithMapping;

class ExportSim implements FromCollection, WithHeadings, WithMapping
{
    /**
    * @return \Illuminate\Support\Collection
    */
    protected  $sims;

    public function __construct($sims)
    {
        $this->sims = $sims;
    }
    public function collection()
    {
        //
        return $this->sims;
    }

    public function map($sim) :array
    {
        # code...
        return[
            $sim->phone,
            $sim->iccid,
            $sim->created_at,
            $sim->network->name ?? ''
        ];
    }

    public function headings() :array
    {
        # code...
        return[
            'Số điện thoại','ICCID','Ngày tạo','Nhà mạng'
        ];
    }
}
