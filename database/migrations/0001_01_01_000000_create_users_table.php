<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        // Crear la tabla 'users'
        Schema::create('users', function (Blueprint $table) {
            $table->id(); // Crea un campo de clave primaria con auto-incremento
            $table->string('code'); //codigo de usuario
            $table->string('name'); // Campo 'name' de tipo string para almacenar el nombre del usuario
            $table->string('email')->unique(); // Campo 'email' de tipo string, con restricción de único (no se pueden repetir valores)
            //$table->timestamp('email_verified_at')->nullable(); // Campo de tipo timestamp para almacenar la fecha de verificación de email, puede ser null
            $table->string('position'); //puesto del usuario
            $table->string('password'); // Campo 'password' de tipo string para almacenar la contraseña del usuario
            //$table->rememberToken(); // Campo para almacenar un token de "remember me" para sesiones
            $table->tinyInteger('status'); //es un status de 1 y 0 para usuarios activos o inactivos
            $table->timestamps(); // Crea los campos 'created_at' y 'updated_at' para registrar las fechas de creación y actualización del registro
        });
    
        // Crear la tabla 'password_reset_tokens' para almacenar los tokens de restablecimiento de contraseñas
        Schema::create('password_reset_tokens', function (Blueprint $table) {
            $table->string('email')->primary(); // El campo 'email' actúa como clave primaria en esta tabla
            $table->string('token'); // Campo 'token' para almacenar el token de restablecimiento de contraseña
            $table->timestamp('created_at')->nullable(); // Campo 'created_at' para registrar cuándo se generó el token, puede ser null
        });
    
        // Crear la tabla 'sessions' para almacenar las sesiones de los usuarios
        Schema::create('sessions', function (Blueprint $table) {
            $table->string('id')->primary(); // El campo 'id' es la clave primaria, que identifica la sesión
            $table->foreignId('user_id')->nullable()->index(); // El campo 'user_id' es una clave foránea opcional que apunta al ID del usuario, se indexa para mejorar las consultas
            $table->string('ip_address', 45)->nullable(); // Campo 'ip_address' para almacenar la IP del usuario, puede ser null, admite hasta 45 caracteres (para compatibilidad con IPv6)
            $table->text('user_agent')->nullable(); // Campo 'user_agent' para almacenar el agente de usuario (información del navegador y sistema operativo)
            $table->longText('payload'); // Campo 'payload' para almacenar datos adicionales de la sesión en formato largo (puede incluir mucha información)
            $table->integer('last_activity')->index(); // Campo 'last_activity' que almacena la última actividad del usuario (como un timestamp en formato entero), indexado para optimizar consultas
        });
    }
    

    /**
     * Reverse the migrations.
     */
    public function down(): void
{
    // Elimina las tablas si existen
    Schema::dropIfExists('users'); // Elimina la tabla 'users'
    Schema::dropIfExists('password_reset_tokens'); // Elimina la tabla 'password_reset_tokens'
    Schema::dropIfExists('sessions'); // Elimina la tabla 'sessions'
}

};
