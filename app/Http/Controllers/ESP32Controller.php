<?php
namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Http;
use App\Models\Job;
use Illuminate\Support\Facades\Log;


class ESP32Controller extends Controller
{

    //ESP32 1 NOSE
    //metodo/funcion para mostrar la pagina de control led del esp32-1
    // public function showLedControl()
    // {
    //     session()->put('page', 'led.control');

    //     // Obtén el estado del LED de la sesión, si no existe, el valor inicial será 'apagado'
    //     $ledState = session('ledState', false);
    //     return view('led-control', ['ledState' => $ledState]);
    // }
    public function showLedControl()
{
    session()->put('page', 'led.control');

    // Obtén el estado del LED de la sesión, si no existe, el valor inicial será 'apagado'
    $ledState = session('ledState', false);

    // Obtiene los últimos 10 registros de la colección 'jobs' desde MongoDB
    $jobs = Job::orderBy('timestamp', 'desc')->limit(10)->get();

    // Inicializa contadores para los estados 'on' y 'off'
    $onCount = $jobs->where('state', 'on')->count();
    $offCount = $jobs->where('state', 'off')->count();

    return view('led-control', [
        'ledState' => $ledState,
        'onCount' => $onCount,
        'offCount' => $offCount,
        'jobs' => $jobs
    ]);
}
    public function getLatestJobs()
    {
        try {
            // Obtener los últimos 10 registros ordenados por timestamp
            $jobs = Job::orderBy('timestamp', 'desc')->take(10)->get();
    
            // Verifica si hay registros obtenidos
            if ($jobs->isEmpty()) {
                return response()->json(['error' => 'No se encontraron datos'], 404);  // Manejar el caso cuando no hay datos
            }
    
            // Devolver los datos en formato JSON
            return response()->json($jobs);
        } catch (\Exception $e) {
            // Registrar el error y devolver un mensaje de error
            Log::error('Error al obtener los trabajos: ' . $e->getMessage());
            return response()->json(['error' => 'Error al obtener los datos de MongoDB'], 500);
        }
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
        $esp32_ip = 'http://192.168.66.137'; // Cambia a la IP del ESP32
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

        $esp32_ip = 'http://192.168.66.137'; // Cambia a la IP del ESP32
        $response = Http::post("{$esp32_ip}/api/control-led", [
            'state' => 'off',
        ]);

        return redirect()->back()->with('status', 'LED apagado');
    }


//ESP32 2 ULTRASONIDO
    //funcion para checar el nivel de capacidad de la tolva
    // Método para mostrar la página de control de capacidad

    public function showCapacityControl(){
        // Guardamos en sesión la página actual para navegación o control de estado
        session()->put('page', 'capacity.control');
        
        // Retornamos la vista sin el estado del LED
        return view('esp322-control');
    }

   // Método para obtener el nivel de capacidad del ESP32 y mostrarlo en la vista
    public function showNivelCapacidad()
   {
       $esp32_ip = 'http://192.168.66.207'; // IP de tu ESP32
       $nivelCapacidad = 'NO CONECTADO'; // Valor por defecto en caso de que no se pueda conectar
   
       try {
           // Intentar obtener la respuesta del ESP32 con un tiempo de espera de 10 segundos
           $response = Http::timeout(10)->get("{$esp32_ip}/api/nivel");

           dd($response); // Depuración para ver la respuesta
   
           if ($response->successful()) {
               // Extraemos el nivel de capacidad si la solicitud es exitosa
               $nivelCapacidad = $response->json()['nivel'];
           }
       } catch (\Exception $e) {
           // Si ocurre algún error en la solicitud, mostramos un mensaje de error
           $nivelCapacidad = 'Error de conexión';
       }
   
       // Pasamos la variable 'nivelCapacidad' a la vista
       return view('esp322-control', [
           'nivelCapacidad' => $nivelCapacidad,
       ]);
    }

   // Método para devolver el nivel de capacidad del ESP32 en formato JSON
    public function getNivelCapacidad(){
       $esp32_ip = 'http://192.168.66.207'; // Cambia a la IP de tu ESP32
   
       try {
           // Hacemos la solicitud con un tiempo de espera de 20 segundos
           $response = Http::timeout(20)->get("{$esp32_ip}/api/nivel");
   
           // Depurar para ver qué respuesta devuelve el ESP32
           // dd($response->json());
   
           if ($response->successful()) {
               // Asegúrate de usar la clave correcta del JSON que devuelve el ESP32
               return response()->json(['nivel' => $response->json()['nivel']]);
           } else {
               // Si no es exitosa, devolvemos un error genérico
               return response()->json(['error' => 'Error en la solicitud al ESP32'], 500);
           }
       } catch (\Exception $e) {
           // Si ocurre cualquier excepción, devolvemos un mensaje de error
           return response()->json(['error' => 'No se pudo conectar con el ESP32: ' . $e->getMessage()], 500);
       }
    }

}