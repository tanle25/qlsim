<?php

namespace App\Imports;

use App\Models\Simcard;
use App\Models\User;
use Maatwebsite\Excel\Concerns\ToModel;
use Maatwebsite\Excel\Concerns\WithStartRow;

class ImportSimCard implements ToModel, WithStartRow
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
            'phone'=>$row[0],
            'network'=>$row[1],
            'iccid'=>$row[2]

        ]);
    }
    public function startRow(): int
    {
        return 2;
    }

}
