<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\Company;
use App\Models\Employe;
use Illuminate\Http\Request;


class CompanyController extends Controller
{
    public function company()
    {
        return Company::all();
    }

    public function employes($id)
    {
        $emplyes = Company::find($id)->employes;
        $company = Employe::find($emplyes->first()->id)->company;
        foreach ($emplyes as $emploe)
        {
            $emploe['company'] = $company->name;
        }
        return $emplyes;

    }

}
