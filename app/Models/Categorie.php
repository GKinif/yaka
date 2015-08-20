<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

//use App\Models\SousCategorie;

class Categorie extends Model{
    /**
     * The table associated with the model.
     *
     * @var string
     */
    protected $table = 'categories';
    public $timestamps = false;
    public $primaryKey = 'cat_id';
    protected $fillable = ['cat_nom'];

    public function sscats() {
        return $this->hasMany('App\Models\SousCategorie', 'sscat_fk_categories'); // this matches the Eloquent model
    }

    
}