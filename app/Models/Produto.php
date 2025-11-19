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
        // ➡️ ADICIONADO: Necessário para permitir updates e criação via controller
        'estoque_atual', 
    ];

    /**
     * Define um Acessor para o atributo 'codigo'.
     */
    public function getCodigoAttribute(): string
    {
        return str_pad($this->attributes['id'], 3, '0', STR_PAD_LEFT);
    }
    
    /**
     * Conversão de tipos (casting) para valores numéricos.
     */
    protected $casts = [
        'preco_custo' => 'decimal:2',
        'preco_venda' => 'decimal:2',
        'estoque_minimo' => 'float',
        'estoque_atual' => 'float', // ➡️ ADICIONADO: Garantir que aceite decimais
    ];
}