<!-- resources/views/auth/login.blade.php -->

@extends('template')

@section('title')
    - Login
@stop

@section('contenu')
<div class="row">
  <div class="medium-6 medium-offset-3 columns">
  <h1>Login</h1>
  
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
  
    <form method="POST" action="/auth/login">
      {!! csrf_field() !!}

      <div>
        <label for="email">Email <small>required</small>
          <input type="email" name="email" id="email" value="{{ old('email') }}">
        </label>
        @if ($errors->has('email'))
          <small class="error">{{  $errors->first('email') }}</small>
        @endif
      </div>

      <div>
        <label for="password">Password <small>required</small>
          <input type="password" name="password" id="password">
        </label>
        @if ($errors->has('password'))
          <small class="error">{{  $errors->first('password') }}</small>
        @endif
      </div>

      <div>
        <input type="checkbox" name="remember" id="remember"><label for="remember">Remember Me</label>
      </div>

      <div>
        <button type="submit">Login</button>
      </div>
    </form>
  </div>
</div>
@stop