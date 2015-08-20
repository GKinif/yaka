@extends('template')

@section('title')
- categorie
@stop

@section('contenu')

<!--Breadcrumbs-->
<div class="row">
  <div class="medium-12 columns">
    <ul class="breadcrumbs"> 
      <li>
        <a href="{{ config('pathto.root') }}">Home</a>
      </li>
      <li class="current">
        <a href="{{ config('pathto.root') }}categorie">Catégorie</a>
      </li>
    </ul>
  </div>
</div>
<!--END Breadcrumbs-->

<!--liste cat-->
<div class="row" data-equalizer>
  @foreach ($categories as $categorie)
  <div class="large-4 columns equalize">

    <ul class="pricing-table">
      <div data-equalizer-watch>
        <li class="title">{{ $categorie->cat_nom  }}</li>
        <li class="bullet-item text-center"><img src="{{ config('pathto.media') }}produits/{{ $categorie->sscats->first()->produits->first()->prod_vignette }}"/></li>
      </div>
      <li class="cta-button"><a class="button small expand" href="{{ config('pathto.root') }}categorie/{{ $categorie->cat_slug }}/souscategorie">Voir</a></li>
    </ul>

  </div>
  @endforeach
</div>
<!--END liste cat-->
@stop