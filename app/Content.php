<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Storage;
use DB;
class Content extends Model
{

  protected $table = "content";

  protected $fillable = [
    'path', 'edition_date'
  ];

}
