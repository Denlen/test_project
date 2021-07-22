<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Employe;
use App\Models\Company;
use App\Models\User;
use App\Http\Requests\EmployeRequest;
use App\Event\EmployeCreated;

use function PHPUnit\Framework\isNull;

class EmployeController extends Controller
{
     /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        $employes = Employe::filter($request->get('filter', []))->paginate(16);
        $companiesName = Company::select('id','name')->get();

        return View('employes.index', compact('employes','companiesName'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $companiesName = Company::select('id', 'name')->get();
        return view('employes.create', compact('companiesName'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(EmployeRequest $request)
    {
        $newEmploye = Employe::create($request->validated());
        event(new EmployeCreated($newEmploye));

        return redirect()->route('employes.index')->with('success','Employe add successfully.');
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show(Employe $employe)
    {
        return view('employes.show',compact('employe'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit(Employe $employe)
    {
        $companiesName = Company::select('id','name')->get();

        return view('employes.edit',compact('employe','companiesName'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(EmployeRequest $request, Employe $employe)
    {
        $employe->update($request->validated());

        return redirect()->route('employes.index')->with('success', 'Employe updated successfully');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy(Employe $employe)
    {
        $employe->delete();

       return redirect()->route('employes.index')
                       ->with('success','Employe deleted successfully');
    }
}
