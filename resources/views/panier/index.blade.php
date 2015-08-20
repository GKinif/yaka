{{-- PANIER.index --}}
@extends('template')

@section('title')
- Panier
@stop

@section('style')
<style> 
	table {
    width: 100%;
    margin: 0;
  }
</style>
@stop

@section('contenu')
<div class="row">
  <div class="large-12 columns">
    <h1>Votre panier</h1>
    @if ($panier)
      
      <div class="clearfix">
        <a href="{{ route('panierClear')  }}" class="button small right alert nomargin"><i class="fi-x-circle"></i> Vider panier</a>
      </div>
      
      <table class="panier">
        <colgroup>
           <col span="1">
           <col span="1" style="width: 50px;">
           <col span="1">
           <col span="1" style="width: 4em;">
           <col span="1" style="width: 20px;">
           <col span="1" style="width: 120px;">
        </colgroup>
        
        <thead>
          <tr>
            <th>Nom</th>
            <th>photo</th>
            <th>Caractéristiques</th>
            <th>Quantité</th>
            <th></th>
            <th>Prix</th>
          </tr>
        </thead>
        <tbody>
          
            @foreach($panier as $id => $elem)
            <input type="hidden" name="{{ $elem['idCombi']->idc_id }}_id" value="{{ $elem['idCombi']->idc_id }}">
            <tr class="lignecommande">
              <!--Nom-->
              <td><a href="">{{ $elem['idCombi']->caracteristiques->first()->produit->prod_nom }}</a></td>
              <!--Thumbnail-->
              <td><a href=""><img src="{{ config('pathto.media') }}produits/{{ $elem['idCombi']->caracteristiques->first()->produit->prod_vignette }}"/></a></td>
              <!--Caractéristiques-->
              <td>
                <ul class="no-bullet">
                  @foreach( $elem['idCombi']->caracteristiques as $carac )
                    <li>{{ $carac->propriete->prop_nom }}: {{ $carac->car_valeur }}</li>
                  @endforeach
                </ul>
              </td>
              <!--Quantite-->
              <td>
                <div class="row">
                  <input type="number" name="{{ $elem['idCombi']->idc_id }}_quantite" id="{{ $elem['idCombi']->idc_id }}_quantite" class="nomargin quantite" value="{{ $elem['quantite'] }}" min="0">
                </div>   
              </td>
              <!--Supprimer ligne-->
              <td>
                <a href="{{ route('panierDestroy', ['id' => $elem['idCombi']->idc_id]) }}" class="button tiny alert nomargin"><i class="fi-x"></i></a>
              </td>
              <!--Prix-->
              <td class="text-right"><strong><span data-prixunite="{{ $elem['idCombi']->prix->pri_htva_euro }}" id="{{ $elem['idCombi']->idc_id }}" class="prixligne"></span> €</strong></td>
            </tr>
            @endforeach
        </tbody>
      </table>
      
        <div class="right">
          <table>
            <tbody>
              <tr>
                <td class="text-right">sous-total (htva)</td>
                <td class="text-right"><span class="soustotal"></span> €</td>
              </tr>
              <tr>
                <td class="text-right">tva</td>
                <td class="text-right"><span class="tva"></span> €</td>
              </tr>
              
              <tr>
                <td class="text-right">Total</td>
                <td class="text-right"><strong><span class="prixtotal"></span> €</strong></td>
              </tr>
              <tr>
                <td colspan="2">
                  <a href="{{ route('commandeCreate') }}" class="button small expand success nomargin">Commander</a>
                </td>
              </tr>
            </tbody>
          </table>
          
        </div>
    
    @else
      <p>Votre panier est vide pour le moment !</p>
      
    @endif
  </div>
</div>
@stop

@section('script')
<script>
  $(document).ready(function(){
    $('.quantite').change(calculPrix);
    
    calculPrixAllLine();
    
    function calculPrix(e) {
      var ligne = $(e.target.closest('tr'));
      var prixligne = ligne.find('.prixligne').data('prixunite') * e.target.value;
      ligne.find('.prixligne').html(prixligne);
      calculPrixTotal();
    };
    
    function calculPrixAllLine(){
      $('.lignecommande').each( function(){
        var spanprixligne = $( $(this).find('.prixligne') );
        spanprixligne.html( spanprixligne.data('prixunite') * $(this).find('.quantite').val() );
        calculPrixTotal();
      });
    };
    
    function calculPrixTotal(){
      var soustotal = 0;
      $('.prixligne').each( function(){
        soustotal += Number( $(this).html() );  
      });
      soustotal = soustotal.toFixed(2);
      var tva = (soustotal * 0.21).toFixed(2);
      $('.soustotal').html(soustotal);
      $('.tva').html(tva);
      $('.prixtotal').html( Number(soustotal) + Number(tva) );
    };
    
  });
</script>
@stop