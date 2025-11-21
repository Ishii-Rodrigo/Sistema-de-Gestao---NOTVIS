<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;

class Venda extends Model
{
    use HasFactory;

    /**
     * * @var array<int, string>
     */
    protected $fillable = [
        'cliente_id',
        'veiculo_id',
        'data_venda',
        'status',
        'forma_pagamento',
        'desconto',
        'observacoes',
        'subtotal',      
        'total_final',
    ];

    public function cliente(): BelongsTo
    {
        return $this->belongsTo(Cliente::class);
    }

    public function veiculo(): BelongsTo
    {
        return $this->belongsTo(Veiculo::class);
    }

    public function itens(): HasMany
    {
        return $this->hasMany(VendaItem::class);
    }
    
    protected $casts = [
        'data_venda' => 'date', 
        'subtotal' => 'decimal:2',
        'total_final' => 'decimal:2',
        'desconto' => 'decimal:2',
    ];
}
