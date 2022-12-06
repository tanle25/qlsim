<?php

namespace App\Exports;

use Maatwebsite\Excel\Concerns\WithMapping;
use Maatwebsite\Excel\Concerns\WithHeadings;
use Maatwebsite\Excel\Concerns\FromCollection;

class ExportPartnerSim implements FromCollection, WithHeadings, WithMapping
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
            $sim->sim->phone,
            $sim->sim->iccid,
            $sim->created_at,
            $sim->sim->network->name ?? ''
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
