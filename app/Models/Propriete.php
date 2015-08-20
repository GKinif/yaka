<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

//use App\Models\SousCategorie;

class Propriete extends Model{
    /**
     * The table associated with the model.
     *
     * @var string
     */
    protected $table = 'proprietes';
    public $timestamps = false;
    public $primaryKey = 'prop_id';
    protected $fillable = ['prop_nom'];

    public function caracteristiques() {
        return $this->hasMany('App\Models\Caracteristique', 'car_fk_proprietes'); // this matches the Eloquent model
    }

    // public function produits() {
    //     return $this->belongsToMany('App\Models\Produit', 'caracteristiques', 'car_fk_produits', 'car_fk_proprietes')
    //                 ->withPivot('car_valeur');
    // }
}