<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Oferta extends Model
{
    //
    protected $fillable = [
        'titulo', 'descricao', 'classe','datavalidade','observacao','situacao','idanunciante','fotos','tipo','idendereco'
    ];
}
