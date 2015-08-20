{{-- SOUS CATEGORIE --}}
@extends('template')

@section('title')
- {{ $cat->cat_nom }} - categorie
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
        <a href="{{ config('pathto.root') }}{{ $cat->cat_slug }}">{{ $cat->cat_nom }}</a>
      </li>
    </ul>
  </div>
</div>
<!--END Breadcrumbs-->

<!--liste ss_cat-->
<div class="row" data-equalizer>
  @foreach ($cat->sscats as $sscat)
  <div class="large-4 columns equalize">

    <ul class="pricing-table">
      <div data-equalizer-watch>
      <li class="title">{{ $sscat->sscat_nom  }}</li>
      <li class="bullet-item text-center"><img src="{{ config('pathto.media') }}produits/{{ $sscat->produits->first()->prod_vignette }}"/></li>
      </div>
      <li class="cta-button"><a class="button small expand" href="{{ config('pathto.root') }}categorie/{{ $cat->cat_slug }}/souscategorie/{{ $sscat->sscat_slug }}">Voir</a></li>
    </ul>

  </div>
  @endforeach
</div>
<!--END liste ss_cat-->
@stop