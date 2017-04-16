<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Order extends Model
{
    public function cartItems()
    {
        return $this->hasMany('App\CartItem');
    }

    public function shippingInfo()
    {
        return $this->hasOne('App\ShippingInfo');
    }

    public function user()
    {
        return $this->belongsTo('App\User');
    }

    public function payment()
    {
        return $this->hasOne('App\Payment');
    }
}
