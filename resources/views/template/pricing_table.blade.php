<div class="large-4 columns equalize">
		
  <ul class="pricing-table">
  	<!--Nom-->
	<li class="title">{{ $prod->prod_nom }}</li>
	<!--Thumbnail-->
	<div data-equalizer-watch>
	<li class="bullet-item text-center"><img src="{{ config('pathto.media') }}produits/{{ $prod->prod_vignette }}"/></li>
</div>
<!--Description-->
<li class="description">{{ $prod->prod_descr_courte }}</li>
<!--Prix-->
    <li class="price">A partir de<br/>{{ $listePrix[$prod->prod_slug]['min'] }}€</li>
    <!--Bouton achat-->
    <li class="cta-button">
    <a class="button" href="{{ config('pathto.root') }}categorie/{{ $prod->sscat->categorie->cat_slug }}/souscategorie/{{ $prod->sscat->sscat_slug }}/produit/{{ $prod->prod_slug}}">
    	Acheter
    </a>
  </li> 
  </ul>

</div>