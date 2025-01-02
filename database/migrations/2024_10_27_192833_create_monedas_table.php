<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;
use App\Models\User;
use Illuminate\Database\Eloquent\Relations\BelongsTo;


return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::create('monedas', function (Blueprint $table) {
            $table->id();
            $table->string('nombre');
            $table->text('descripcion')->nullable();
            $table->string('foto_frontal')->nullable(); // Para almacenar la ruta de la imagen frontal
            $table->string('foto_trasera')->nullable(); // Para almacenar la ruta de la imagen trasera
            $table->integer('anio'); // Año de emisión
            $table->string('pais'); // País de origen
            $table->string('material'); // País de origen
            $table->string('estado')->nullable(); // Condición física de la moneda
            $table->decimal('valor_comprado', 10, 2)->nullable(); // Valor de compra
            $table->decimal('valor_venta_sugerido', 10, 2)->nullable(); // Valor de venta sugerido
            $table->foreignId('user_id')->constrained()->onDelete('cascade'); // Relación con la tabla users
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('monedas');
    }

    
};
