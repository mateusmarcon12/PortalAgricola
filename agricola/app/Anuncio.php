<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Auth;
class Anuncio extends Model
{
    //
    protected $fillable = [
        'titulo', 'descricao', 'classe','datavalidade','observacao','situacao','idanunciante','fotos','tipo','idendereco','tipoanuncio','quantidade','unidademedida',
    ];

    public function scopeTipooferta ($query)
    {
        return $query->where('tipoanuncio', '=', 'oferta');
    }
    public function scopeSituacao($query)
    {
        return $query->where('situacao', '=', 'ativo');
    }

    public function scopeAnunciante($query)
    {
        return $query->where('idanunciante', '!=', Auth::user()->id);
    }
    public function scopeMeusanuncios($query)
    {
        return $query->where('idanunciante', '=', Auth::user()->id);
    }
    public function scopeTipodemanda ($query)
    {
        return $query->where('tipoanuncio', '=', 'demanda');
    }

}
