<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('vendas', function (Blueprint $table) {
            $table->id();
            
            // Relacionamentos (Chaves Estrangeiras)
            $table->foreignId('cliente_id')->constrained('clientes')->onDelete('cascade');
            // 'veiculos' deve existir. Pode ser nullable se a venda não for obrigatória para um veículo.
            $table->foreignId('veiculo_id')->nullable()->constrained('veiculos')->onDelete('set null'); 
            
            // Dados da Venda
            $table->date('data_venda');
            $table->string('status')->default('Orcamento'); // Orcamento, Aberta, Finalizada, Cancelada
            $table->string('forma_pagamento');
            
            // Totais
            $table->decimal('subtotal', 10, 2);
            $table->decimal('desconto', 10, 2)->default(0.00);
            $table->decimal('total_final', 10, 2);
            
            $table->text('observacoes')->nullable();
            
            $table->timestamps();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('vendas');
    }
};