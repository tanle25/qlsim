<?php

namespace App\Imports;

use App\Models\SimCard;
use Maatwebsite\Excel\Concerns\ToModel;
use Maatwebsite\Excel\Concerns\WithHeadingRow;

class ImportSim implements ToModel, WithHeadingRow
{
    /**
    * @param array $row
    *
    * @return \Illuminate\Database\Eloquent\Model|null
    */
    public function model(array $row)
    {
        // dd($row);
        return new SimCard([
            //
            'phone'=>$row['number'],
            'network'=>$row['network'],
            'iccid'=>$row['iccid'],
            'import_price'=>$row['entry_price'],
            'lease_price'=>$row['rental_price']
        ]);
    }
}
