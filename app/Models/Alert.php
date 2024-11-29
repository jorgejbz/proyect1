<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Jenssegers\Mongodb\Eloquent\Model; // Usa Jenssegers MongoDB directamente

class Alert extends Model
{
    use HasFactory;

    // Define la colección asociada al modelo
    protected $collection = 'alerts'; // Cambia 'alerts' según tu colección

    // Define los campos que pueden ser llenados masivamente
    protected $fillable = [
        'state',        // Estado de la alerta (encendido o apagado)
        'timestamp',    // Marca de tiempo de cuando se cambió el estado
    ];

    // Desactiva los timestamps automáticos si no los usas
    public $timestamps = false;
}
