@extends('template')

@section('contenu')
<div class="row">
  <div class="large-8 large-offset-2 columns">
    <h2>Valider commande</h2>
    <table class="panier nomargin">
      <colgroup>
        <col span="1">
        <col span="1" style="width: 50px;">
        <col span="1">
      </colgroup>
      
      <thead>
        <tr>
          <th>Nom</th>
          <th>Quantité</th>
          <th class="text-right">Prix</th>
        </tr>
      </thead>
      <tbody>
        
          @foreach($panier as $id => $elem)
          <input type="hidden" name="{{ $elem['idCombi']->idc_id }}_id" value="{{ $elem['idCombi']->idc_id }}">
          <tr class="lignecommande">
            <!--Nom-->
            <td><a href="">{{ $elem['idCombi']->caracteristiques->first()->produit->prod_nom }}</a></td>

            <!--Quantite-->
            <td>
              <div class="row text-center">
                {{ $elem['quantite'] }}
              </div>   
            </td>

            <!--Prix-->
            <td class="text-right"><strong><span class="prixligne">{{ $elem['idCombi']->prix->pri_htva_euro * $elem['quantite'] }}</span> €</strong></td>
          </tr>
          @endforeach
      </tbody>
    </table>
    <!--Table total-->
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
              <form method="POST" action="{{ route('commandeStore') }}">
                {!! csrf_field() !!}
                @foreach($panier as $id => $elem)
                  <input type="hidden" name="{{ $elem['idCombi']->idc_id }}" value="{{ $elem['quantite'] }}" />
                @endforeach
                <input type="submit" value="Valider" class="button small expand success nomargin"/>
              </form>
            </td>
          </tr>
        </tbody>
      </table>
      
    </div>
    <!--FIN Table total-->
  </div>
</div>

@stop

@section('script')
<script>
  $(document).ready(function(){
    calculPrixTotal();
    
    function calculPrixTotal(){
      var soustotal = 0;
      $('.prixligne').each( function(){
        soustotal += Number( $(this).html() );  
      });
      var tva = (soustotal * 0.21).toFixed(2);
      $('.soustotal').html(soustotal);
      $('.tva').html(tva);
      $('.prixtotal').html( Number(soustotal) + Number(tva) );
    };
    
  });
</script>
@stop