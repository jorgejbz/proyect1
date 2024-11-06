<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Mongodb\Laravel\Eloquent\Model as Eloquent; // Usa Jenssegers MongoDB
use MongoDB\Laravel\Eloquent\Model as Model;

class Job extends Eloquent
{
    use HasFactory;

    // Define la colección asociada al modelo
    protected $collection = 'jobs';

    // Define los campos que pueden ser llenados masivamente
    protected $fillable = [
        'state',        // Estado del LED (encendido o apagado)
        'timestamp',    // Marca de tiempo de cuando se cambió el estado
    ];

    // Si no estás utilizando created_at o updated_at
    public $timestamps = false;
}
