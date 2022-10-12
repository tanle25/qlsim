<?php

namespace App\Imports;

use App\Models\User;
use App\Models\Simcard;
use Maatwebsite\Excel\Concerns\ToModel;
use Maatwebsite\Excel\Concerns\WithHeadingRow;

class ImportSimCard implements ToModel, WithHeadingRow
{
    /**
    * @param array $row
    *
    * @return \Illuminate\Database\Eloquent\Model|null
    */
    public function model(array $row)
    {
        return new SimCard([
            //
            'phone'=>$row['number'],
            'network'=>$row['network'],
            'iccid'=>$row['iccid'],
            'import_price'=>$row['entry price'],
            'lease_price'=>$row['rental price']

        ]);
    }

}
