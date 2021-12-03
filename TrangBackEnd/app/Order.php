<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Order extends Model
{
    //
    protected $table='orders';

    public function customer() {
        return $this->belongsTo(Customer::class,'customer_id');
    }

    public function shipping()
    {
        return $this->belongsTo(Shipping::class,'shipping_id');
    }
}
