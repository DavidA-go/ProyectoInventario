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
        Schema::create('compras', function (Blueprint $table) {
            $table->id();
            $table->foreignId('id_producto')->constrained('productos')->cascadeOnDelete()->cascadeOnUpdate();
            $table->foreignId('id_proveedor')->constrained('proveedores')->cascadeOnDelete()->cascadeOnUpdate();
            $table->integer('cantidad');
            $table->String('soporte_compra');
            $table->integer('precio_compra');
            $table->integer('valor_unitario');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('compras');
    }
};
