<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Cidade extends Model
{
    //
    protected $fillable = [
        'cidade_descricao','uf_codigo','cidade_cep',
    ];

    public function estado()
    {
        return $this->belongsTo('App\Uf', 'uf_codigo');
    }
}
