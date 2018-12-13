<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Content;

class ContentController extends Controller
{

  public function __construct()
  {
    $this->middleware('auth');
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
  public function list(Request $request)
  {

    $request->user()->authorizeRoles(['administrator']);

    $post = $request->post();

      $contents = Content::join('content_file','contents.id', '=', 'content_file.content_id')
      ->select('contents.id','contents.title')
      ->paginate(10);

      return view('content.list', compact('contents'));
    }
  }
