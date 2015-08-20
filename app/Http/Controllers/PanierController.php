<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Http\Requests;
use App\Http\Controllers\Controller;

use App\Gestion\GestionProduit;

use DB;

class PanierController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return Response
     */
    public function index(Request $request) {
        $panier = null;
        
        if ($request->session()->has('panier')) {
            $panier = session('panier');
        }
        
        return view('panier.index', ['panier' => $panier]);
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
    public function store(Request $request) {
        
        $idCombi = GestionProduit::getIdCombi($request->input('id_caract'));
        $retour = null;
        
        if (session()->has('panier')){
            $retour = session('panier');
        }
        
        $retour[$idCombi->idc_id] = ['idCombi' => $idCombi, 'quantite' => 1];
        session(['panier' => $retour]);
        session(['taillepanier' => count($retour)]);
        
        return response()->json($idCombi);
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
     * @return redirect
     */
    public function destroy(Request $request, $id) {
        $panier = null;
        
        if (session()->has('panier')){
            $panier = session('panier');
            if ( array_key_exists ( $id , $panier ) ){
                unset($panier[$id]);
                session(['panier' => $panier]);
                session(['taillepanier' => count($panier)]);
            }
        }
        
        return redirect('panier');
    }
    
    /**
     * Remove all resources from storage.
     *
     * @return redirect
     */
    public function clear(Request $request) {
        if (session()->has('panier')){
            session()->forget('panier');
        }
        
        if (session()->has('taillepanier')){
            session()->forget('taillepanier');
        }
        
        return redirect('panier');
    }
}
