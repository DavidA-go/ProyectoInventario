<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Ventas extends Model
{
    use HasFactory;

    protected $fillable = ['id_producto', 'id_cliente', 'cantidad', 'precio_venta', 'valor_unitario', 'soporte_compra'];

    public function Productos(){
        return $this->belongsTo(Productos::class, 'id_producto');
    }

    public function Clientes(){
        return $this->belongsTo(Clientes::class, 'id_cliente');
    }

    protected static function boot()
    {
        parent::boot();
        static::creating(function ($venta) {
            $producto = Productos::find($venta->id_producto);
            if ($producto && $producto->cantidad >= $venta->cantidad) {
                $producto->cantidad -= $venta->cantidad;
                $producto->save();
            } else {
                throw new \Exception("No hay suficiente stock para realizar la venta.");
            }
        });
    }
}
