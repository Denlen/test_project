<?php

namespace App\Exports;

use App\Models\Company;
use Maatwebsite\Excel\Concerns\FromCollection;

class CompanyEmployesExport implements FromCollection
{
    protected $id;
    public function __construct($id)
    {
        $this->id = $id;
    }
    /**
    * @return \Illuminate\Support\Collection
    */
    public function collection()
    {

        return Company::find($this->id)->employes;
    }
}
