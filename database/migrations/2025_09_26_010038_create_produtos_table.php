<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::create('products', function (Blueprint $table) {
            $table->id(); // Este campo é o sequencial automático (1, 2, 3...)
            
            // REMOVIDO: $table->string('codigo')->unique(); // O ID fará este papel
            
            // Campos restantes
            $table->string('nome');            // Nome
            $table->text('descricao')->nullable(); // Descrição
            $table->string('unidade_medida', 10); // Unidade de Medida (UN, PC, etc.)
            $table->decimal('preco_custo', 10, 2); // Preço de Custo
            $table->decimal('preco_venda', 10, 2); // Preço de Venda
            $table->integer('estoque_minimo')->default(0); // Estoque Mínimo

            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('products');
    }
};