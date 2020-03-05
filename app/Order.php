<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Order extends Model
{
    protected $table = 'orders';

    public function users(){
      return $this->belongsTo('App\User', 'users_id');
    }

    public function line_orders(){
      return $this->hasMany('App\Line_order');
    }
}
