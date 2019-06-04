<?php

namespace Api\Models;


class Product extends Model
{
    protected $table = "producto";

    protected $fillable = [
        "nombre", "imagen", "precio", "codigo"
    ];

    public $timestamps = false;

}