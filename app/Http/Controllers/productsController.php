<?php
namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Http\Response;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\File;
use App\Product;
use App\Category;

class productsController extends Controller
{
    public function __construct(){
      $this->middleware('auth');
    }//fin function _construct()

    public function products(){
      $products = Product::all();
      $category = Category::all();

      return view('products.list', [
        'products' =>$products,
        'category' => $category
    ]);
    }//fin function products()

    public function gestion(){
      $products = Product::all();
      $category = Category::all();
      return view('products.gestion', [
        'products' =>$products,
        'category' => $category
    ]);
    }//fin function gestion()

    public function add(Request $request){

      //check if user is authorised
        $user = \Auth::user();

        $rules = [
          'name' => 'required|string|max:255',
          'category_id' => 'required|string|max:255',
          'description' => 'required|string|max:255',
          'price' => 'required|string|max:255',
          'stock' => 'required|string|max:255',
          'size' => 'required|string|max:255',
          'image'  => 'required|image|mimes:jpeg,png,jpg,gif,svg'
        ];


        // validate formulary
  		  $validate = $this->validate($request, $rules);

        //check input data
        $name = $request->input('name');
        $category_id = $request->input('category_id');
        $description = $request->input('description');
        $price = $request->input('price');
        $stock= $request->input('stock');
        $size = $request->input('size');
        $image = $request->file('image');

        //find info from database
        $product = new Product();
        $product->name = $name;
        $product->category_id = $category_id;
        $product->description = $description;
        $product->price = $price;
        $product->stock = $stock;
        $product->size = $size;

        if ($image) {
          $image_path_name = time().$image->getClientOriginalName();
    			Storage::disk('images')->put($image_path_name, File::get($image));
    			$product->image = $image_path_name;
        }
        //update database
        $product->save();

        return redirect()->route('products.gestion')
                   ->with(['message' => 'Ajout du produit avec success']);

    }//fin function add

    public function modify(Request $request){

      //check if user is authorised
        $user = \Auth::user();

        $rules = [
          'id' => 'required|max:255',
          'name' => 'required|string|max:255',
          'category_id' => 'required|string|max:255',
          'description' => 'required|string|max:255',
          'price' => 'required|string|max:255',
          'stock' => 'required|string|max:255',
          'size' => 'required|string|max:255',
          'image'  => 'image|mimes:jpeg,png,jpg,gif,svg|max:2048'
        ];

        // validate formulary
  		  $validate = $this->validate($request, $rules);

        //check input data
        $id = $request->input('id');
        $name = $request->input('name');
        $category_id = $request->input('category_id');
        $description = $request->input('description');
        $price = $request->input('price');
        $stock= $request->input('stock');
        $size = $request->input('size');
        $image = $request->file('image');

        //find info from database
        $product = Product::find($id);
        $product->name = $name;
        $product->category_id = $category_id;
        $product->description = $description;
        $product->price = $price;
        $product->stock = $stock;
        $product->size = $size;

        if ($image) {
          $image_path_name = time().$image->getClientOriginalName();
          Storage::disk('images')->put($image_path_name, File::get($image));
          $product->image = $image_path_name;
        }

        //update database
        $product->update();

        return redirect()->route('products.gestion')
                   ->with(['message' => 'Mise à jour du produit avec success']);

    }//fin function modify

    public function delete($id){
        $user = \Auth::user();

        //find info from database
        $product = Product::find($id);

        try
        {
          //update database
          $product->delete();
        }
        catch(\Illuminate\Database\QueryException $e){

          return redirect()->route('products.gestion')
                           ->with(['message_error'=>'Erreur: un produit est associé avec un historique de modification']);
        }

        return redirect()->route('products.gestion')
                   ->with(['message' => 'Produit suprimé avec success']);
    }//fin function delete

    public function getImage($filename){
      $file = Storage::disk('images')->get($filename);
      return new Response($file , 200);
    }//fin function getImage

}//fin class productsController
