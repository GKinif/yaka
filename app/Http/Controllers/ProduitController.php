<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Http\Requests;
use App\Http\Requests\RequestProduit;
use App\Http\Controllers\Controller;

use App\Models\SousCategorie;
use App\Models\Categorie;
use App\Models\Produit;
use App\Models\Propriete;

use App\Models\Caracteristique;
use App\Models\IdentifiantCombi;
use App\Models\Combinaison;

use App\Gestion\GestionProduit;
use App\Gestion\PrixGestion;
use App\Gestion\MediaGestionInterface;

class ProduitController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return Response
     */
    public function index($slugCategorie, $slugSousCategorie)
    {
        $cat = Categorie::where('cat_slug', $slugCategorie)->first();
        $sscat = SousCategorie::where('sscat_slug', $slugSousCategorie)->first();
        $listePrix = array();

        foreach ($sscat->produits as $prod){
            $listePrix[$prod->prod_slug] = PrixGestion::getRangePrix($prod);
        }

        return view('produit.index', [
            'sscat' => $sscat,
            'cat' => $cat,
            'listePrix' => $listePrix,
            ]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return Response
     */
    public function create() {
        $cats = Categorie::all();
        $proprietes = Propriete::all();
        return view('produit.create', [
            'cats' => $cats,
            'proprietes' => $proprietes
            ]);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @return Response
     */
    public function store( RequestProduit $request, MediaGestionInterface $mediaGestion ) {
        var_dump( $request->all() );
        //return view('produit.store');
        
        // catégorie
        $cat = null;
        if ( $request->input('cat_slug') == 'new_cat') {
            $cat = new Categorie;
            $cat->cat_nom = $request->input('new_cat_nom');
            $cat->cat_slug = $request->input('new_cat_slug');
            $cat->save();
        } else {
            $cat = Categorie::where('cat_slug', $request->input('cat_slug') )->first();
        }

        // sous-catégorie
        $sscat = null;
        if ( $request->input('sscat_slug') == 'new_sscat') {
            $sscat = SousCategorie::where('sscat_slug', $request->input('new_sscat_slug') )->first();
            if ( $sscat == null ){
                $sscat = new SousCategorie;
                $sscat->sscat_nom = $request->input('new_sscat_nom');
                $sscat->sscat_slug = $request->input('new_sscat_slug');
                $sscat->sscat_fk_categories = $cat->cat_id;
                $sscat->save();
            }
        } else {
            $sscat = SousCategorie::where('sscat_slug', $request->input('sscat_slug') )->first();
        }
        
        // Produit
        $vignetteNom = $mediaGestion->saveProduitImage( $request->file('prod_vignette'), 'v', $request->input('prod_slug'));
        $imageNom = $mediaGestion->saveProduitImage( $request->file('prod_image'), 'i', $request->input('prod_slug'));
        $prod = GestionProduit::createProduit($request, $sscat->sscat_id, $vignetteNom, $imageNom);

        // Combinaisons
        $tabCar = array();
        $tabCombi = array();
        $tabPrix = array();
        $tabProp = array();
        
        $patternid = '/prop_([0-9]+)_id/i';
        $match = null;
        
        $patternCombi = '/combi_([0-9]+)_idprop_(-?[0-9]+)_val/';
        $matchCombi = null;
        foreach ( $request->all() as $key => $value ) {
            if ( preg_match( $patternCombi, $key, $matchCombi ) ) {
                $combiNbr = $matchCombi[1];
                $propNbr = $matchCombi[2];
                
                $combi = null;
                if ( !array_key_exists( $combiNbr, $tabCombi ) ){
                    $combi = new IdentifiantCombi;
                    
                    $prix = GestionProduit::createPrix($request, $combiNbr);
                    
                    $combi->idc_fk_prix = $prix->pri_id;
                    $combi->save();
                    
                    $tabPrix[] = $prix;
                    $tabCombi[$combiNbr] = $combi;
                } else {
                    $combi = $tabCombi[$combiNbr];
                }

                if ( !array_key_exists($propNbr, $tabProp) ) {
                    $propid = $request->input('prop_'.$propNbr.'_id');
                    $prop = GestionProduit::findOrCreateProp($request, $propNbr, $propid);
                    $tabProp[$propNbr] = $prop;
                } else {
                    $prop = $tabProp[$propNbr];
                }
                

                $car = new Caracteristique;
                $car->car_fk_produits = $prod->prod_id;
                $car->car_fk_proprietes = $prop->prop_id;
                $car->car_valeur = $value;
                
                $combi->caracteristiques()->save($car);
                
                $tabCar[] = $car;
                
            }
        }

		return redirect('produit/create')->with('error', 'Votre image ne peut pas être envoyée !');
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return Response
     */
    public function show($slugCategorie, $slugSousCategorie, $slugProduit){
        $cat = Categorie::where('cat_slug', $slugCategorie)->first();
        $sscat = SousCategorie::where('sscat_slug', $slugSousCategorie)->first();
        $produit = Produit::where('prod_slug', $slugProduit)->first();

        // augmenter nbr vue
        $produit->prod_stat = $produit->prod_stat + 1;
        $produit->save();
        

        $listePrix = array();

        foreach ($sscat->produits as $prod){
            $listePrix[$prod->prod_slug] = PrixGestion::getRangePrix($prod);
        }
        
        $form = array();

        $proprietes = $produit->caracteristiques->groupBy('car_fk_proprietes');
        
        foreach ($proprietes as $prop){
            $tmp = array();
            foreach($prop as $carac){
                $tmp[] = $carac;
            }
            $form[$prop->first()->propriete->prop_nom] = $tmp;
        }

    
        return view('produit.show', [
            'cat' => $cat,
            'sscat' => $sscat,
            'produit' => $produit,
            'listePrix' => $listePrix,
            'form' => $form
            ]);
    }

    /**
     * Get the price of product with his features.
     *
     * @return Number
     */
    public function prix(Request $request){
        //$retour = PrixGestion::getPrix($request->input('id_caract'));
        $retour = GestionProduit::getPrix($request->input('id_caract'));

        return json_encode($retour);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return Response
     */
    public function edit($id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  int  $id
     * @return Response
     */
    public function update($id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return Response
     */
    public function destroy($id)
    {
        //
    }
}
