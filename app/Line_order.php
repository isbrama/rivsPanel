<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Line_order extends Model
{
    protected $table = 'line_orders';

    public function orders(){
      return $this->belongsTo('App\Order', 'orders_id');
    }

    public function products(){
      return $this->belongsTo('App\Product', 'products_id');
    }
}
