<?php

namespace App\Imports;

use App\Models\Simcard as Sim;
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
        return new Sim([
            //
            'phone'=>$row['number'],
            'network'=>$row['network'],
            'iccid'=>$row['iccid'],
            'import_price'=>$row['entry price'],
            'lease_price'=>$row['rental price']

        ]);
    }

}
