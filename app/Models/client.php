<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

//use App\Models\SousCategorie;

class Client extends Model{
    /**
     * The table associated with the model.
     *
     * @var string
     */
    protected $table = 'clients';
    public $timestamps = false;
    public $primaryKey = 'cli_id';
    protected $guarded = ['cli_id']; 
}