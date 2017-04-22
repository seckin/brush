<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class CartItem extends Model
{
    use SoftDeletes;

    /**
     * The attributes that should be mutated to dates.
     *
     * @var array
     */
    protected $dates = ['deleted_at'];

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
