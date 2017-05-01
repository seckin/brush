<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Design extends Model
{
    public function artist()
    {
        return $this->belongsTo('App\Artist');
    }

    public function cartItems()
    {
        return $this->hasMany('App\CartItem');
    }

    public function designSizes()
    {
        return $this->hasMany('App\DesignSize');
    }
}
