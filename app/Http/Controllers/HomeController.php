<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\User;
use App\Content;
use Carbon\Carbon;
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
        $request->user()->authorizeRoles(['administrator','client']);


        if($request->isMethod('post'))
        {

        }
        $year = Carbon::now()->format('m');
        $month = Carbon::now()->format('Y');

        $month_editions = Content::whereYear('edition_date', '=', $year)
                              ->whereMonth('edition_date', '=', $month)
                              ->get();

        return view::make('home.index')
                    ->with('month_editions', $month_editions)
                    ->with('last_edition', $last_edition);
    }



}
