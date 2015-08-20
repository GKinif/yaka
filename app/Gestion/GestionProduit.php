<?php 

namespace App\Gestion;

use DB;
use App\Models\Combinaison;
use App\Models\Produit;
use App\Models\Prix;
use App\Models\Propriete;

use App\Gestion\MediaGestionInterface;

class GestionProduit{

    public static function getIdCombi($tabCaract) {
		$idCombi = Combinaison::select(DB::raw('count(com_fk_caracteristiques), com_fk_identifiant_combi'))
							->whereIn('com_fk_caracteristiques', $tabCaract)
							->groupBy('com_fk_identifiant_combi')
							->havingRaw('count(com_fk_caracteristiques)=' . count($tabCaract))
							->first()
							->identifiantCombi;
		return $idCombi;
	}
    
    public static function getPrix($tabCaract) {
		$prix = Combinaison::select(DB::raw('count(com_fk_caracteristiques), com_fk_identifiant_combi'))
							->whereIn('com_fk_caracteristiques', $tabCaract)
							->groupBy('com_fk_identifiant_combi')
							->havingRaw('count(com_fk_caracteristiques)=' . count($tabCaract))
							->first()
							->identifiantCombi
							->prix
							->pri_htva_euro;
		//print_r($prix);
		return (float)$prix;
	}

	public static function getRangePrix($Produit) {
		$produit = Produit::find($Produit->prod_id);
		$range = array(
			'min' => null,
			'max' => null
			);
		foreach ($produit->caracteristiques as $carac){
			foreach($carac->identifiantCombis as $combi){
				if (is_null($range['min'])){
					$range['min'] = $combi->prix->pri_htva_euro;
					$range['max'] = $combi->prix->pri_htva_euro;
				}else{
					if ($range['min'] > $combi->prix->pri_htva_euro){
						$range['min'] = $combi->prix->pri_htva_euro;
					}elseif ($range['max'] < $combi->prix->pri_htva_euro) {
						$range['max'] = $combi->prix->pri_htva_euro;
					}
				}
			}
		}
		return $range;
	}
	
	public static function createProduit($request, $sscat_id, $vignetteNom, $imageNom) {
		$prod = Produit::where('prod_slug', $request->input('prod_slug'))->first();
		if ($prod == null){
			$prod = new Produit;
	        $prod->prod_nom = $request->input('prod_nom');
	        $prod->prod_slug = $request->input('prod_slug');
	        $prod->prod_vignette = $vignetteNom;
	        $prod->prod_image = $imageNom;
	        $prod->prod_descr_courte = $request->input('prod_descr_courte');
	        $prod->prod_descr_longue = $request->input('prod_descr_longue');
	        $prod->prod_fk_sous_categories = $sscat_id;
	        $prod->save();
		}
		
        
        return $prod;
	}
	
	public static function createPrix($request, $combiNbr) {
		$prix = new Prix;
        $prix->pri_htva_euro = (float) $request->input('combi_'.$combiNbr.'_prix');
        $prix->pri_poids = (float) $request->input('combi_'.$combiNbr.'_poids');
        $prix->pri_vol_conditionnement = (float) $request->input('combi_'.$combiNbr.'_vol');
        $prix->save();
        
        return $prix;
	}
	
	public static function findOrCreateProp($request, $propNbr, $propId) {
		$prop = null;
		var_dump('find or create: ' . $propId);
		if ((int) $propId > 0 ) {
			var_dump('prop existante');
			$prop = Propriete::find($propId);
		} elseif ((int) $propId < 0) {
			var_dump('nouvelle prop');
			$prop = new Propriete;
			$prop->prop_nom = $request->input('prop_'.$propNbr.'_name');
			$prop->save();
		}
		return $prop;
	}

}