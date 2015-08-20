@extends('template')

@section('titre')
    YAKA
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

		<h2>Produits récents (Presenation 1)</h2>
		<div class="row" data-equalizer>
		  @foreach ($lastProduits as $prod)
		 		@include('template.pricing_table')
		  @endforeach
		</div>
		
</div>
</div>


	<div class="row">
	  <div class="medium-12 columns">

				<h2>Produits récents (Presenation 2)</h2>
				
		    <div class="grid">
		    @foreach ($lastProduits as $prod)
		        <div class="grid-item">
		          <ul class="pricing-table">
		            <li class="title">{{ $prod->prod_nom }}</li>
		            <li class="bullet-item text-center"><img src="{{ config('pathto.media') }}produits/{{ $prod->prod_vignette }}"/></li>
		            <li class="description">{{ $prod->prod_descr_courte }}</li>
		            <li class="price">A partir de {{ $listePrix[$prod->prod_slug]['min'] }}€</li>
		            
		            <li class="cta-button">
		              <a class="button" href="{{ config('pathto.root') }}categorie/{{ $prod->sscat->categorie->cat_slug }}/souscategorie/{{ $prod->sscat->sscat_slug }}/produit/{{ $prod->prod_slug}}">
		              	Buy Now
		              </a>
		            </li> 
		          </ul>
		        </div>
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