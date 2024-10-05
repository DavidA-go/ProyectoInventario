<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Productos extends Model
{
    use HasFactory;

    protected $fillable = ['nombre', 'cantidad', 'descripcion', 'precio_compra', 'precio_venta', 'stock'];

    protected static function boot()
    {
        parent::boot();

        // Antes de crear un nuevo registro, asegura que 'stock' tenga un valor por defecto de 0
        static::creating(function ($producto) {
            if (is_null($producto->cantidad)) {
                $producto->cantidad = 0;
            }
        });
    }

    public function Proveedores()
    {
        return $this->belongsToMany(Proveedores::class, 'compras');
    }
    public function Clientes()
    {
        return $this->belongsToMany(Clientes::class, 'ventas');
    }
}
