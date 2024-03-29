<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Address extends Model
{
    protected $table = 'address_user';

    public function user()
    {
        return $this->belongsTo('App\User');
    }
}
