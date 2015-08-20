@extends('template')

@section('title')
- {{ $cat->cat_slug }} - {{ $sscat->sscat_nom }} - produit
@stop

@section('style')
<style>
  .grid-item {
    width: 300px;
    float: left;
  }
</style>
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
      <li class="current">
        <a href="{{ config('pathto.root') }}categorie/{{ $cat->cat_slug }}/souscategorie/{{ $sscat->sscat_slug }}">{{ $sscat->sscat_nom }}</a>
      </li>
    </ul>
  </div>
</div>

<div class="row">
  <div class="medium-12 columns">
    <div class="grid">
    @foreach ($sscat->produits as $prod)
        @include('template.pricing_table')
    @endforeach
    </div>
  </div>
</div>
@stop




@section('script')
<script src="{{ config('pathto.js') }}imagesloaded.pkgd.min.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/masonry/3.3.1/masonry.pkgd.min.js"></script>
<script>
  $(document).ready(function() {
    //$(".divprix").last().addClass("end");
    console.log('test');
    $('.grid').masonry({
      // options
      itemSelector: '.grid-item',
      columnWidth: 300,
      "gutter": 35
    });

  });  
</script>
@stop