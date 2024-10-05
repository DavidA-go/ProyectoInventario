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
        Schema::create('ventas', function (Blueprint $table) {
            $table->id();
            $table->foreignId('id_producto')->constrained('productos')->cascadeOnDelete()->cascadeOnUpdate();
            $table->foreignId('id_cliente')->constrained('clientes')->cascadeOnDelete()->cascadeOnUpdate();
            $table->String('cantidad');
            $table->String('precio_venta');
            $table->String('valor_unitario');
            $table->String('soporte_compra');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('ventas');
    }
};
