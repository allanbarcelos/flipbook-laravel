<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class FilesController extends Controller
{

    public function __construct()
    {
      $this->middleware('auth');
    }

    public function index()
    {
        return view('files/upload');
    }

    public function store(Request $request)
    {
        if($request->hasFile('profile_image')) {

            //get filename with extension
            $filenamewithextension = $request->file('profile_image')->getClientOriginalName();

            //get filename without extension
            $filename = pathinfo($filenamewithextension, PATHINFO_FILENAME);

            //get file extension
            $extension = $request->file('profile_image')->getClientOriginalExtension();

            //filename to store
            $filenametostore = $filename.'_'.time().'.'.$extension;

            //Upload File to s3
            Storage::disk('s3')->put($filenametostore, fopen($request->file('profile_image'), 'r+'), 'public');

            //Store $filenametostore in the database
        }
    }
}
