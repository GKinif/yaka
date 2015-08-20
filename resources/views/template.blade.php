<!DOCTYPE html>
<html lang="fr">
    <head>
		<meta charset="utf-8">
		<meta http-equiv="X-UA-Compatible" content="IE=edge">
		<meta name="viewport" content="width=device-width, initial-scale=1">
		<meta name="csrf-token" content="{{ csrf_token() }}" />
		<title>YAKA @yield('title')</title>
		<link rel="stylesheet" type="text/css" href="{{ config('pathto.css') }}foundation.min.css">
		<link rel="stylesheet" type="text/css" href="{{ config('pathto.css') }}icons/foundation-icons.css">
		<link rel="stylesheet" type="text/css" href="{{ config('pathto.css') }}style_yaka.css">
		<link rel="stylesheet" type="text/css" href="{{ config('pathto.js') }}vendor/modernizr.js">
		<!--[if lt IE 9]>
			{{ Html::style('https://oss.maxcdn.com/libs/html5shiv/3.7.2/html5shiv.js') }}
			{{ Html::style('https://oss.maxcdn.com/libs/respond.js/1.4.2/respond.min.js') }}
		<![endif]-->
		<style> 
			textarea { 
				resize: none; 
			}

			img {
				max-width: 100%;
  				height: auto;
			}

		</style>
		@yield('style')
	</head>
	<body>

		<!-- NAVIGATION -->
		<nav class="top-bar" data-topbar role="navigation">
		  <ul class="title-area">
		    <li class="name">
		      <h1><a href="{{ config('pathto.root') }}">YAKA</a></h1>
		    </li>
		     <!-- Remove the class "menu-icon" to get rid of menu icon. Take out "Menu" to just have icon alone -->
		    <li class="toggle-topbar menu-icon"><a href="#"><span>Menu</span></a></li>
		  </ul>

		  <section class="top-bar-section">
		    <!-- Right Nav Section -->
		    <ul class="right">
		    	<li>
		    		<a href="{{ route('panierIndex') }}">
		    			<i class="fi-shopping-cart"></i> Panier
		    			<span class="label radius alert taillepanier">
		    			@if ( session()->has('taillepanier') )
			    			{{ session('taillepanier') }}
			    		@else
			    			0
			    		@endif
			    		</span>
		    			</a>
		    	</li>
		    	<!--connected-->
		    	@if (Auth::user())
		    		<li class="has-dropdown">
		        <a href="#"><i class="fi-torso"></i> Profil</a>
		        <ul class="dropdown">
		        	
							<li><a href="{{ route("homeIndex") }}"><i class="fi-home"></i> Home</a></li>
							<li><a href="{{ route("logout") }}" role="button"><i class="fi-x"></i> Disconnect</a></li>
		        </ul>
		      </li>
		    	@endif
		    	<!--disconnected-->
		    	@if (!Auth::user())
		      <li><a href="{{ config('pathto.root') }}auth/login"><i class="fi-torso"></i> Connexion</a></li>
		      <li><a href="{{ config('pathto.root') }}auth/register"><i class="fi-torsos"></i> S'enregistrer</a></li>
		      @endif
		    </ul>

		    <!-- Left Nav Section -->
		    <ul class="left">
		    	<li class="divider"></li>
		      <li class="has-dropdown">
		        <a href="{{ config('pathto.root') }}categorie"><i class="fi-list-bullet"></i> Catégories</a>
		        <ul class="dropdown">
		          @foreach ($categories as $cat)
								<li class="has-dropdown">
									<a href="{{ config('pathto.root') }}categorie/{{ $cat->cat_slug }}">{{ $cat->cat_nom }}</a>
									<ul class="dropdown">
									@foreach ($cat->sscats as $sscat)
										<li><a href="{{ config('pathto.root') }}categorie/{{ $cat->cat_slug }}/souscategorie/{{ $sscat->sscat_slug }}">{{ $sscat->sscat_nom }}</a></li>
									@endforeach
									</ul>
								</li>
							@endforeach
		        </ul>
		      </li>
		      
		      <li class="has-form">
		      	<form action="{{ config('pathto.root') }}search" method="GET">
						  <div class="row collapse">
						    <div class="large-8 small-9 columns">
						      <input type="text" placeholder="recherche" name="query">
						    </div>
						    <div class="large-4 small-3 columns">
						      <button type="submit" class="alert button expand">Chercher</button>
						    </div>
						  </div>
					  </form>
					</li>
				
		    </ul>
		    
		  </section>
		</nav>
		<!-- END NAVIGATION -->

		@yield('contenu')

		<script src="https://ajax.googleapis.com/ajax/libs/jquery/2.1.4/jquery.min.js"></script>
		<script src="{{ config('pathto.js') }}foundation.min.js"></script>
	  <script>
	    $(document).ready(function() {
	      $(document).foundation({
				  equalizer : {
				    // Specify if Equalizer should make elements equal height once they become stacked.
				    equalize_on_stack: true,
				    // Allow equalizer to resize hidden elements
				    act_on_hidden_el: false
				  }
				});
				
				// rajouter la class end à la dernière column de chaque row
				var rows = $('.row .columns:last-child').addClass('end');
	    });
	  </script>
	  @yield('script')
	</body>
</html>