<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Amizades extends Model
{
    //
    protected $fillable = [
        'idsolicitante','idsolicitado', 'situacao',
    ];

    public function scopeSituacao($query)
    {
        return $query->where('situacao', '=', 'ativa');
    }
}
