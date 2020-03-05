@extends('layouts.app')

@section('content')

@if(count($category)>0)

  <div class="container">
    <div class="row justify-content-center">
        <div class="col-md-12 ">
          <ul class="nav nav-pills mb-3 justify-content-center text-center" id="pills-tab" role="tablist">
              <?php $counter = 0?>
              <?php $catArray = array(); ?>
                @foreach($category as $cat)
                  <?php $catArray [] = $cat->id; ?>
                    @if($counter==0)
                      <?php $pane = 'active'; ?>
                    @else
                      <?php $pane = ''; ?>
                    @endif
                    <li class="nav-item">
                      <a class="nav-link {{$pane}} btn-sm btn-light mr-2"  data-toggle="pill" href="#pills-<?=$catArray [$counter]?>" role="tab" aria-controls="pills-<?=$catArray [$counter]?>" aria-selected="true">{{$cat->name}}</a>
                    </li>
                    <?php $counter++;?>
                  @endforeach
          </ul> <!--fin ul -->

          @isset($catArray)

          <div class="tab-content" id="pills-tabContent">
            @for($i=0; $i <= count($catArray)-1; $i++)
              @if ($i == 0)
                <?php $pane = 'show active' ; ?>
              @else
                <?php $pane = '' ; ?>
              @endif
              <div class="tab-pane fade <?=$pane ?>" id="pills-<?=$catArray[$i]?>" role="tabpanel" >
                <div class="row">
                     @foreach($products as $product)
                        @if($catArray[$i] == $product->category_id)
                       <div class="col-lg-3 col-sm-4 d-flex align-items-stretch">
                         <div class="card mx-auto card-product">
                           <img src="{{url('/product_img/'.$product->image)}}" class="card-top">
                           <div class="card-body card-product-body">
                             <h5 class="card-title">{{$product->name}}</h5>
                             <p class="card-text">Stock: {{$product->stock}}</p>
                             <p class="card-text">Taille: {{$product->size}}</p>
                             <p class="card-text">Prix: {{$product->price}}$</p>
                             <a href="{{route('bank.add',['id'=>$product->id])}}" ><i class="fas fa-2x fa-plus-square text-light"></i></a>
                           </div>
                         </div>
                       </div>
                       @endif
                     @endforeach
                </div><!--fin row-->
              </div>
            @endfor
          </div><!--fin tab-content-->
        @endisset
        </div><!--fin col-md-12 mt-3-->
    </div><!--fin row justify-content-center-->
  </div><!--fin container-->

  @if(count($products)==0)
    <div class="alert alert-light alert-dismissible fade show text-center" role="alert">
      <strong>Produit: </strong>Créer un produit dans la section "Gestion produits" pour modifier l'inventaire.
      <button type="button" class="close" data-dismiss="alert" aria-label="Close">
        <span aria-hidden="true">&times;</span>
      </button>
    </div>
  @endif

@else
    <div class="alert alert-light alert-dismissible fade show text-center" role="alert">
      <strong>Catégorie: </strong>Créer une catégorie dans la section "Gestion categorie" pour modifier l'inventaire.
      <button type="button" class="close" data-dismiss="alert" aria-label="Close">
        <span aria-hidden="true">&times;</span>
      </button>
    </div>
@endif

  @endsection
