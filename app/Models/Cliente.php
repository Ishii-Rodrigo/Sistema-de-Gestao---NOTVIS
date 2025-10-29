<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Cliente extends Model
{
    use HasFactory;

    /**
     * Os atributos que devem ser convertidos para objetos Carbon.
     */
    protected $dates = [
        'data_nascimento', // Garante tratamento correto do formato de data
    ];
    
    /**
     * Os atributos que são atribuíveis em massa.
     */
    protected $fillable = [
        'nome',
        'cpf_cnpj',
        'telefone',
        'telefone_celular', // NOVO CAMPO
        'email',
        'data_nascimento', // NOVO CAMPO
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