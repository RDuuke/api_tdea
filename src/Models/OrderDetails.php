<?php

namespace Api\Models;


class OrderDetails extends Model
{
    protected $table = "detalle_pedido";

    protected $fillable = [
      "pedido_id", "producto_codigo", "cantidad"
    ];

    public $timestamps = false;

}