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
        Schema::create('tareas', function (Blueprint $table) {
            $table->id();
            $table->string('titulo');               // Requisito: String
            $table->text('descripcion')->nullable(); // Requisito: Texto largo
            $table->boolean('completada')->default(false); // Requisito: Booleano
            $table->date('fecha_limite');           // Requisito: Fecha
            $table->integer('prioridad')->default(1); // Requisito: Entero (1=Baja, 2=Alta)
            $table->foreignId('user_id')->constrained()->onDelete('cascade'); // Importante: Relación con Usuario
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('tareas');
    }
};
