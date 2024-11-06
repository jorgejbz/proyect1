<?php

namespace App\Models;

//use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use MongoDB\Laravel\Auth\User as Authenticatable;
use MongoDB\Laravel\Eloquent\Model as Model;

class User extends Authenticatable
{
    use HasFactory;

    // Definir el guard si es necesario (como en admin)
    protected $guard = 'user';

    // Los campos que pueden ser llenados (asignación masiva)
    // Campos que se pueden llenar masivamente
    protected $fillable = [
        'code',
        'name',
        'email',
        'type',
        'position',
        'password',
        'status'
    ];

    // Ocultar los campos sensibles
    protected $hidden = [
        'password',
        'remember_token',
    ];

    // Casts para tipos de datos específicos
    protected $casts = [
        'email_verified_at' => 'datetime',
    ];
}
