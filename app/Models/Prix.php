<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

//use App\Models\SousCategorie;

class Prix extends Model{
    /**
     * The table associated with the model.
     *
     * @var string
     */
    protected $table = 'prix';
    public $timestamps = false;
    public $primaryKey = 'pri_id';
    protected $guarded = ['pri_id'];

    public function identifiantcombis() {
        return $this->hasMany('App\Models\IdentifiantCombi', 'idc_fk_prix'); // this matches the Eloquent model
    }
}