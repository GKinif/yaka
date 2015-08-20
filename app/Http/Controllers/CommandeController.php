<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Http\Requests;
use App\Http\Controllers\Controller;

use App\Models\Commande;
use App\Models\IdentifiantCombi;

use Carbon\Carbon;
use Auth;


class CommandeController extends Controller {
    /**
     * Display a listing of the resource.
     *
     * @return Response
     */
    public function index(Request $request) {
        $user = Auth::user();
        
        $commandes = Commande::where('com_fk_clients', $user->id)->get();
        $commandesPrix = array();
        
        foreach ($commandes as $commande) {
            $prix = 0;
            foreach ($commande->idCombis as $idCombi){
                $prix += $idCombi->prix->pri_htva_euro;
            }
            $commandesPrix[$commande->com_id] = $prix;
        }
        
        return view( 'commande.index', [
            'commandes' => $commandes,
            'commandesPrix' => $commandesPrix
            ] );
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return Response
     */
    public function create(Request $request) {
        $panier = null;
        
        if ($request->session()->has('panier')) {
            $panier = session('panier');
        }
        
        return view('commande.create', ['panier' => $panier]);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @return Response
     */
    public function store(Request $request) {
        
        $commande = new Commande;
        
        $commande->com_date = Carbon::now();
        $user = $request->user();
        
        $commande->com_fk_clients = $user->id;
        
        $commande->save();
        
        foreach ($request->all() as $id => $qte) {
            if ($id != '_token'){
                $ligneActuel = IdentifiantCombi::find($id);
                $ligneActuel->commandes()->attach($commande->com_id, ['lig_quantite' => $qte ]);
            } 
        }
        
        $request->session()->forget('panier');
        $request->session()->forget('taillepanier');
        
        return redirect('commande');
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
