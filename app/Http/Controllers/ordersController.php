<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Order;
use App\Line_order;
use App\Product;
use App\User;

class ordersController extends Controller
{
  public function __construct(){
    $this->middleware('auth');
  }//fin function _construct()

  public function mylist(){
    $user = \Auth::user();

    $orders = \DB::table('orders')
                ->join('users', 'orders.users_id', '=', 'users.id')
                ->select('orders.*', 'users.name')
                ->where('users.id', $user->id)
                ->orderBy('orders.date', 'desc')
                ->get();

    return view('orders.mylist',[
      'orders' => $orders
    ]);
  }//fin function mylist

  public function gestion(){
    $user = \Auth::user();

    $orders = \DB::table('orders')
                ->join('users', 'orders.users_id', '=', 'users.id')
                ->select('orders.*', 'users.name')
                ->orderBy('orders.date', 'desc')
                ->get();

    return view('orders.gestion',[
      'orders' => $orders
    ]);
  }//fin function gestion

  public function add(Request $request){

      $user = \Auth::user();

      $car = $request->session()->get('car');

      $rules = [
        'company' => 'required|string|max:255'
      ];

      // validate formulary
      $validate = $this->validate($request, $rules);

      //check input data
      $company= $request->input('company');

      //find info from database

      $order = new Order();
      $order->users_id = $user->id;
      $order->company = $company;
      $order->cost = $car->totalPrice;
      $order->date = now();
      $order->save();

      if ($order) {
        foreach($car->products as $product){
          $line_order = new Line_order();
          $line_order->orders_id = $order->id;
          $line_order->products_id =$product['product']->id;
          $line_order->units = $product['qty'];
          $line_order->save();
        }
        $request->session()->forget('car');

        return redirect()->route('orders.mylist');
      }//fin if order

      else {
        return redirect()->route('bank.car')->with(['message' => 'Impossible de modifier votre inventaire.']);
      }
  }//fin function add

  public function detail($id){
    $user = \Auth::user();

    $orders = \DB::table('line_orders')
                ->join('orders', 'line_orders.orders_id', '=', 'orders.id')
                ->join('products', 'line_orders.products_id', '=', 'products.id')
                ->select('line_orders.*', 'orders.cost', 'products.name', 'products.image',\DB::raw('products.price*line_orders.units AS costUnit'))
                ->where('line_orders.orders_id',$id)
                ->get();

    return view('orders.detail',[
      'orders' => $orders
    ]);
  }//fin function detail

  public function delete($id){
    $order = Order::where('id', $id)->first();
    if ($order) {
      $line_orders = Line_order::where('orders_id', $id)->get();

      foreach ($line_orders as $line_order) {
          $line_order->delete();
          unset($line_order);
        }//fin foreach

        if (empty($line_order)) {
            $order->delete();
            unset($order);

          return redirect()->route('orders.gestion')
          ->with(['message' => 'Modification supprimé avec success.']);
        }

        else {
          return redirect()->route('orders.gestion')
          ->with(['message_error' => 'Erreur: impossible de suprimmer la commande.']);
        }

    }//fin if order
    else {
      return redirect()->route('orders.gestion')
      ->with(['message_error' => 'Aucune modification trouvé.']);
    }
  }//fin function delete

}//fin class ordersController
