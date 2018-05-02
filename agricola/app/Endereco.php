<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Auth;


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

    public function scopeMeuendereco($query)
    {
        return $query->where('id','=', Auth::user()->idend)->join('cidades','cidades.cidade_codigo','=','enderecos.idcidade')->join('ufs','ufs.uf_codigo','=','enderecos.iduf')->join('paises','paises.numcode','=','enderecos.idpais');
    }
}
