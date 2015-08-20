<?php

namespace App\Http\Controllers;

use DB;

use App\Models\Produit;
use App\Gestion\PrixGestion;

class IndexController extends Controller{
	public function index(){
		
		$lastProduits = Produit::orderBy('prod_id', 'desc')
		                        ->take(9)
		                        ->get();

        $listePrix = array();

        foreach ($lastProduits as $prod){
            $listePrix[$prod->prod_slug] = PrixGestion::getRangePrix($prod);
        }
		
		return view('index', [
            'lastProduits' => $lastProduits,
            'listePrix' => $listePrix
            ]);
	}
}