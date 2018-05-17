<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Negociacao extends Model
{
    //
    protected $fillable = [
        'idanuncio1','idanuncio2','resultado','situacao',
    ];

    public function scopeSituacao($query)
    {
        return $query->where('situacao', '=', 'ativa');
    }
}
