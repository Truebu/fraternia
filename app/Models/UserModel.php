<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class UserModel extends Model
{
    protected $table='usuario';

    protected $fillable = [
        'usuarioNombre',
        'usuarioEmail',
        'usuarioTelefonoPrincipal',
        'usuarioContraseña',
        'fk_universidadId'
    ];

    protected $hidden=[
        'created_at','updated_at'
    ];
}
