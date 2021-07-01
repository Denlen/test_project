<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Company;

class CompanyController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $queryCompanies = Company::query();

        if(!is_null(request()->input('name'))) {
            $queryCompanies->where('name', 'like', '%' . request()->input('name') . '%');
        }

        if(!is_null(request()->input('email'))) {
            $queryCompanies->where('email', 'like', '%' . request()->input('email') . '%');

        }

        if(!is_null(request()->input('phone'))) {
            $queryCompanies->where('phone', 'like', '%' . request()->input('phone') . '%');
        }

        if(!is_null(request()->input('website'))) {
            $queryCompanies->where('website', 'like', '%' . request()->input('website') . '%');
        }

        $companies = $queryCompanies->paginate(16);


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
    public function store(Request $request)
    {
        $request->validate([
            'name' => 'required',
            'email' => 'required',
            'phone' => 'required',
            'website' => 'required',
        ]);
        $input = $request->all();

        if($request->hasFile('logo')){
            $image = date('YmdHis') . "." .$request->file('logo')->getClientOriginalName();
            $request->logo->storeAs('companies', $image, 'public');
            $input['logo'] = $image;
        }

        Company::create($input);

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
                // $companies = Company::find(1)->companies;
        // echo $companies;
        return view('companies.show',compact('company'));
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
    public function update(Request $request, Company $company)
    {
        $request->validate([
            'name' => 'required',
            'email' => 'required',
            'phone' => 'required',
            'website' => 'required',
        ]);

        $input = $request->all();

        if($request->hasFile('logo')){
            $image = date('YmdHis') . "." .$request->file('logo')->getClientOriginalName();
            $request->logo->storeAs('companies', $image, 'public');
            $input['logo'] = $image;
        }

        $company->update($input);

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
