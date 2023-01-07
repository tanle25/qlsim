<?php

namespace App\Exports;

use App\Models\User;
use Maatwebsite\Excel\Concerns\FromCollection;
use Maatwebsite\Excel\Concerns\WithHeadings;
use Maatwebsite\Excel\Concerns\WithMapping;

class ExportSimOfPartner implements FromCollection, WithHeadings, WithMapping
{
    /**
    * @return \Illuminate\Support\Collection
    */

    public User $user;

    public function __construct($id)
    {
        $this->user = User::find($id);
    }
    public function collection()
    {
        //
        return $this->user->sims;
    }

    public function headings(): array
    {
        # code...
        return [
            'Số điện thoại','ICCID','Tên đại lý','Trạng thái','Ngày thuê','Ngày hết hạn'
        ];
    }

    public function map($sim): array
    {
        # code...
        return[
            $sim->sim->phone,
            $sim->sim->iccid,
            $sim->ownerable->name,
            __(config("constrain.sim_status.".$sim->status.".text")),
            $sim->created_at,
            $sim->expired
        ];
    }
}
