<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Cpf extends Model
{
    protected $table = 'cpf_user';

    public function user()
    {
        return $this->belongsTo('App\User');
    }
}
