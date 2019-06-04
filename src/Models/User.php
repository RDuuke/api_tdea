<?php
namespace Api\Models;

class User extends Model
{
    protected $table = "usuario";

    protected $fillable = [
        "usuario", "clave", "perfil"
    ];

    public $timestamps = false;

}