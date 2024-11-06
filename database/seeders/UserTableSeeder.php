<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;
use App\Models\User;
//use Carbon\Carbon; // Para manejar las fechas


class UserTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        // Hashear la contraseña
        $password = Hash::make('password1234');

        // Datos del usuario a insertar
        $userRecords = [
            [
                'code'=>'1234567999', //codigo de usuario
                'name' => 'Jorge prueba', // Nombre del usuario
                'type' => 'user', //usuario NORMAL, NO ADMIN
                'position' => 'Patronazo',            //PUESTO EN LA EMPRESA
                'email' => 'jorgejb2345@gmail.com',   // Correo único del usuario
                'password' => $password,         // Contraseña hasheada
                'status' => 1,                   // 1 para activo, 0 para inactivo
                
            ],
        ];

        // Insertar los registros en la base de datos
        User::insert($userRecords);
    }
}
