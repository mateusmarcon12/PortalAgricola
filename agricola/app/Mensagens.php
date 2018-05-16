<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Mensagens extends Model
{
    //
        protected $fillable = [
        'idconversa','idremetente','mensagens',
    ];
}
