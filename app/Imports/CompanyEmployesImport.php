<?php

namespace App\Imports;

use App\Models\Employe;
use Maatwebsite\Excel\Concerns\ToModel;

class CompanyEmployesImport implements ToModel
{
    /**
    * @param array $row
    *
    * @return \Illuminate\Database\Eloquent\Model|null
    */
    public function model(array $row)
    {
        return new Employe([
            'first_name' => $row[1],
            'last_name' => $row[2],
            'company_id' => $row[3],
            'email' => $row[4],
            'phone' => $row[5],
        ]);
    }
}
