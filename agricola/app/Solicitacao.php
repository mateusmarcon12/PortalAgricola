<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Solicitacao extends Model
{
    //solicitacao de amizade
    protected $fillable = [
        'idsolicitante','idsolicitado','situacao',
    ];
}
