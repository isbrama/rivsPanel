@extends('layouts.app')

@section('content')

@if(count($orders)>0)
<div class="container">
    <div class="row justify-content-center">
      <h1 class="text-dark">Mon historique</h1>
        <div class="col-md-12 mt-3">
          <?php //if($orders->num_rows > 0): ?>
          <table id="tableGestion"  class="col-md-12">
            <tr>
              <th>Id</th>
              <th>Cout</th>
              <th>Date</th>
              <th>Obtenue par</th>
              <th>Status</th>
              <th>Action</th>
            </tr>
            <tbody id="tbodyGestion">
            @foreach($orders as $order)
            <tr>
              <td>{{$order->id}}</td>
              <td>{{$order->cost}}$</td>
              <td>{{$order->date}}</td>
              <td>{{$order->company}}</td>
              <td>{{$order->status}}</td>
              <td>
                <a href="{{route('orders.detail',['id'=>$order->id])}}"><i class="fas fa-2x fa-eye text-dark"></i></a>
              </td>
            </tr>
          @endforeach
          </tbody>
          <tr>
            <td>
              <div class="input-wrapper">
                <i class="fas fa-search-plus"></i>
                <input id="filterGestion" type="text" placeholder="Commande...">
              </div>
            </td>
          </tr>
          </table>
        </div>
    </div>
</div>

@else
    <div class="alert alert-light alert-dismissible fade show text-center" role="alert">
      <strong>Inventaire: </strong> Aucun historique de modification.
      <button type="button" class="close" data-dismiss="alert" aria-label="Close">
        <span aria-hidden="true">&times;</span>
      </button>
    </div>
@endif

@endsection
