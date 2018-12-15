<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Contract extends Model
{

  protected $table = 'contract_user';

  protected $fillable = [
      'number'
  ];

  public function user()
  {
      return $this->belongsTo('App\User');
  }
}
