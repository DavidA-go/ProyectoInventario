<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Compras extends Model
{
    use HasFactory;

    protected $fillable = ['id_producto', 'id_proveedor', 'cantidad', 'soporte_compra', 'precio_compra', 'valor_unitario'];

    public function Productos(){
        return $this->belongsTo(Productos::class, 'id_producto');
    }

    public function Proveedores(){
        return $this->belongsTo(Proveedores::class, 'id_proveedor');
    }

    protected static function boot()
    {
        parent::boot();

        // Antes de crear un registro de compra, actualiza la cantidad del producto y calcula el precio de la compra
        static::creating(function ($compra) {
            // Calcula el precio_compra multiplicando la cantidad por el valor unitario
            $compra->precio_compra = $compra->cantidad * $compra->valor_unitario;

            // Busca el producto correspondiente
            $producto = Productos::find($compra->id_producto);
            
            // Si el producto existe, actualiza su cantidad sumando la cantidad comprada
            if ($producto) {
                $producto->cantidad += $compra->cantidad;
                $producto->save();
            }
        });
    }
}
