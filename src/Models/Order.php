<?php

namespace Api\Models;


class Order extends Model
{
    protected $table = "pedido";

    protected $fillable = [
      "iva", "valor", "direccion", "valor_total", "celular", "observaciones", "estado", "usuario_id"
    ];

    public $timestamps = false;

    public function details()
    {
        return $this->hasMany(OrderDetails::class, "pedido_id", "id");
    }
}