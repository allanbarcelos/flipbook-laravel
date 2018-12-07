<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\User;

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
    * @return \Illuminate\Http\Response
    */
    public function index(Request $request)
    {
        $request->user()->authorizeRoles(['client', 'administrator']);
        return view('home');
    }


    public function listClients(Request $request)
    {
        $request->user()->authorizeRoles(['administrator']);
        $users = User::paginate(25);

        return view('list-clients', compact('users'));
    }
}
