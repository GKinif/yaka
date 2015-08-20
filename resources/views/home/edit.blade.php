<!-- resources/views/auth/register.blade.php -->

@extends('template')

@section('title')
    - Edit
@stop

@section('contenu')
<div class="row">
	<div class="large-12 columns">
		
		<div class="icon-bar four-up">
		  <a href="{{ route('homeIndex') }}" class="item">
		  	<i class="fi-home"></i>
		    <label>Home</label>
		  </a>
		  <a href="{{ route('homeEdit') }}" class="item">
		  	<i class="fi-pencil"></i>
		    <label>Editer</label>
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
	</div>
</div>

<div class="row">
  <div class="medium-6 medium-offset-3 columns">
    <h1>Modifier informations</h1>
    
    @if (count($errors) > 0)
			<div class="panel warning radius">
				<strong>Whoops!</strong> There were some problems with your input.<br><br>
				<ul>
					@foreach ($errors->all() as $error)
						<li class="label alert radius">{{ $error }}</li>
					@endforeach
				</ul>
			</div>
		@endif
    
    <form method="POST" action="{{ route('homeUpdate') }}">
      {!! csrf_field() !!}

      <!--ADRESSE-->
      <div class="col-md-6">
        <label for="adresse">Adresse
          <input type="text" name="adresse" id="adresse" value="@if(old('adresse')){{ old('adresse') }}@else{{ $user->adresse }}@endif">
        </label>
        @if ($errors->has('adresse'))
          <small class="error">{{  $errors->first('adresse') }}</small>
        @endif
      </div>
      
      <!--CP-->
      <div class="col-md-6">
        <label for="cp">Code postal
          <input type="text" name="cp" id="cp" value="@if(old('cp')){{ old('cp') }}@else{{ $user->cp }}@endif">
        </label>
        @if ($errors->has('cp'))
          <small class="error">{{  $errors->first('cp') }}</small>
        @endif
      </div>
      
      <!--LOCALITE-->
      <div class="col-md-6">
        <label for="localite">Localité
          <input type="text" name="localite" id="localite" value="@if(old('localite')){{ old('localite') }}@else{{ $user->localite }}@endif">
        </label>
        @if ($errors->has('localite'))
          <small class="error">{{  $errors->first('localite') }}</small>
        @endif
      </div>
      
      <!--PAYS-->
      <div class="col-md-6">
        <label for="pays">Pays (à changer en liste)
          <input type="text" name="pays" id="pays" value="@if(old('pays')){{ old('pays') }}@else{{ $user->pays }}@endif">
        </label>
        @if ($errors->has('pays'))
          <small class="error">{{  $errors->first('pays') }}</small>
        @endif
      </div>
      
      <!--TELEPHONE-->
      <div class="col-md-6">
        <label for="telephone">Téléphone
          <input type="text" name="telephone" id="telephone" value="@if(old('telephone')){{ old('telephone') }}@else{{ $user->telephone }}@endif">
        </label>
        @if ($errors->has('telephone'))
          <small class="error">{{  $errors->first('telephone') }}</small>
        @endif
      </div>
      
      <!--NUMERO CARTE-->
      <div class="col-md-6">
        <label for="numero_carte">Numéro de carte
          <input type="text" name="numero_carte" id="numero_carte" value="@if(old('numero_carte')){{ old('numero_carte') }}@else{{ $user->numero_carte }}@endif">
        </label>
        @if ($errors->has('numero_carte'))
          <small class="error">{{  $errors->first('numero_carte') }}</small>
        @endif
      </div>

      <div>
        <button type="submit">Editer</button>
      </div>
    </form>
  </div>
</div>
@stop