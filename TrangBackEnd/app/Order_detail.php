<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Order_detail extends Model
{
    //
    protected $table='order_details';

    public function orders()
    {
        return $this->hasMany(Order::class,'order_detail_id');
    }
    public function products()
    {
        return $this->hasMany(Product::class,'order_detail_id');
    }
}
