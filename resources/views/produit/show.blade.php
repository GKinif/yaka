@extends('template')

@section('title')
    - Produit
@stop

@section('contenu')
<div class="row">
  <div class="medium-12 columns">
    <ul class="breadcrumbs"> 
      <li>
        <a href="{{ config('pathto.root') }}">Home</a>
      </li>
      <li>
        <a href="{{ config('pathto.root') }}categorie/{{ $cat->cat_slug }}">{{ $cat->cat_nom }}</a>
      </li>
      <li>
        <a href="{{ config('pathto.root') }}categorie/{{ $cat->cat_slug }}/souscategorie/{{ $sscat->sscat_slug }}">{{ $sscat->sscat_nom }}</a>
      </li>
      <li class="current">
        <a href="{{ config('pathto.root') }}categorie/{{ $cat->cat_slug }}/souscategorie/{{ $sscat->sscat_slug }}/produit/{{ $produit->prod_slug }}">{{ $sscat->sscat_nom }}</a>
      </li>
    </ul>
  </div>
</div>

<div class="row">
  <div class="medium-6 columns">
    <img src="{{ config('pathto.media') }}produits/{{ $produit->prod_image }}"/>
  </div>

  <div class="medium-6 columns">
    <h1>{{ $produit->prod_nom }}</h1>

    <p>{!! $produit->prod_descr_longue !!}</p>
    
    <p><h3>Prix: <span id="prix"></span> € / pièce (HTVA)</h3></p>

    <p>
        <form id="choix_caracteristique" method="POST" action="{{ route('panierStore') }}">
                {!! csrf_field() !!}
                @foreach ($form as $prop=>$val)
                    {{ $prop }}
                    <select name="{{ $prop }}" form="carform">
                        @foreach ($val as $carac)
                            <option value="{{ $carac->car_id }}">{{ $carac->car_valeur }}</option>
                        @endforeach
                    </select>
                @endforeach
                
                <input type="submit" value="Ajouter au panier" class="button" id="ajoutpanier"/>
        </form>
    </p>

    

  </div>
</div>

<div class="row">
  <div class="medium-12 columns">
    <h2>Produits similaires</h2>
    <div class="grid">
    @foreach ($sscat->produits as $prod)
        @include('template.pricing_table')
    @endforeach
    </div>
  </div>
</div>
@stop

@section('script')
<script src="{{ config('pathto.js') }}produit.js"></script>
<script src="{{ config('pathto.js') }}imagesloaded.pkgd.min.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/masonry/3.3.1/masonry.pkgd.min.js"></script>
<script>
  $(document).ready(function() {
    var $grid = $('.grid').imagesLoaded( function() {
      // init Masonry after all images have loaded
      $grid.masonry({
        // options
        itemSelector: '.grid-item',
        columnWidth: 300,
        "gutter": 35
      });
    });
  });  
</script>
@stop