<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Produto extends Model
{
    use HasFactory;
    
    // CORREÇÃO: Alinhando o nome da tabela com sua migration.
    protected $table = 'produtos'; 

    /**
     * Os atributos que podem ser preenchidos em massa.
     *
     * @var array<int, string>
     */
    protected $fillable = [
        'nome',
        'descricao',
        'unidade_medida',
        'preco_custo',
        'preco_venda',
        'estoque_minimo',
    ];

    /**
     * Define um Acessor para o atributo 'codigo'.
     * Permite acessar o ID auto-incrementado como 'codigo', formatado com zeros à esquerda.
     */
    public function getCodigoAttribute()
    {
        // str_pad($this->id, 3, '0', STR_PAD_LEFT) formata o ID para ter 
        // no mínimo 3 dígitos, preenchendo com '0' à esquerda.
        return str_pad($this->attributes['id'], 3, '0', STR_PAD_LEFT);
    }
}