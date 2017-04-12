<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Artist extends Model
{
    public function designs()
    {
        return $this->hasMany('App\Design');
    }
}
