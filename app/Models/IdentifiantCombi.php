<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

//use App\Models\SousCategorie;

class IdentifiantCombi extends Model{
    /**
     * The table associated with the model.
     *
     * @var string
     */
    protected $table = 'identifiant_combi';
    public $timestamps = false;
    public $primaryKey = 'idc_id';
    protected $fillable = ['idc_fk_prix'];

    /*public function caracteristiques() {
        return $this->belongsToMany(
            'App\Models\Caracteristique',
            'combinaisons',
            'com_fk_caracteristiques',
            'com_fk_identifiant_combi'
            );
    }*/
    
    public function caracteristiques() {
        return $this->belongsToMany(
            'App\Models\Caracteristique',
            'combinaisons',
            'com_fk_identifiant_combi',
            'com_fk_caracteristiques'
            );
    }

    public function prix() {
        return $this->belongsTo('App\Models\Prix', 'idc_fk_prix'); // this matches the Eloquent model
    }
    
    public function commandes() {
        return $this->belongsToMany(
            'App\Models\Commande',
            'lignes_commande',
            'lig_fk_identifiant_combi',
            'lig_fk_commandes'
            );
    }
}