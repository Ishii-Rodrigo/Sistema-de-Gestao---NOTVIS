<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Produto extends Model
{
    use HasFactory;
    
    protected $table = 'produtos'; 

    /**
     * @var array<int, string>
     */
    protected $fillable = [
        'nome',
        'descricao',
        'unidade_medida',
        'preco_custo',
        'preco_venda',
        'estoque_minimo',
        'estoque_atual', 
    ];

    public function getCodigoAttribute(): string
    {
        return str_pad($this->attributes['id'], 3, '0', STR_PAD_LEFT);
    }
    
    protected $casts = [
        'preco_custo' => 'decimal:2',
        'preco_venda' => 'decimal:2',
        'estoque_minimo' => 'float',
        'estoque_atual' => 'float',
    ];
}