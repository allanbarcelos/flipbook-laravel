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

        $monthEditions = Content::whereNotNull('first_page')->whereMonth('edition_date', Carbon::now()->month)->get();



        $lastEdition = Content::whereNotNull('first_page')->orderBy('edition_date', 'desc')->first();

        $edition_date = explode("-", $lastEdition->edition_date->format('Y-m-d') );
        $edition_date = [
            "year" => $edition_date[0],
            "month" => $edition_date[1],
            "day" => $edition_date[2]
        ];

        return view( "home.index", [
            'lastEdition' => $lastEdition,
            'edition_date' => $edition_date,
            'monthEditions' => $monthEditions
        ]);
    }



}
