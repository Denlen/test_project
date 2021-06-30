<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\Company;
use App\Models\Employe;
use Illuminate\Http\Request;
use App\Http\Resources\Api\CompanyResource;
use App\Http\Resources\Api\EmployeResource;


class CompanyController extends Controller
{
    public function company()
    {
        $company = Company::all();
        return new CompanyResource($company);
    }

    public function employes($id)
    {
        $employes = Company::find($id)->employes;
        $company = Employe::find($employes->first()->id)->company;
        foreach ($employes as $emploe)
        {
            $emploe['company'] = $company->name;
        }
        return new CompanyResource($employes);

    }

}
