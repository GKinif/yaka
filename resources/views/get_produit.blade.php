@extends('template')

@section('title')
    - Produit
@stop

@section('contenu')
<div class="row">

  <div class="medium-6 columns">
  	<img src="/yaka/media/produits/{{ $produit->prod_image }}"/>
  </div>

  <div class="medium-6 columns">
  	<h1>{{ $produit->prod_nom }}</h1>

  	<p>{!! $produit->prod_descr_longue !!}</p>

  	<p>
  		<form>
				{!! csrf_field() !!}
				@foreach ($form as $prop=>$val)
					{{ $prop }}
					<select name="{{ $prop }}" form="carform">
						@foreach ($val as $carac)
							<option value="{{ $carac->car_id }}">{{ $carac->car_valeur }}</option>
						@endforeach
					</select>
				@endforeach
  		</form>
  	</p>

  	<p>Prix: {{ $rangePrix[0] }} € - {{ $rangePrix[1] }} €</p>

  </div>


</div>
@stop