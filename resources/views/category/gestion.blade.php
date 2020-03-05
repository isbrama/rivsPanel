@extends('layouts.app')

@section('content')

<div class="container">
    <div class="row justify-content-center">
      <h1 class="text-dark">Gestion catégorie</h1>
        <div class="col-md-12 mt-3">
            @include('includes.message')
          <table id="tableGestion" class="col-md-12">
            <tr>
              <th hidden>Id</th>
              <th>Nom</th>
              <th>Action</th>
            </tr>
            <tbody id="tbodyGestion">
            @foreach($category as $cat)
            <tr>
              <td hidden>{{$cat->id }}</td>
              <td>{{$cat->name}}</td>
              <td>
                <a href="#categoryModal" id="$cat->id" class="categoryModal" data-toggle="modal" data-target="#categoryModal" ><i class="fas fa-2x fa-edit text-dark"></i></a>
                <a href="{{route('category.delete' , ['id' => $cat->id ])}}"><i class="fas fa-2x fa-trash-alt text-dark"></i></a>
              </td>
            </tr>
            @endforeach
            <tr>
              <!-- Button to Open the Modal -->
              <td><a href="#categoryModal" class="addCategory" data-toggle="modal" data-target="#categoryModal"><i class="fas fa-2x fa-plus-square text-dark"></i></a></td>
            </tr>
          </tbody>
          </table>
        </div><!--fin col-md-12 mt-3-->
        <!-- The Modal -->
        <div class="modal fade" id="categoryModal" >
          <div class="modal-dialog modal-xs">
            <div class="modal-content">

              <!-- Modal Header -->
              <div class="modal-header">
                <h4 class="modal-title">Ajouter catégorie</h4>
                <button type="button" class="close" data-dismiss="modal">&times;</button>
              </div>

              <!-- Modal body -->
              <div class="modal-body">
                <form id="formModal" action="{{route('category.add')}}" method="post">
                  @csrf
                  <input type="text" name="id" id="id" hidden>
                  <div class="form-group">
                    <label for="name">Nom:</label>
                    <input type="text" class="form-control" name="name" id="name" required>
                  </div>

                <button type="submit" class="btn" id="add" name="submit"><i class="fa fa-2x fa-plus-square text-dark"></i></button>
                </form>
              </div>

              <!-- Modal footer -->
              <div class="modal-footer">
                <button type="button" class="btn" data-dismiss="modal"><i class="fas fa-2x fa-caret-square-left text-dark"></i></button>
              </div>

            </div>
          </div>
        </div><!-- The Modal -->
    </div><!--fin row justify-content-center -->
</div>
@endsection
