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
  <div class="large-8 large-offset-2 columns">
    <h2>Commandes</h2>
    <table class="panier nomargin">

      
      <thead>
        <tr>
          <th>Date</th>
          <th>Produits</th>
          <th class="text-right">Prix</th>
        </tr>
      </thead>
      <tbody>
        
          @foreach($commandes as $commande)
          <tr class="lignecommande">
            <!--Date-->
            <td><a href="">{{ $commande->com_date }}</a></td>

            <!--Produits-->
            <td>
              <ul class="no-bullet nomargin">
                @foreach ($commande->idCombis as $idCombi)
                  <li>{{ $idCombi->caracteristiques->first()->produit->prod_nom }}</li>
                @endforeach
              </ul> 
            </td>
            
            <!--Prix-->
            <td class="text-right"><strong>{{  $commandesPrix[$commande->com_id] }} €</strong></td>

          </tr>
          @endforeach
      </tbody>
    </table>

  </div>
</div>

@stop
