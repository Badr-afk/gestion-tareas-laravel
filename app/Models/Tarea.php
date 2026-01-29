<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Tarea extends Model
{
    // Permitimos guardar estos datos de golpe
    protected $fillable = [
        'titulo', 
        'descripcion', 
        'completada', 
        'fecha_limite', 
        'prioridad', 
        'user_id'
    ];
}