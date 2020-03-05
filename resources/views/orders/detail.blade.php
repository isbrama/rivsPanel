@extends('layouts.app')

@section('content')

<div class="container ">
  <div class="row justify-content-center">
    <h1 class="text-dark">Détail</h1>
    <div class="col-md-12 mt-3">
    <table id="tableGestion" class="col-md-12">
      <tr>
        <th>Image</th>
        <th>Produit</th>
        <th>Unités</th>
        <th>Prix</th>
      </tr>
      <tbody id="tbodyGestion">
      @foreach($orders as $order)
        <tr>
        <td><img src="{{url('/product_img/'.$order->image)}}"></td>
        <td>{{$order->name}}</td>
        <td>{{$order->units}}</td>
        <td>{{$order->costUnit}}$</td>
        </tr>
    @endforeach
    </tbody>
    </table>
    </div>
  </div>
</div>
@endsection
