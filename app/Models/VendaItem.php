<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class VendaItem extends Model
{
    use HasFactory;
    
    // Nome da tabela (assumindo que seja 'venda_items')
    protected $table = 'venda_items'; 

    protected $fillable = [
        'venda_id',        
        'produto_id',      
        'quantidade',      
        'preco_unitario',  
        'total_item',      
    ];

    /**
     * Define o relacionamento BelongsTo com a Venda.
     */
    public function venda(): BelongsTo
    {
        return $this->belongsTo(Venda::class);
    }

    /**
     * Define o relacionamento BelongsTo com o Produto.
     */
    public function produto(): BelongsTo
    {
        return $this->belongsTo(Produto::class);
    }

    /**
     * Conversão de tipos (casting) para garantir que os valores sejam numéricos.
     */
    protected $casts = [
        'quantidade' => 'decimal:2',
        'preco_unitario' => 'decimal:2',
        'total_item' => 'decimal:2',
    ];
}