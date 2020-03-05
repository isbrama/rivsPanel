<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Product extends Model
{
    protected $table = 'products';

    public function line_orders(){
      return $this->hasMany('App\line_order');
    }

    public function category(){
      return $this->belongsTo('App\Category', 'category_id');
    }
}
