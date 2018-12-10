<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use App\File;

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
        $request->validate([
            'title' => 'required',
            'description' => 'required',
            'pdf_file' => 'required|mimes:application/pdf'
        ]);

        if ($validator->fails()) {
            return redirect('files/upload')
                        ->withErrors($validator)
                        ->withInput();
        }

        if($request->hasFile('pdf_file')) {

            //get filename with extension
            $filenamewithextension = $request->file('pdf_file')->getClientOriginalName();

            //get filename without extension
            $filename = pathinfo($filenamewithextension, PATHINFO_FILENAME);

            //get file extension
            $extension = $request->file('pdf_file')->getClientOriginalExtension();

            //filename to store
            $filenametostore = $filename.'_'.time().'.'.$extension;

            //Upload File to s3

            if(Storage::disk('s3')->put($filenametostore, fopen($request->file('pdf_file'), 'r+'), 'public'))
            {
                File::create([
                    'path' => Storage::disk('s3')->url($filenametostore),
                    'title' => '',
                    'description' => ''
                ]);

                return view('files/upload');
            }
            //$url = Storage::disk('s3')->url('YOUR_FILENAME_HERE');

            //Store $filenametostore in the database
        }
    }
}
