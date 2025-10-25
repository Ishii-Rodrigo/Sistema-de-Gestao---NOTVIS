<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Veiculo extends Model
{
    use HasFactory;

    protected $fillable = [
        'placa',
        'marca',
        'modelo',
        'ano',
        'cor',
        'cliente_id',
    ];

    /**
     * Define o relacionamento: Um Veículo pertence a um Cliente.
     */
    public function cliente()
    {
        // Garante que o Veículo está relacionado ao Cliente
        return $this->belongsTo(Cliente::class);
    }
}
