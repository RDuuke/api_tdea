<?php

namespace Api\Models;



class Client extends Model
{
    protected $table = "cliente";

    protected $fillable = [
        "nombre", "apellido", "nit", "direccion", "celular"
    ];

    public $timestamps = false;

}