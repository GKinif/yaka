<!-- resources/views/auth/register.blade.php -->

@extends('template')

@section('title')
    - Login
@stop

@section('contenu')
<div class="row">
  <div class="medium-6 medium-offset-3 columns">
    <h1>Register</h1>
    
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
    
    <form method="POST" action="/auth/register">
      {!! csrf_field() !!}
      
      <!--NOM-->
      <div class="col-md-6">
        <label for="name">Nom <small>required</small>
          <input type="text" name="name" id="name" value="{{ old('name') }}">
        </label>
        @if ($errors->has('name'))
          <small class="error">{{  $errors->first('name') }}</small>
        @endif
      </div>
      
      <!--PRENOM-->
      <div class="col-md-6">
        <label for="prenom">Prenom <small>required</small>
          <input type="text" name="prenom" id="prenom" value="{{ old('prenom') }}">
        </label>
        @if ($errors->has('prenom'))
          <small class="error">{{  $errors->first('prenom') }}</small>
        @endif
      </div>
      
      <!--EMAIL-->  
      <div>
        <label for="email">Email <small>required</small>
          <input type="email" name="email" id="email" value="{{ old('email') }}">
        </label>
        @if ($errors->has('email'))
          <small class="error">{{  $errors->first('email') }}</small>
        @endif
      </div>
      
      <!--PASSWORD-->
      <div>
        <label for="password">Password <small>required</small>
          <input type="password" id="password" name="password">
        </label>
        @if ($errors->has('password'))
          <small class="error">{{  $errors->first('password') }}</small>
        @endif
      </div>
      
      <!--CONFIRM PASSWORD-->
      <div class="col-md-6">
        <label for="password_confirmation">Confirm Password
          <input type="password" name="password_confirmation" id="password_confirmation">
        </label>
        @if ($errors->has('password_confirmation'))
          <small class="error">{{  $errors->first('password_confirmation') }}</small>
        @endif
      </div>
      
      <hr/>
      
      <!--ADRESSE-->
      <div class="col-md-6">
        <label for="adresse">Adresse
          <input type="text" name="adresse" id="adresse" value="{{ old('adresse') }}">
        </label>
        @if ($errors->has('adresse'))
          <small class="error">{{  $errors->first('adresse') }}</small>
        @endif
      </div>
      
      <!--CP-->
      <div class="col-md-6">
        <label for="cp">Code postal
          <input type="text" name="cp" id="cp" value="{{ old('cp') }}">
        </label>
        @if ($errors->has('cp'))
          <small class="error">{{  $errors->first('cp') }}</small>
        @endif
      </div>
      
      <!--LOCALITE-->
      <div class="col-md-6">
        <label for="localite">Localité
          <input type="text" name="localite" id="localite" value="{{ old('localite') }}">
        </label>
        @if ($errors->has('localite'))
          <small class="error">{{  $errors->first('localite') }}</small>
        @endif
      </div>
      
      <!--PAYS-->
      <div class="col-md-6">
        <label for="pays">Pays (à changer en liste)
          <input type="text" name="pays" id="pays" value="{{ old('pays') }}">
        </label>
        @if ($errors->has('pays'))
          <small class="error">{{  $errors->first('pays') }}</small>
        @endif
      </div>
      
      <!--TELEPHONE-->
      <div class="col-md-6">
        <label for="telephone">Téléphone
          <input type="text" name="telephone" id="telephone" value="{{ old('telephone') }}">
        </label>
        @if ($errors->has('telephone'))
          <small class="error">{{  $errors->first('telephone') }}</small>
        @endif
      </div>
      
      <!--NUMERO CARTE-->
      <div class="col-md-6">
        <label for="numero_carte">Numéro de carte
          <input type="text" name="numero_carte" id="numero_carte" value="{{ old('numero_carte') }}">
        </label>
        @if ($errors->has('numero_carte'))
          <small class="error">{{  $errors->first('numero_carte') }}</small>
        @endif
      </div>

      <div>
        <button type="submit">Register</button>
      </div>
    </form>
  </div>
</div>
@stop