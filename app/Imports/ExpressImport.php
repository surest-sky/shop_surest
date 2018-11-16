<?php

namespace App\Imports;

use App\Models\Express;
use Maatwebsite\Excel\Concerns\ToModel;

class ExpressImport implements ToModel
{
    /**
    * @param array $row
    *
    * @return \Illuminate\Database\Eloquent\Model|null
    */
    public function model(array $row)
    {
        return new Express([
            'serial' => $row[3],
            'name' => $row[2],
        ]);
    }
}
