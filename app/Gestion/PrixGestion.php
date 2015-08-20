<?php 

namespace App\Gestion;

use DB;
use App\Models\Combinaison;
use App\Models\Produit;

class PrixGestion{

    public static function getPrix($tabCaract)
	{
		$prix = Combinaison::select(DB::raw('count(com_fk_caracteristiques), com_fk_identifiant_combi'))
							->whereIn('com_fk_caracteristiques', $tabCaract)
							->groupBy('com_fk_identifiant_combi')
							->havingRaw('count(com_fk_caracteristiques)=' . count($tabCaract))
							->first()
							->identifiantCombi
							->prix
							->pri_htva_euro;
		return (float)$prix;
	}

	public static function getRangePrix($Produit){
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

}