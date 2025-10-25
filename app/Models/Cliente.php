<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Cliente extends Model
{
    use HasFactory;

    /**
     * Os atributos que são atribuíveis em massa.
     * Inclui todos os campos pessoais e os campos de endereço separados.
     */
    protected $fillable = [
        'nome',
        'cpf_cnpj',
        'telefone',
        'email',
        // Campos de Endereço
        'cep',
        'rua',
        'numero',
        'bairro',
        'cidade',
        'estado',
        'complemento',
    ];
}
