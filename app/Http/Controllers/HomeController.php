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
  public function index(Request $request, $year = null, $month = null, $day = null)
  {

    $request->user()->authorizeRoles(['administrator','client']);

    $monthEditions = Content::whereNotNull('first_page')->whereMonth('edition_date', Carbon::now()->month)->get();

    if($year !== null && $month !== null && $day !== null)
    $lastEdition = Content::whereDate('edition_date','=', date($year . "-" . $month . "-" . $day))->whereNotNull('first_page')->first();
    else
    $lastEdition = Content::whereNotNull('first_page')->orderBy('edition_date', 'desc')->first();

    if($lastEdition)
    {

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

    return view("home.index");
  }



}
