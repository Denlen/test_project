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
        // dd($company);
        return CompanyResource::collection($company);
    }

    // TODO CR: Use Model binding, resource misused, hardcode
    public function employes($id)
    {
        $employes = Company::findOrFail($id)->employes()->with('company')->paginate();

        return EmployeResource::collection($employes);

    }

}
