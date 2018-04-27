<?php

namespace App;
use Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Database\Eloquent\Model;

class Casaofertademanda extends Model
{
    //
    protected $fillable = [
        'iddemandador','idanuncio','graucompatibilidade','tipoanuncio','id','idofertante',
    ];


}
