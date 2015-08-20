<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

//use App\Models\Categorie;

class SousCategorie extends Model{
    /**
     * The table associated with the model.
     *
     * @var string
     */
    protected $table = 'sous_categories';
    public $timestamps = false;
    public $primaryKey = 'sscat_id';
    protected $fillable = ['sscat_nom', 'sscat_fk_categories'];

    public function categorie() {
        return $this->belongsTo('App\Models\Categorie', 'sscat_fk_categories'); // this matches the Eloquent model
    }

    public function produits() {
        return $this->hasMany('App\Models\Produit', 'prod_fk_sous_categories'); // this matches the Eloquent model
    }
}