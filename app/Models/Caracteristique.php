<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

//use App\Models\SousCategorie;

class Caracteristique extends Model{
    /**
     * The table associated with the model.
     *
     * @var string
     */
    protected $table = 'caracteristiques';
    public $timestamps = false;
    public $primaryKey = 'car_id';
    protected $guarded = ['car_id'];

    public function produit() {
        return $this->belongsTo('App\Models\Produit', 'car_fk_produits'); // this matches the Eloquent model
    }

    public function propriete() {
        return $this->belongsTo('App\Models\Propriete', 'car_fk_proprietes'); // this matches the Eloquent model
    }

    public function identifiantCombis() {
         return $this->belongsToMany('App\Models\IdentifiantCombi', 'combinaisons', 'com_fk_caracteristiques', 'com_fk_identifiant_combi');
    
    }
}