<?php
namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Http;
use App\Models\Job;

class ESP32Controller extends Controller
{
    public function showLedControl()//comentario de prueba
    {
        session()->put('page', 'led.control');

        // Obtén el estado del LED de la sesión, si no existe, el valor inicial será 'apagado'
        $ledState = session('ledState', false);
        return view('led-control', ['ledState' => $ledState]);
    }

    public function toggleLed(Request $request)
    {
        // Cambia el estado del LED guardado en la sesión
        $ledState = session('ledState', false);
        $ledState = !$ledState;

        // Almacena el nuevo estado en la sesión
        session(['ledState' => $ledState]);

        // Enviar solicitud al ESP32
        $state = $ledState ? 'on' : 'off';
        $esp32_ip = 'http://192.168.231.207'; // Cambia a la IP del ESP32
        $response = Http::post("{$esp32_ip}/api/control-led", [
            'state' => $state,
        ]);

            // Guardar el estado en la colección jobs de MongoDB
        $job = new Job();
        $job->state = $state;
        $job->timestamp = now();
        $job->save(); // Guarda el documento en MongoDB

        return redirect()->back()->with('status', 'LED ' . ($ledState ? 'encendido' : 'apagado'));
    }

    public function getLedState()
    {
        // Obtiene el estado del LED de la sesión y responde en formato JSON
        $ledState = session('ledState', false);
        return response()->json(['ledState' => $ledState ? 'on' : 'off']);
    }

    public function turnOffLed()
    {
        // Apaga el LED y actualiza el estado en la sesión
        session(['ledState' => false]);

        $esp32_ip = 'http://192.168.231.207'; // Cambia a la IP del ESP32
        $response = Http::post("{$esp32_ip}/api/control-led", [
            'state' => 'off',
        ]);

        return redirect()->back()->with('status', 'LED apagado');
    }
}