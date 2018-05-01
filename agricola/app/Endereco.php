<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Endereco extends Model
{
    //
    protected $fillable = [
        'pais','uf','cidade','bairro','rua','numero','observacao',
    ];

    public function Anuncio()
    {
        return $this->belongsTo('App\Anuncio', 'idendereco');
    }
}
