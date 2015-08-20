<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Http\Requests;
use App\Http\Controllers\Controller;

use DB;

use App\Models\Categorie;
use App\Models\SousCategorie;
use App\Models\Produit;
use App\Gestion\PrixGestion;

class SearchController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return Response
     */
    public function index(Request $request) {
        $query = $request->input('query');
        
        //DB::enableQueryLog();
        $produits = Produit::join('sous_categories', 'sscat_id', '=', 'prod_fk_sous_categories')
                            ->where('prod_nom', 'ilike', "%$query%")
                            ->orWhere('sscat_nom', 'ilike', "%$query%")
                            ->get();
        //print_r(DB::getQueryLog());
        
        
        $listePrix = array();

        foreach ($produits as $prod){
            $listePrix[$prod->prod_slug] = PrixGestion::getRangePrix($prod);
        }
        
        return view('search.index', [
            'produits' => $produits,
            'listePrix' => $listePrix,
            ]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @return Response
     */
    public function store()
    {
        //
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return Response
     */
    public function show($id)
    {
        //
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
