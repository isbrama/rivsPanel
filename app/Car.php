<?php
namespace App;
use Session;
class Car
{

  public $products = null;
  public $units = 0;
  public $totalPrice = 0;

  //constructor
  public function __construct($car)
  {
    if ($car) {
      $this->products = $car->products;
      $this->units = $car->units;
      $this->totalPrice = $car->totalPrice;
    }

  }//fin function __construct

public function add($product , $id){

  $storedItem = [
    "qty" => 0 ,
    "price" => $product->price ,
    "product" => $product
  ];
  if ($this->products) {
    if (array_key_exists($id, $this->products)) {
      $storedItem = $this->products[$id];
    }
  }
  $storedItem['qty']++;
  $storedItem['price'] = $product->price * $storedItem['qty'];
  $this->products[$id] = $storedItem;
  $this->units++;
  $this->totalPrice+=$product->price ;
}//fin function add

public function delete($product , $id){
  $storedItem = [
    "qty" => 0 ,
    "price" => $product->price ,
    "product" => $product
  ];
  if ($this->products) {
    if (array_key_exists($id, $this->products)) {
      $storedItem = $this->products[$id];
    }
  }
  $storedItem['qty']--;
  $storedItem['price'] = $product->price * $storedItem['qty'];

  if ($storedItem['qty'] == 0) {
    unset($this->products[$id]);
  }

  else {
    $this->products[$id] = $storedItem;
  }

  $this->units--;
  $this->totalPrice-=$product->price ;
}//fin function delete

public function deleteOne($product , $id){

  if ($this->products) {
    if (array_key_exists($id, $this->products)) {
      $qty = $this->products[$id]['qty'];
      $price = $this->products[$id]['price'];
      unset($this->products[$id]);
    }
  }
  $this->units -=  $qty;
  $this->totalPrice -= $price ;
}//fin function deleteOne

}//fin class Cart

 ?>
