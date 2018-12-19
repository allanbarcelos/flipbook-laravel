<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Content;

class ReaderController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }

    public function index(Request $request, $year, $month, $day)
    {
        $request->user()->authorizeRoles(['administrator','client']);

        $edition = Content::where('edition_date', '=', date($year."-".$month."=".$day))->first();


        return view('reader/index', ['edition' => $edition]);
    }
}
