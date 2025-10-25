<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Produto extends Model
{
    use HasFactory;
    
    // O nome da tabela deve ser 'products' para corresponder à sua migração.
    protected $table = 'products'; 

    /**
     * Os atributos que podem ser preenchidos em massa.
     * 'codigo' foi removido, pois será gerado automaticamente (usando o ID).
     *
     * @var array<int, string>
     */
    protected $fillable = [
        // 'codigo', foi removido daqui
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
     * Exemplo: Se o ID for 5, ele retornará "005".
     * Se o ID for 120, ele retornará "120".
     */
    public function getCodigoAttribute()
    {
        // str_pad($this->id, 3, '0', STR_PAD_LEFT) formata o ID para ter 
        // no mínimo 3 dígitos, preenchendo com '0' à esquerda.
        return str_pad($this->attributes['id'], 3, '0', STR_PAD_LEFT);
    }
}
