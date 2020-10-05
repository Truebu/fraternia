<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class PostModel extends Model
{
    protected $table='publicacion';

    protected $fillable = [
        'publicacionTitulo',
        'pubpublicacionDescripcion',
        'fk_tipoPublicacionId',
        'fk_usuarioId',
        'publicacionFechaCreacion'
    ];

    protected $hidden=[
        'created_at','updated_at'
    ];
}
