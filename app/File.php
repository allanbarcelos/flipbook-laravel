<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class File extends Model
{
    protected $table = 'files';

    protected $fillable = [
        'path', 'type'
    ];

    public function content()
    {
        return $this->belongsTo('App\Content');
    }
}
