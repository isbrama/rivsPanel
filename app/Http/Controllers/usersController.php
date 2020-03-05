<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\User;

class usersController extends Controller
{
  public function __construct(){
    $this->middleware('auth');
  }//fin function _construct()

  public function gestion(){
    $users = User::all();

    return view('users.gestion',['users' => $users]);
  }//fin function gestion

  public function modify(Request $request){

    // Get user
    $user = User::where('id', $request->id)->first();

    $id = $user->id;

    $rules = [
      'name' => 'required|string|max:255',
      'email' => 'required|string|email|max:255|unique:users,email,'. $id,
      'rol' => 'required|string|max:8'
    ];

    // validate form
    $validate = $this->validate($request, $rules);

    // get data form
    $name = $request->input('name');
    $email = $request->input('email');
    $rol = $request->input('rol');

    // asign new values to object
    $user->name = $name;
    $user->email = $email;
    $user->rol = $rol;

    // execute changes to database
    $user->update();

    return redirect()->route('users.gestion')
             ->with(['message'=>'Usager modifié avec success']);
  }//fin function modify

  public function delete($id){
    $user = \Auth::user();

    if ($user->rol == 'admin' && $user->id != $id) {

      $user = User::where('id',$id)->first();

      try
      {
        $user->delete();
      }
      catch(\Illuminate\Database\QueryException $e){

        return redirect()->route('users.gestion')
                 ->with(['message_error'=>'Erreur: un historique de modification est associé avec cet usager']);
      }

      return redirect()->route('users.gestion')
               ->with(['message'=>'Usager supprimé avec success']);
    }

    else {
      return redirect()->route('users.gestion')
               ->with(['message_error'=>'Erreur: seulement un ADMINISTRATEUR peut suprimmer cet usager']);
    }

  }//fin function delete

}//fin function usersController
