<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Mongodb\Laravel\Eloquent\Model as Eloquent; // Usa Jenssegers MongoDB
use MongoDB\Laravel\Eloquent\Model as Model;
class Alert extends Model
{
    use HasFactory;

     // Define la colección asociada al modelo
     protected $collection = 'failed_jobs'; // Asegúrate de que apunte a 'failed_jobs'

     // Define los campos que pueden ser llenados masivamente
     protected $fillable = [
         'state',        // Estado de la alerta (encendido o apagado)
         'timestamp',    // Marca de tiempo de cuando se cambió el estado
     ];
 
     // Indica que no necesitas los campos por defecto de timestamps de Laravel
     public $timestamps = false;
 
     // Define el tipo de dato para el timestamp
     protected $casts = [
         'timestamp' => 'datetime', // Para guardar el timestamp como datetime
     ];
}
