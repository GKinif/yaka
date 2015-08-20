@extends('template')

@section('contenu')

<div class="row">
	<div class="large-12 columns">
		
		<div class="icon-bar four-up">
		  <a href="{{ route('homeIndex') }}" class="item">
		  	<i class="fi-home"></i>
		    <label>Home</label>
		  </a>
		  <a href="{{ route('homeEdit') }}" class="item">
		  	<i class="fi-graph-trend"></i>
		    <label>Stats</label>
		  </a>
		  <a href="{{ route('commandeIndex') }}" class="item">
		  	<i class="fi-shopping-bag"></i>
		    <label>Commandes</label>
		  </a>
		  <a href="{{ route('logout') }}" class="item">
		  	<i class="fi-x"></i>
		    <label>Déconnection</label>
		  </a>
		</div>
		
		<div class="panel panel-default">
			<div class="panel-heading">Home</div>
			<div class="panel-body">
			    <p>Bonjour {{ $user->name }}</p>
			    

			</div>
		</div>
	</div>
</div>

@stop