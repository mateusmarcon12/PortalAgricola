<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Demanda extends Model
{
    //
    protected $fillable = [
        'titulo', 'descricao', 'classe','datavalidade','observacao','situacao','idanunciante','fotos','tipo','idendereco','tipoanuncio',
    ];
}
