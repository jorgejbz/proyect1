<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\Alert;


class FailedJobsTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $failedJobsRecords = [
            [
                'state' => 'on',           // Estado de la alerta (encendido)
                'timestamp' => now(),      // Marca de tiempo actual
            ],
            [
                'state' => 'off',          // Estado de la alerta (apagado)
                'timestamp' => now(),      // Marca de tiempo actual
            ],
        ];

        // Inserta los registros en la colección 'failed_jobs'
        Alert::insert($failedJobsRecords);
    }
}

