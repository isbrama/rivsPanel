<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Category;

class categoryController extends Controller
{
  public function __construct(){
    $this->middleware('auth');
  }//fin function _construct()

  public function gestion(){
    $category = Category::all();
    return view('category.gestion', ['category' =>$category]);
  }//fin function gestion()

  public function add(Request $request){

    //check if user is authorised
      $user = \Auth::user();

      $rules = [
        'name' => 'required|string|max:255'
      ];

      $messages= [
        'required' => 'Le champ nom  est requis',
        'max' => 'Le champ nom est trop long',
        'string' => 'Le champs nom doit etre composer de characters'
      ];

      // validate formulary
		  $validate = $this->validate($request, $rules ,$messages);

      //check input data
      $name = $request->input('name');

      //find info from database
      $category = new Category();
      $category->name = $name;

      //update database
      $category->save();

      return redirect()->route('category.gestion')
                 ->with(['message' => 'Categorie ajoutee avec success']);
  }//fin function add

  public function modify(Request $request){
    //check if user is authorised
      $user = \Auth::user();

      $rules = [
        'id' => 'required|max:255',
        'name' => 'required|string|max:255'
      ];

      $messages= [
        'required' => 'Le champ nom est requis',
        'max' => 'Le champ nom est trop long',
        'string' => 'Le champs nom doit etre composer de characters'
      ];

      // validate formulary
		  $validate = $this->validate($request, $rules ,$messages);

      //check input data
      $id = $request->input('id');
      $name = $request->input('name');

      //find info from database
      $category = Category::find($id);
      $category->name = $name;

      try {
        //update database
        $category->update();

      }
      catch(\Illuminate\Database\QueryException $e){

        return redirect()->route('category.gestion')
                   ->with(['message' => 'Erreur: vérifier les données entrées dans le formulaire']);
      }

      return redirect()->route('category.gestion')
                 ->with(['message' => 'Mise à jour de la catégorie avec success']);

  }//fin function modify

  public function delete($id){
      $user = \Auth::user(); //?

      //find info from database
      $category = Category::find($id);

      try {
        //update database
        $category->delete();
      }
      catch(\Illuminate\Database\QueryException $e){

        return redirect()->route('category.gestion')
                 ->with(['message_error'=>'Erreur: Un produit est associé avec cette catégorie']);
      }

      return redirect()->route('category.gestion')
                 ->with(['message' => 'Catégorie supprimé avec success']);
  }//fin function delete

}//fin class categoryController
