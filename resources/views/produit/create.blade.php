@extends('template')

@section('title')
    - Ajout Produit
@stop

@section('contenu')
<div class="row">
  <div class="medium-12 columns">
    
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
    
    
    <form action="{{ route('produitStore') }}" method="POST" enctype="multipart/form-data">
      {!! csrf_field() !!}
      <!--Déscription produit-->
      <div class="panel" id="panelproduit">  
        <h3> Déscription du produit</h3>
        <!--Nom-->
        <label for="prod_nom">Nom du produit
          <input type="text" name="prod_nom" id="prod_nom" placeholder="Nom du produit" value="{{ old('prod_nom') }}" />
        </label>
        @if ($errors->has('prod_nom'))
          <small class="error">{{  $errors->first('prod_nom') }}</small>
        @endif
        <!--Slug-->
        <label for="prod_slug">Slug (Nom simplifié en minuscule, sans accents ou espace)
          <input type="text" name="prod_slug" id="prod_slug" placeholder="nomproduit" value="{{ old('prod_slug') }}" />
        </label>
        @if ($errors->has('prod_slug'))
          <small class="error">{{  $errors->first('prod_slug') }}</small>
        @endif
        <!--Vignette-->
        <p>Vignette
          <label for="prod_vignette" class="file-upload">Choisir une image     
            <input type="file" name="prod_vignette" id="prod_vignette" class="file-input" value="{{ old('prod_vignette') }}" />
          </label>
          @if ($errors->has('prod_vignette'))
            <small class="error">{{  $errors->first('prod_vignette') }}</small>
          @endif
        </p>
        <!--Image-->
        <p>Image
          <label for="prod_image" class="file-upload">Choisir une image    
            <input type="file" name="prod_image" id="prod_image" value="{{ old('prod_image') }}" />
          </label>
          @if ($errors->has('prod_image'))
            <small class="error">{{  $errors->first('prod_image') }}</small>
          @endif
        </p>
        <!--Description courte-->
        <label for="prod_descr_courte">Description courte
          <input type="text" name="prod_descr_courte" id="prod_descr_courte" value="{{ old('prod_descr_courte') }}" />
        </label>
        @if ($errors->has('prod_descr_courte'))
          <small class="error">{{  $errors->first('prod_descr_courte') }}</small>
        @endif
        <!--Description longue-->
        <label for="prod_descr_longue">Description longue
          <textarea name="prod_descr_longue" id="prod_descr_longue" rows="4">{{ old('prod_descr_longue') }}</textarea>
        </label>
        @if ($errors->has('prod_descr_longue'))
          <small class="error">{{  $errors->first('prod_descr_longue') }}</small>
        @endif
      </div>
      <!--END PANEL-->
      <!--Catégorie-->
      <div class="panel" id="panelcategorie">
        <h3>Catégorie et sous-Catégorie</h3>
        <!--Categorie-->
        <label for="categorie">Catégorie
          <select name="cat_slug" id="categorie">
            <option value="new_cat">Nouvelle catégorie</option>
            @foreach ($cats as $cat)
              <option value="{{ $cat->cat_slug }}">{{ $cat->cat_nom }}</option>
            @endforeach
          </select>
        </label>
        <div id="new_cat">
          <label for="new_cat_nom">Nom de la catégorie
            <input type="text" name="new_cat_nom" id="new_cat_nom" placeholder="Nom de la catégorie" />
          </label>
          @if ($errors->has('new_cat_nom'))
            <small class="error">{{  $errors->first('new_cat_nom') }}</small>
          @endif
          <label for="new_cat_slug">Slug de la catégorie (nom sans majuscule, espace ou accents)
            <input type="text" name="new_cat_slug" id="new_cat_slug" placeholder="nom_de_la_categorie" />
          </label>
          @if ($errors->has('new_cat_slug'))
            <small class="error">{{  $errors->first('new_cat_slug') }}</small>
          @endif
        </div>
        <!--Sous Categorie-->
        <label for="souscategorie">Sous-Catégorie
          <select name="sscat_slug" id="souscategorie">
            <option value="new_sscat">Nouvelle Sous-catégorie</option>
            @foreach ($cats->first()->sscats as $sscat)
              <option value="{{ $sscat->sscat_slug }}">{{ $sscat->sscat_nom }}</option>
            @endforeach
          </select>
        </label>
        <div id="new_sscat">
          <label for="new_sscat_nom">Nom de la sous-catégorie
            <input type="text" name="new_sscat_nom" id="new_sscat_nom" placeholder="Nom de la sous-catégorie" />
          </label>
          @if ($errors->has('new_sscat_nom'))
            <small class="error">{{  $errors->first('new_sscat_nom') }}</small>
          @endif
          <label for="new_sscat_slug">Slug de la sous-catégorie (nom sans majuscule, espace ou accents)
            <input type="text" name="new_sscat_slug" id="new_sscat_slug" placeholder="nom_de_la_sous_categorie" />
          </label>
          @if ($errors->has('new_sscat_slug'))
            <small class="error">{{  $errors->first('new_sscat_slug') }}</small>
          @endif
        </div>
      </div>
      <!--END PANEL-->
      <!--Propriétés-->
      <div class="panel" id="panelpropriete">
        <h3>Propriétés</h3>
        <button class="tiny" id="btnaddprop">+</button>
        
        <!--propriete base-->
        <div id="baseprop" class="row" style="display: none;">
          <!--Propriété-->
          <div class="large-3 columns propid">
            <select class="propselect">
              <option value="0">Nouvelle propriété</option>
              @foreach ($proprietes as $prop)
                <option value="{{ $prop->prop_id }}">{{ $prop->prop_nom }}</option>
              @endforeach
            </select>
          </div>
          <!--Nouveau Nom-->
          <div class="large-3 columns propnom">
            <input type="text" placeholder="Nom" class="propnom" />
          </div>
          <!--Delete prop-->
          <div class="large-1 columns propdel">
            <button class="tiny alert btnremoveprop">X</button>
          </div>
        </div>
        <!--END basecar-->
      </div>
      <!--END PANEL-->
      
      <!--Combinaison-->
      <div class="panel" id="panelcombinaison">
        <h3>Combinaisons</h3>
        <table class="tablecombi">
          <thead>
            <tr>
              <th>Propriété</th>
              <th width="40"></th>

            </tr>
          </thead>
          <tbody>
            <!--combinaison propriété à dupliquer, ne sera pas affiché-->
            <div class="row combipropbase" style="display: none;">
              <div class="medium-3 columns">
                <label class="right inline"></label>
              </div>
              <div class="medium-8 columns">
                <input type="text" placeholder="Entrez une valeur pour la propriété" />
              </div>
            </div>
            <!--Combinaison complete à dupliquer, ne sera pas affiché-->
            <tr class="combibase" style="display: none;">
              <td>
                <!--Prix-->
                <div class="row combiprix">
                  <div class="medium-3 columns">
                    <label class="right inline">Prix</label>
                  </div>
                  <div class="medium-8 columns">
                    <input type="text" />
                  </div>
                </div>
                <!--Poids-->
                <div class="row combipoids">
                  <div class="medium-3 columns">
                    <label class="right inline">Poids</label>
                  </div>
                  <div class="medium-8 columns">
                    <input type="text" />
                  </div>
                </div>
                <!--Volume confitionnement-->
                <div class="row combivolume">
                  <div class="medium-3 columns">
                    <label class="right inline">Vol. conditionnement</label>
                  </div>
                  <div class="medium-8 columns">
                    <input type="text" />
                  </div>
                </div>
              </td>
              <td><button class="btnremovecombi tiny alert nomargin">X</button></td>
            </tr>
            <tr>
              <td><button class="tiny nomargin" id="btnaddcombi">+</button></td>
              <td></td>
            </tr>
          </tbody>
        </table>

      </div>
      <!--END PANEL-->
      

      
      <input type="Submit" value="Créer produit" class="button"/>
    </form>
  </div>
</div>


@stop

@section('script')
<script src="{{ config('pathto.yakajs') }}"></script>
@stop