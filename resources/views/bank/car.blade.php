@extends('layouts.app')

@section('content')
<?php //dd(Session::get('car')); ?>
<div class="container">
    <div class="row justify-content-center">
      <h1 class="text-dark">Modifier inventaire</h1>
        <div class="col-md-12 mt-3">
          @include('includes.message')
          <table id="tableGestion" class="col-md-12">
            <tr>
              <th>Image</th>
              <th>Nom</th>
              <th>Prix</th>
              <th>Unités</th>
              <th>Action</th>
            </tr>
            <tbody id="tbodyGestion">
            <tr>
              @foreach(Session::get('car')->products as $product)
              <td><img src="{{url('/product_img/'.$product['product']->image)}}"></td>
              <td>{{$product['product']->name}}</td>
              <td>{{$product['price']}}$</td>
              <td>
                <a href="{{route('bank.del',['id'=>$product['product']->id])}}"><i class="fas fa-minus text-dark"></i></a>
                {{$product['qty']}}
                <a href="{{route('bank.add',['id'=>$product['product']->id])}}"><i class="fas fa-plus text-dark"></i></a>
              </td>
              <td>

                <a href="{{route('bank.delone',['id'=>$product['product']->id])}}"><i class="fa fa-2x fa-trash-alt text-dark"></i></a>
              </td>
            </tr>
              @endforeach
            <tr>
              <td></td><td></td>
              <td>{{Session::get('car')->totalPrice}}$</td>
              <td>{{Session::get('car')->units}}</td>
              <td>
                <!-- Button to Open the Modal -->
                <a href="#bankModal" data-toggle="modal" data-target="#bankModal"><i class="fas fa-2x fa-plus-square text-dark"></i></a>
                <a href="{{route('bank.delete')}}"><i class="fas fa-2x fa-trash-alt text-dark"></i></a>
              </td>
            </tr>
          </tbody>
          </table>
      </div>

        <!-- The Modal -->
        <div class="modal fade" id="bankModal" >
          <div class="modal-dialog modal-xs">
            <div class="modal-content">

              <!-- Modal Header -->
              <div class="modal-header">
                <h4 class="modal-title">Modifier Inventaire</h4>
                <button type="button" class="close" data-dismiss="modal">&times;</button>
              </div>

              <!-- Modal body -->
              <div class="modal-body">
                <form id="formModal" action="{{route('orders.add')}}" method="post">
                  @csrf
                  <div class="form-group">
                    <label for="company">Équipement obtenue par (Nom):</label>
                    <input type="text" class="form-control" name="company">
                  </div>

                <button type="submit" class="btn" name="submit"><i class="fas fa-2x fa-plus-square"></i></button>
                </form>
              </div>

              <!-- Modal footer -->
              <div class="modal-footer">
                <button type="button" class="btn" data-dismiss="modal"><i class="fas fa-2x fa-caret-square-left text-dark"></i></button>
              </div>

            </div>
          </div>
        </div><!-- The Modal -->

        </div>
    </div>
</div>
@endsection
