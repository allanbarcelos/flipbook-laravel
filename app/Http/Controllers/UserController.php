<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class UserController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }

    public function index()
    {
      return view('user/index');
    }

    public function edit()
    {
      return view('user/edit');
    }

    public function delete()
    {
      return view('user/delete');
    }

    public function create()
    {
      return view('user/create');
    }
}
