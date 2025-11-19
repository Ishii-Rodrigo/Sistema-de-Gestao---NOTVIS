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
        Schema::table('veiculos', function (Blueprint $table) {
            // Aumenta o tamanho da coluna 'placa' para 9 para armazenar LLL-XXXX (8 caracteres)
            $table->string('placa', 9)->change(); 
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('veiculos', function (Blueprint $table) {
            // Retorna ao tamanho anterior (por exemplo, 7)
            $table->string('placa', 7)->change(); 
        });
    }
};