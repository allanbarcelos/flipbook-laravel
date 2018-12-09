<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\User;

class AdminController extends Controller
{
  public function __construct()
  {
      $this->middleware('auth');
  }

  public function index(Request $request)
  {
    $request->user()->authorizeRoles(['administrator']);
    return view('admin/index');
  }

}
