<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Employe;
use App\Models\Company;
use App\Jobs\SendEmail;
use App\Models\User;

class EmployeController extends Controller
{
     /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        if(request()->input('q') === null)
        {
            $employes = Employe::paginate(16);
        }else{
            $employes = Employe::orWhere('first_name', 'LIKE', '%brady%')->paginate(16);
        }

        return View('employes.index', compact('employes'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $companies_name = Company::select('id','name')->get();
        return view('employes.create',compact('companies_name'));
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
            'first_name' => 'required',
            'last_name' => 'required',
            'company_id' => 'required',
            'email' => 'required',
            'phone' => 'required',
        ]);

        Employe::create($request->all());
        $this->EmailNotify($request);

        return redirect()->route('employes.index')->with('success','Employe add successfully.');
    }

    protected function EmailNotify($request)
    {
        $user_emails = User::select('email')->get();
        foreach($user_emails as $email){
        SendEmail::dispatch($email->email,$request->all())->delay(now()->addMinutes(1));
        }
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
        $companies_name = Company::select('id','name')->get();
        // echo $companies_name;
        return view('employes.edit',compact('employe','companies_name'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Employe $employe)
    {
        $request->validate([
            'first_name' => 'required',
            'last_name' => 'required',
            'company_id' => 'required',
            'email' => 'required',
            'phone' => 'required',
        ]);

        $employe->update($request->all());

        return redirect()->route('employes.index')->with('success','Employe updated successfully');
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
