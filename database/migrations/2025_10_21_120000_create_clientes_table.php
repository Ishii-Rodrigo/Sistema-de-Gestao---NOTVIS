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
        // Esta migration DEVE CRIAR a tabela 'clientes'.
        // Se ela estava com 'Schema::table', isso causava o erro.
        Schema::create('clientes', function (Blueprint $table) {
            $table->id();
            
            // Campos Principais
            $table->string('nome');            // Nome/Razão Social
            $table->string('cpf_cnpj', 20)->unique()->nullable(); // CPF/CNPJ
            $table->string('telefone', 20)->nullable(); // Telefone
            $table->string('email')->unique()->nullable(); // E-mail
            
            // Campos de Endereço (utilizados no Model Cliente)
            $table->string('cep', 10)->nullable();
            $table->string('rua')->nullable();
            $table->string('numero', 20)->nullable();
            $table->string('bairro')->nullable();
            $table->string('cidade')->nullable();
            $table->string('estado', 2)->nullable();
            $table->string('complemento')->nullable();
            
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('clientes');
    }
};
