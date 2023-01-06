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
            $sim->old_iccid ?? '',
            $sim->created_at,
            $sim->network->name ?? '',
            $sim->partner->ownerable->name ?? '',
            $sim->partner->type ?? '',
            __(config("constrain.sim_status.$sim->status.text")),
            $sim->partner->created_at ?? '',
            $sim->partner->expired ?? ''

        ];
    }

    public function headings() :array
    {
        # code...
        return[
            'Số điện thoại','ICCID','ICCID cũ','Ngày tạo','Nhà mạng','Khách hàng','Loại khách hàng','Trạng thái','Ngày thuê', 'Ngày hết hạn'
        ];
    }
}
