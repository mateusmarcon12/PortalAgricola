<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class avaliacao extends Model
{
    //
    protected $fillable = [
        'nota','comentario','media','idavaliador','idavaliado',
    ];

}
