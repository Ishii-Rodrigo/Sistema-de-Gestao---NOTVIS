<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::table('produtos', function (Blueprint $table) {
            // Adiciona a nova coluna 'estoque_atual'. DECIMAL para suportar quantidades fracionadas.
            // O padrão (default) é 0.
            $table->decimal('estoque_atual', 10, 2)->default(0)->after('estoque_minimo'); 
        });
    }

    public function down(): void
    {
        Schema::table('produtos', function (Blueprint $table) {
            $table->dropColumn('estoque_atual');
        });
    }
};