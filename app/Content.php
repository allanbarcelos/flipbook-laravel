<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Content extends Model
{
  protected $fillable = [
      'title', 'editionDate'
  ];

  public function files()
  {
      return $this->belongsToMany(File::class);
  }
}
