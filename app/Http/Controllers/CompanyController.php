<?php

namespace App\Http\Controllers;

use App\Http\Requests\CompanyRequest;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Http\Request;
use App\Models\Company;
use App\Imports\CompanyEmployesImport;
use Maatwebsite\Excel\Facades\Excel;
use App\Exports\CompanyEmployesExport;


class CompanyController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        $companies = Company::filter($request->get('filter', []))->paginate(16);

        return View('companies.index', compact('companies'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('companies.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */

    public function imageSave($request)
    {
        if($request->hasFile('logo')){
            $image = date('YmdHis'). "." .$request->file('logo')->getClientOriginalName();
            $request->logo->storeAs('companies', $image, 'public');
            return $image;
        }
        return null;
    }

    public function store(CompanyRequest $request)
    {
        //TODO Action or Another logic
        // echo($this->imageSave($request)->all());
        $imageName = $this->imageSave($request);
        Company::create($request->validated() + ['logo' => $imageName]);

        return redirect()->route('companies.index')->with('success','Company add successfully.');
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show(Company $company)
    {
        return view('companies.show',compact('company'));
    }

    public function import(Request $request, $id)
    {
        $request->validate([
            'import' => 'required|file',
        ]);
        Excel::import(new CompanyEmployesImport, $request->file('import'));

        return redirect()->route('employes.index')->with('success', 'Import was successful');
    }

    public function export(Request $request, $id)
    {
        if(in_array($request->get('format'), ['csv', 'xlsx'])) {
            $company_name = Company::findOrFail($id)->name;

            return Excel::download(new CompanyEmployesExport($id), 'EmployesOf'.$company_name.'.'.$request->format.'');
        }

        abort(400);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit(Company $company)
    {
        return view('companies.edit',compact('company'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(CompanyRequest $request, Company $company)
    {
        $imageName = $this->imageSave($request);
        $company->update($request->validated() + ['logo' => $imageName]);

        return redirect()->route('companies.index')->with('success','company updated successfully');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy(Company $company)
    {
        $company->delete();

        return redirect()->route('companies.index')
                       ->with('success','Company deleted successfully');
    }
}
