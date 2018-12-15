<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Storage;

class Content extends Model
{

  protected $table = "content";

  protected $fillable = [
    'path', 'edition_date'
  ];

  public $filename;
  public $requestFile;

  public function storage()
  {
    try{

      Storage::disk('s3')->put($this->filename, fopen($this->requestFile, 'r+'), 'public');

    }catch(S3 $e){
          return $e->getMessage();
    }

    return Storage::disk('s3')->url($this->filename);
  }


  public function storageDelete()
  {
    Storage::disk('s3')->delete('folder_path/file_name.jpg');
  }
  
}
