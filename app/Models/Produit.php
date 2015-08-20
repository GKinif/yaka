<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

use App\Models\Combinaison;

class Produit extends Model{
    /**
     * The table associated with the model.
     *
     * @var string
     */
    protected $table = 'produits';
    public $timestamps = false;
    public $primaryKey = 'prod_id';
    protected $guarded = ['prod_id', 'prod_stat'];

    public function sscat() {
        return $this->belongsTo('App\Models\SousCategorie', 'prod_fk_sous_categories'); // this matches the Eloquent model
    }

    public function caracteristiques() {
        return $this->hasMany('App\Models\Caracteristique', 'car_fk_produits'); // this matches the Eloquent model
    }

}