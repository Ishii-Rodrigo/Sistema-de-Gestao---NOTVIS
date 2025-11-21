<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Cliente extends Model
{
    use HasFactory;

    protected $dates = [
        'data_nascimento',
    ];
    
    protected $fillable = [
        'nome',
        'cpf_cnpj',
        'telefone',
        'telefone_celular',
        'email',
        'data_nascimento', 
        'cep',
        'rua',
        'numero',
        'bairro',
        'cidade',
        'estado',
        'complemento',
    ];
}