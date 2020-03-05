<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Http\Response;
use App\Product;
use App\Category;
use App\Car;

class bankController extends Controller
{
    public function __construct(){
      $this->middleware('auth');
    }//fin function _construct()

    public function car(Request $request){

      if ($request->session()->has('car')) {
          return view('bank.car');
      }

      else {
          return view('home');
      }

    }

    public function add(Request $request , $id=null){

        $product = Product::where('id',$id)->first();

        $oldcart = $request->session()->has('car') ? $request->session()->get('car') : null ;

        $car = new Car ($oldcart);

        $car->add($product , $product->id);

        $request->session()->put('car',$car );

        return redirect()->route('bank.car');

  }//fin function add

  public function deleteAll(Request $request){
    if ($request->session()->get('car')) {

        $request->session()->forget('car');
    }

    return redirect()->route('products.list');
  }//fin function deleteAll


  public function delete(Request $request , $id=null){

      $product = Product::where('id',$id)->first();

      $oldcart = $request->session()->has('car') ? $request->session()->get('car') : null ;

      $car = new Car ($oldcart);

      $car->delete($product , $product->id);

      $request->session()->put('car',$car );

      if ($request->session()->get('car')->units == 0) {

        return redirect()->route('bank.delete');

      }

      else {
          return redirect()->route('bank.car');
      }
      
}//fin function delete

public function deleteOne(Request $request , $id=null){

    $product = Product::where('id',$id)->first();

    $oldcart = $request->session()->has('car') ? $request->session()->get('car') : null ;

    $car = new Car ($oldcart);

    $car->deleteOne($product , $product->id);

    $request->session()->put('car',$car );

    if ($request->session()->get('car')->units == 0) {

      return redirect()->route('bank.delete');

    }

    else {
        return redirect()->route('bank.car');
    }

  }//fin function delete

}//fin class bankController
