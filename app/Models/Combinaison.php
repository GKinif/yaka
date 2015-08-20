<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

//use App\Models\SousCategorie;

class Combinaison extends Model{
    /**
     * The table associated with the model.
     *
     * @var string
     */
    protected $table = 'combinaisons';
    public $timestamps = false;
    public $primaryKey = null;
    public $incrementing = false;
    protected $fillable = ['com_fk_caracteristiques', 'com_fk_identifiant_combi'];

    public function identifiantCombi() {
        return $this->belongsTo('App\Models\IdentifiantCombi', 'com_fk_identifiant_combi'); // this matches the Eloquent model
    }


}