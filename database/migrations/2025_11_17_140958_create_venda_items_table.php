<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Executa as migrações (Cria a tabela).
     */
    public function up(): void
    {
        // 1. Criação da tabela 'venda_items'
        Schema::create('venda_items', function (Blueprint $table) {
            $table->id();

            // 2. Chave Estrangeira para Venda (Relacionamento: BelongsTo Venda)
            // Foreign Key: 'venda_id'
            $table->foreignId('venda_id')
                  ->constrained('vendas') // Faz referência à tabela 'vendas'
                  ->onDelete('cascade'); // Se a venda for deletada, seus itens também são.

            // 3. Chave Estrangeira para Produto (Relacionamento: BelongsTo Produto)
            // Foreign Key: 'produto_id'
            $table->foreignId('produto_id')
                  ->constrained('produtos') // Faz referência à tabela 'produtos'
                  ->onDelete('restrict'); // Impede a exclusão do produto se houver itens de venda vinculados.

            // 4. Campos de Dados do Item
            // A precisão (8, 2) suporta até 999.999,99
            $table->decimal('quantidade', 8, 2); 
            // A precisão (10, 2) suporta até 99.999.999,99 (Preço na hora da venda)
            $table->decimal('preco_unitario', 10, 2); 
            // Total do item (quantidade * preco_unitario)
            $table->decimal('total_item', 10, 2); 
            
            // 5. Timestamps
            $table->timestamps();
        });
    }

    /**
     * Reverte as migrações (Deleta a tabela).
     */
    public function down(): void
    {
        Schema::dropIfExists('venda_items');
    }
};