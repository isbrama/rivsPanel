@extends('layouts.app')

@section('content')

<div class="container">
    <div class="row justify-content-center">
      <h1 class="text-dark">Gestion usagers</h1>
        <div class="col-md-12 mt-3">

          @include('includes.message')

          <table id="tableGestion" class="col-md-12">
            <tr>
              <th hidden>Id</th>
              <th>Nom</th>
              <th>Usager</th>
              <th>Rôle</th>
              <th>Action</th>
            </tr>
            <tbody id="tbodyGestion">
            @foreach($users as $user)
            <tr>
              <td hidden>{{$user->id}}</td>
              <td>{{$user->name}}</td>
              <td>{{$user->email}}</td>
              <td>{{$user->rol}}</td>
              <td>
                <a href="#usersModal" id="identityId" class="usersModal" data-toggle="modal" data-target="#usersModal" ><i class="fas fa-2x fa-edit text-dark"></i></a>
                <a href="{{route('users.delete',['id'=>$user->id])}}"><i class="fas fa-2x fa-trash-alt text-dark"></i></a>
              </td>
            </tr>
            @endforeach
            <tr>
              <!-- Button to Open the Modal -->
              <td>

                <!--<a href="{{ route('register') }}"><i class="fas fa-plus-square btn btn-success"></i></a>-->
                <a href="#usersModal" class="addUser" data-toggle="modal" data-target="#usersModal"><i class="fas fa-2x fa-plus-square text-dark"></i></a>
              </td>
            </tr>
          </tbody>
          </table>
        </div> <!--fin col-md-12 mt-3 -->
    </div> <!--fin row justify-content-center -->

    <!-- The Modal -->
    <div class="modal fade" id="usersModal">
      <div class="modal-dialog modal-xs">
        <div class="modal-content">

          <!-- Modal Header -->
          <div class="modal-header">
            <h4 class="modal-title">Ajouter usager</h4>
            <button type="button" class="close" data-dismiss="modal">&times;</button>
          </div>

          <!-- Modal body -->
          <div class="modal-body">
            <form id="formModal" action="{{ route('register')}}" method="post">
              @csrf

              <input type="text" name="id" id="id" hidden>

              <div class="form-group">
                <label for="name" class="col-form-label">Nom:</label>
                <input id="name" type="text" class="form-control" name="name" required>
              </div>
            <div class="form-group">
              <label for="email" class="col-form-label">Courriel:</label>
              <input id="email" type="email" class="form-control" name="email" required >
            </div>
            <div class="form-group psw">
              <label for="password" class="col-form-label">Password:</label>
              <input id="password" type="password" class="form-control" name="password" >
            </div>
            <div class="form-group psw">
              <label for="password-confirm" class="col-form-label">Confirmer mot de passe:</label>
              <input id="password-confirm" type="password" class="form-control" name="password_confirmation" >
            </div>
            <div class="form-group">
             <label for="rol" class="col-form-label">Rôle:</label>
             <select class="form-control" name="rol" id="rol">
               <option>admin</option>
               <option>user</option>
             </select>
           </div>

            <button type="submit" class="btn" id="submit" name="submit"><i class="fas fa-2x fa-user-plus text-dark"></i></button>

            </form>
          </div>

          <!-- Modal footer -->
          <div class="modal-footer">
            <button type="button" class="btn" data-dismiss="modal"><i class="fas fa-2x fa-caret-square-left text-dark"></i></button>
          </div>

        </div>
      </div>

    </div><!-- The Modal -->

</div><!--fin container -->
@endsection
