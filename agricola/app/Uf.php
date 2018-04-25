<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Uf extends Model
{
    //
    protected $fillable = [
        'uf_descricao','uf_sigla','uf_sigla',
    ];

    public function cidades()
    {
        return $this->hasMany('App\Cidade','uf_codigo');
    }
}
