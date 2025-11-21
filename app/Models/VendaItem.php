<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class VendaItem extends Model
{
    use HasFactory;
    
    protected $table = 'venda_items'; 

    protected $fillable = [
        'venda_id',        
        'produto_id',      
        'quantidade',      
        'preco_unitario',  
        'total_item',      
    ];

    public function venda(): BelongsTo
    {
        return $this->belongsTo(Venda::class);
    }

    public function produto(): BelongsTo
    {
        return $this->belongsTo(Produto::class);
    }

    protected $casts = [
        'quantidade' => 'decimal:2',
        'preco_unitario' => 'decimal:2',
        'total_item' => 'decimal:2',
    ];
}