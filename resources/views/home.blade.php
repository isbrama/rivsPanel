@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card">
                <div class="card-header">Bienvenue  {{$user->name}} !</div>
                <div class="card-body">
                  Ce site est un système d'inventaire ou l'entreprise pourra gérer ses produits en ligne.
                  Pour commencer, Clique sur l'onglet GESTION CATÉGORIE pour ajouter une catégorie et ensuite
                  ajouter des produits dans l'onglet GESTION PRODUITS.
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
