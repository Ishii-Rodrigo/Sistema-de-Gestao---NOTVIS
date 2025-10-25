<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Product extends Model
{
    use HasFactory;

    /**
     * The attributes that are mass assignable.
     *
     * @var array<int, string>
     */
    protected $fillable = [
    'codigo', 'nome', 'descricao', 'unidade_medida', 'preco_custo', 
    'preco_venda', 'estoque_minimo', 
];
}
