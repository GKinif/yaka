<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Commande extends Model{
    /**
     * The table associated with the model.
     *
     * @var string
     */
    protected $table = 'commandes';
    public $timestamps = false;
    public $primaryKey = 'com_id';
    protected $fillable = ['com_date', 'com_facture', 'com_fk_clients'];

    public function idCombis() {
        return $this->belongsToMany(
            'App\Models\IdentifiantCombi',
            'lignes_commande',
            'lig_fk_commandes',
            'lig_fk_identifiant_combi'
            );
    }

    public function client() {
        return $this->belongsTo('App\User', 'com_fk_clients'); // this matches the Eloquent model
    }
}