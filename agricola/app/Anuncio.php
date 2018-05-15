<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Auth;
use Illuminate\Support\Facades\DB;
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


    public function scopeSelecionaum($query, $anuncio){

        $detanuncio = Anuncio
            ::join('users', 'users.id','=','anuncios.idanunciante')
            ->join('categorias', 'categorias.id','=','anuncios.classe')
            ->join('classificacaos', 'classificacaos.id','=', 'anuncios.tipo')
            ->join('enderecos', 'enderecos.id','=','anuncios.idendereco')
            ->join('cidades','cidades.cidade_codigo','=','enderecos.idcidade')
            ->join('ufs','ufs.uf_codigo','=','enderecos.iduf')
            ->join('paises','paises.numcode','=','enderecos.idpais')
            ->select('anuncios.observacao as a','anuncios.id as ida', 'anuncios.situacao as anusituacao','anuncios.titulo as titulo', 'anuncios.*',
                'users.name as anunciante','users.email','categorias.nome as categoria',
                'classificacaos.nome as classificacao','enderecos.*','cidades.cidade_cep','cidades.cidade_descricao as cidade',
                'ufs.uf_descricao as estado','paises.nome as pais','enderecos.idcidade as idcidade','enderecos.iduf as iduf',
                'enderecos.observacao as endobservacao')
            ->where('anuncios.id','=',$anuncio->id);
           // ->get();

        return ($detanuncio);


    }
//Para usuários não logados
    public function scopeRetornatodos ($query)
    {
        $detanuncio = Anuncio
            ::join('users', 'users.id','=','anuncios.idanunciante')
            ->join('categorias', 'categorias.id','=','anuncios.classe')
            ->join('classificacaos', 'classificacaos.id','=', 'anuncios.tipo')
            ->join('enderecos', 'enderecos.id','=','anuncios.idendereco')
            ->join('cidades','cidades.cidade_codigo','=','enderecos.idcidade')
            ->join('ufs','ufs.uf_codigo','=','enderecos.iduf')
            ->join('paises','paises.numcode','=','enderecos.idpais')
            ->select('anuncios.observacao as a','anuncios.id as ida', 'anuncios.situacao as anusituacao', 'anuncios.*',
                'users.name as anunciante','categorias.nome as categoria',
                'classificacaos.nome as classificacao')
            ->where('anuncios.situacao','=','ativo');
    

        return ($detanuncio);

    }



    public function endereco()
    {
        return $this->hasOne('App\Endereco', 'idendereco');
    }

}
