<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class CartItem extends Model
{
    public function design()
    {
        return $this->belongsTo('App\Design');
    }

    public function order()
    {
        return $this->belongsTo('App\Order');
    }

	public function productSpec()
    {
        return $this->hasOne('App\ProductSpec');
    }
}
