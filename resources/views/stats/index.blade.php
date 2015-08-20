@extends('template')

@section('contenu')

<div class="row">
<div class="medium-12 columns">

		<h2>Produits récents (Presenation 1)</h2>
		<div class="row" data-equalizer>
		  @foreach ($produits as $prod)
		    @include('pricing_table')
		  @endforeach
		</div>
		
</div>
</div>

@stop