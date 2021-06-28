<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Company;
use App\Models\Employe;

class HomeController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('auth');
    }

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Contracts\Support\Renderable
     */
    public function index()
    {
        // $comments = Employe::find(1)->company;
        return view('home');
    }

    public function adminView()
    {
        return view('admin-view');
    }

    public function userView()
    {
        dd('def user');
        return view('home');
    }
}
