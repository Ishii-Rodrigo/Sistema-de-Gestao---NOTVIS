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
     * Os atributos que podem ser atribuídos em massa (mass assignable).
     * Inclui campos usados no formulário e calculados.
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
        'subtotal',      // Campo para armazenar o subtotal dos itens
        'total_final',   // Campo para armazenar o valor final após descontos
    ];

    /**
     * Define o relacionamento BelongsTo com o Cliente.
     * Uma venda pertence a um cliente.
     */
    public function cliente(): BelongsTo
    {
        // Assumindo que o foreign key é 'cliente_id'
        return $this->belongsTo(Cliente::class);
    }

    /**
     * Define o relacionamento BelongsTo com o Veiculo.
     * Uma venda pode estar associada a um veículo (opcional).
     */
    public function veiculo(): BelongsTo
    {
        // Assumindo que o foreign key é 'veiculo_id'
        return $this->belongsTo(Veiculo::class);
    }

    /**
     * Define o relacionamento HasMany com os Itens da Venda.
     * Uma venda tem muitos itens.
     */
    public function itens(): HasMany
    {
        // Assumindo que o Model para os itens é VendaItem
        return $this->hasMany(VendaItem::class);
    }
    
    // Opcional: Para usar o campo 'data_venda' como Carbon object (para casos em que created_at não é usado)
    protected $casts = [
        'data_venda' => 'date', 
        'subtotal' => 'decimal:2',
        'total_final' => 'decimal:2',
        'desconto' => 'decimal:2',
    ];
}

// ** NOTA IMPORTANTE **
// Para que o código funcione corretamente, você também precisará:
// 1. Criar o Model VendaItem (com campos: venda_id, produto_id, quantidade, preco_unitario).
// 2. Criar a Migração da tabela 'vendas' com todos os campos em $fillable.