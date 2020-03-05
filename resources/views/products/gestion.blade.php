@extends('layouts.app')

@section('content')

@if(count($category)>0)

<div class="container">
    <div class="row justify-content-center">
      <h1 class="text-dark">Gestion produits</h1>
        <div class="col-md-12 mt-3">
          @include('includes.message')
          <table id="tableGestion" class="col-md-12">
            <tr>
              <th hidden>Id</th>
              <th>Produit</th>
              <th>Catégorie</th>
              <th>Description</th>
              <th>Prix</th>
              <th>Stock</th>
              <th>Taille</th>
              <th>Image</th>
              <th>Action</th>
            </tr>
            <tbody id="tbodyGestion">
            @foreach($products as $product)
            <tr>
              <td hidden>{{$product->id}}</td>
              <td>{{$product->name}}</td>
              <td>{{$product->category->name}}</td>
              <td>{{$product->description}}</td>
              <td>{{$product->price}}</td>
              <td>{{$product->stock}}</td>
              <td>{{$product->size}}</td>

              <td><img src="{{url('/product_img/'.$product->image)}}"></td>
              <td hidden>{{$product->category_id}}</td>
              <td hidden>{{$product->image}}</td>
              <td>
                <a href="#productsModal" id="" class="productsModal" data-toggle="modal" data-target="#productsModal"><i class="fas fa-2x fa-edit text-dark"></i></a>
                <a href="{{route('products.delete',['id'=>$product->id])}}"><i class="fas fa-2x fa-trash-alt text-dark"></i></a>
              </td>
            </tr>
            @endforeach
              </tbody>
              <tr>
                <!-- Button to Open the Modal -->
                <td><a href="#productsModal" class="addProduct" data-toggle="modal" data-target="#productsModal"><i class="fas fa-2x fa-plus-square text-dark"></i></a></td>
                <td>
                  <div class="input-wrapper">
                    <i class="fas fa-search-plus"></i>
                    <input id="filterGestion" type="text" placeholder="Produit...">
                  </div>
                </td>
              </tr>
          </table>
        </div><!--fin col-md-12 mt-3 -->
        <!-- The Modal -->
        <div class="modal fade" id="productsModal">
          <div class="modal-dialog modal-xs">
            <div class="modal-content">

              <!-- Modal Header -->
              <div class="modal-header">
                <h4 class="modal-title">Ajouter produit</h4>
                <button type="button" class="close" data-dismiss="modal">&times;</button>
              </div>

              <!-- Modal body -->
              <div class="modal-body">
                <form id="formModal" action="{{route('products.add')}}" method="post" enctype="multipart/form-data">
                    @csrf
                  <input type="text" name="id" id="id" hidden>
                  <div class="form-group">
                    <label for="name">Nom:</label>
                    <input type="text" class="form-control" name="name" id="name" required>
                  </div>
                  <div class="form-group">
                      <label for="category">Catégorie:</label>
                      <select class="form-control" name="category_id" id="category_id" required>
                        @foreach($category as $cat)
                          <option value="{{$cat->id}}">{{$cat->name}}</option>
                        @endforeach
                      </select>
                  </div>
                  <div class="form-group">
                    <label for="name">Description:</label>
                    <input type="text" class="form-control" name="description" id="description">
                  </div>
                  <div class="form-group">
                    <label for="name">Prix:</label>
                    <input type="number" class="form-control" name="price" id="price">
                  </div>
                  <div class="form-group">
                    <label for="name">Unités:</label>
                    <input type="number" class="form-control" name="stock" id="stock">
                  </div>
                  <div class="form-group">
                      <label for="category">Taille:</label>
                      <select class="form-control" name="size" id="size">
                        <option value="XSY">XSY</option>
                        <option value="SY">SY</option>
                        <option value="MY">MY</option>
                        <option value="LY">LY</option>
                        <option value="XLY">XLY</option>
                        <option value="XS">XS</option>
                        <option value="S">S</option>
                        <option value="M">M</option>
                        <option value="L">L</option>
                        <option value="XL">XL</option>
                        <option value="none">Aucune</option>
                      </select>
                  </div>
                  <div class="custom-file mb-4 mt-3">
                    <input type="file" class="custom-file-input" id="image" name="image">
                    <label class="custom-file-label" for="customFile">Choisir image:</label>
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

@else
    <div class="alert alert-light alert-dismissible fade show text-center" role="alert">
      <strong>Produit: </strong>Créer une Catégorie dans la section Gestion catégorie pour ajouter un produit.
      <button type="button" class="close" data-dismiss="alert" aria-label="Close">
        <span aria-hidden="true">&times;</span>
      </button>
    </div>
@endif

@endsection
