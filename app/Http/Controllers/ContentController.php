<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Content;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Validator;

use Carbon\Carbon;

class ContentController extends Controller
{

  public function __construct()
  {
    $this->middleware('auth');
  }

  public function index(Request $request)
  {

    $request->user()->authorizeRoles(['administrator']);

    $post = $request->post();

    $content = Content::paginate(10);

    return view('content.index', compact('content'));
  }


  public function search()
  {
    $explodeSpaces = explode(" ", $post['search']);
    $where = [];
    $i = 0;

    $dateRegex = "#^(0[1-9]|[12][0-9]|3[01])[// /.](0[1-9]|1[012])[// /.](19|20)\d\d$#";
      $date = [];
      $i = 0;
      $j = 0;
      foreach ($explodeSpaces as $key)
      {
        if(preg_match($dateRegex,$key))
        {
          $date[$i] = $key;
          unset($explodeSpaces[$j]);
          $i++;
        }
        $j++;
      }

      $whereBetween = [Carbon::createFromTimestamp(-1)->toDateTimeString(),Carbon::now()];

      if(!empty($date))
      {
        if(count($date) > 1)
        {
          $d1 = explode("/",$date[0]);
          $d2 = explode("/",$date[1]);
          $whereBetween = [$d1[2] . "-" . $d1[1] . "-" . $d1[0] . " 23:59:59", $d2[2] . "-" . $d2[1] . "-" . $d2[0] . " 23:59:59"];
        }else
        {
          $d1 = explode("/",$date[0]);
          array_push($where, ['contents.created_at', "like" , "%" . $d1[2] . "-" . $d1[1] . "-" . $d1[0] . "%"]);
        }
      }

      if(!empty($explodeSpaces)){
        array_push($where, ['contents.title','like','%' . implode(" ", $explodeSpaces) . '%']);
      }

      $contents = Content::join('content_file','content.id', '=', 'content_file.content_id')
      ->where($where)
      ->whereBetween('contents.created_at',$whereBetween)
      ->select('contents.id','contents.title')
      ->paginate(10);

      return view('content.list', compact('contents'));
    }

    public function create(Request $request)
    {

      if($request->isMethod('post')){

        $validator = Validator::make($request->all(), [
          'edition_date' => 'required',
          'pdf_file' => 'required|mimes:pdf'
        ]);

        if ($validator->fails())
        {
          return back()->withInput()
          ->withErrors($validator)
          ->withInput();
        }

        if($request->hasFile('pdf_file'))
        {

          //get filename with extension
          $filenamewithextension = $request->file('pdf_file')->getClientOriginalName();

          //get filename without extension
          $filename = pathinfo($filenamewithextension, PATHINFO_FILENAME);

          //get file extension
          $extension = $request->file('pdf_file')->getClientOriginalExtension();

          //filename to store
          $filenametostore = md5($filename . time()) . '_' . time() . '.' . $extension;


          $content = new Content();
          $content->filename = $filenametostore;
          $content->requestFile = $request->file('pdf_file');
          $s3 = $content->storage();

          $request->request->add(['path' => $s3]);

          $pdfToJPEG = new \Spatie\PdfToImage\Pdf($request->file('pdf_file'));
          $pdfToJPEG->saveImage(storage_path());

          $content = new Content();
          $content->filename = $filenametostore;
          $content->requestFile = $request->file('pdf_file');
          $s3 = $content->storage();


          if(Content::create($request->post()))
          {
            return back()->withInput();
          }

          //$url = Storage::disk('s3')->url('YOUR_FILENAME_HERE');
          //Store $filenametostore in the database
        }


        return back()->withInput()
        ->withErrors()
        ->withInput();
      }

      return view('content.create');
    }


    public function delete(){

    }

  }
