<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Content;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Validator;

use Carbon\Carbon;
use App\Events\ContentPdfFirstPageToJpegEvent;

use Event;
use App\Events\ContentCreated;

use Illuminate\Http\File;
use Illuminate\Support\Facades\Storage;

//use Spatie\PdfToImage\Pdf;

use App\Libraries\PdfToImage;

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

      if($request->isMethod('post'))
      {

        $validator = Validator::make($request->all(), [
          'edition_date' => 'required',
          'pdf_file' => 'required|mimes:pdf',
          'title' => 'required|max:60'
        ],[],[
          'edition_date' => 'Data da edição',
          'pdf_file' => 'Arquivo em PDF',
          'title' => 'Titulo'
        ]);

        if ($validator->fails())
        {
          return response()->json([
              'success' => false,
              'errors' => $validator->getMessageBag()->toArray(),
          ], 400);
        }

        if($request->hasFile('pdf_file'))
        {

          $content = Content::create($request->post());
          if($content)
          {

            $filenamewithextension = $request->file('pdf_file')->getClientOriginalName();
            $filename = pathinfo($filenamewithextension, PATHINFO_FILENAME);
            $pdf_file = md5($filename . time()) . '_' . time() . '.' . 'pdf';

            if($request->file('pdf_file')->storeAs( '.', $pdf_file, 'root' ))
            {

              Event::fire(new ContentCreated($content, $pdf_file));

              return response()->json([
                  'success' => true,
                  'message' => 'Upload eftuado com sucesso',
              ], 200);

            }
          }
        }

        return response()->json([
            'success' => false,
            'errors' => '<b>Servidor:</b> Arquivo não esta presente.',
        ], 400);
      }

      return view('content.create');
    }


    public function delete(){

    }

  }
