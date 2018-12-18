<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Storage;
use DB;
class Content extends Model
{

  protected $table = "content";

  protected $fillable = [
    'title', 'full_file', 'first_page', 'thumbnail', 'edition_date'
  ];

  protected $dates = ['edition_date'];
}
