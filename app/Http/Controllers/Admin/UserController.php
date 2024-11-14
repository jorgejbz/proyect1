<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\User;
use Illuminate\Support\Facades\Session;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\Log;

class UserController extends Controller
{
    public function index(){
        Session::put('page','user-list');
        $user_list = User::get();
        //$user_list = json_decode(json_decode($user_list));
        // echo "<pre>"; print_r($user_list); die;
        return view('admin.pages.user_list', compact('user_list'));

    }

    public function update(Request $request, User $user) {
        // Verificar si la solicitud es AJAX
        if ($request->ajax()) {
            $data = $request->all();
    
            // Lógica para determinar el nuevo estado
            $status = $data['status'] === "Active" ? 0 : 1;
    
            // Actualizar el estado del usuario en la base de datos
            User::where('_id', $data['page_id'])->update(['status' => $status]);
    
            // Definir el mensaje de éxito basado en el nuevo estado
            $customMessages = $status === 1 
                ? 'Usuario activado correctamente.' 
                : 'Usuario desactivado correctamente.';
    
            // Guardar el mensaje en la sesión
            Session::flash('success_message', $customMessages);
    
            // Retornar la respuesta en formato JSON
            return response()->json([
                'status' => $status,
                'page_id' => $data['page_id'],
                'success_message' => $customMessages
            ]);
        }
    //hola
        // Si no es una solicitud AJAX, retornar un error o redirigir
        return response()->json(['error' => 'Invalid request'], 400);
    }
    

    // Mostrar la página de añadir o editar usuario
    public function edit(Request $request, $id = null) {
            Session::put('page', 'add-edit-user-page/{id?}');
            if ($id == "") {
                // Si $id está vacío, se asume que estamos creando un nuevo usuario.
                $title = "Añadir Nuevo Usuario";
                $user = new User; // Crear una nueva instancia
                $message = "Usuario Creado Con Exito";
            } else {
                // Si $id no está vacío, buscamos el usuario existente para editarlo.
                $user = User::findOrFail($id);
                $title = "Editar Usuario";
            }
            // Inicia el registro de errores
            Log::info('Accediendo al método edit con ID: ' . $id);
        
                // Verificar si la solicitud es una POST
            if ($request->isMethod('post')) {
                Log::info('Solicitud POST recibida con datos: ', $request->all());
                $data = $request->all();
            // echo "<pre>"; print_r($data); die;
                
                // Reglas de validación
                $rules = [
                    'user_code' => 'required|unique:users,code,' . $id,  // Código único
                    'user_name' => 'required|regex:/^[\p{L}\s]+$/u',     // Solo letras y espacios
                    'user_email' => 'required|string|email|max:255|unique:users,email' . $id,  // Correo único
                    'user_position' => 'required|string|max:255',                       // Puesto requerido
                    'user_password' => $id ? 'nullable|min:6' : 'required|min:6',  // Contraseña obligatoria si es nuevo
                ];
                // Mensajes de error personalizados
            $customMessages = [
                'user_code.required' => 'El campo código es requerido',
                'user_code.unique' => 'El código ya está registrado',
                'user_email.required' => 'El campo correo es requerido',
                'user_email.email' => 'El correo debe ser válido',
                'user_email.unique' => 'El correo ya está registrado',
                'user_name.required' => 'El campo nombre es requerido',
                'user_name.regex' => 'El campo nombre solo acepta letras y espacios, no números ni caracteres especiales',
                'user_position.required' => 'El campo puesto es requerido',
                'user_password.required' => 'La contraseña es requerida',
                'user_password.min' => 'La contraseña debe tener al menos 6 caracteres',
            ];
            // Validación de datos
            $validator = Validator::make($data, $rules, $customMessages);

            if ($validator->fails()) {
                Log::warning('Validación fallida: ', $validator->errors()->all());
                return redirect()->back()->withErrors($validator)->withInput();
            }

            // Actualización de los detalles del usuario
                User::where('_id', $user->_id)
                ->update([
                    'code' => $data['user_code'],
                    'name' => $data['user_name'],
                    'email' => $data['user_email'],
                    'position' => $data['user_position'],
                ]);

                // Hashear la contraseña solo si se está añadiendo o si se desea cambiar
            if (!empty($data['user_password'])) {
                $user->password = bcrypt($data['user_password']);
            }
            $user->save(); // Guardar el modelo en la base de datos

            // Redirigir a la lista de usuarios con un mensaje de éxito
            return redirect('/admin/user-list')->with('success_message', 'Usuario Actualizado correctamente.');
        }

        // Si no se hace una solicitud POST, mostramos la vista del formulario
        Log::info('Mostrando el formulario para: ', ['title' => $title, 'user' => $user]);
        return view('admin.pages.add_edit_userpage', compact('title', 'user'));
    }
    

    public function store(Request $request)
    {
        Session::put('page', 'add-userpage');

        // Validar los datos del formulario
        $request->validate([
            'user_code' => 'required|string|max:255',
            'user_email' => 'required|string|email|max:255|unique:users,email',
            // 'user_type' => 'required|regex:/^[\p{L}\s]+$/u', 
            'user_name' => 'required|regex:/^[\p{L}\s]+$/u',
            'user_position' => 'required|string|max:255',
            'user_password' => 'required|string|min:8',
        ]);
        // Mensajes de error personalizados
        // $customMessages = [
        //     'user_code.required' => 'El campo código es requerido',
        //     'user_code.unique' => 'El código ya está registrado',
        //     'user_email.required' => 'El campo correo es requerido',
        //     'user_email.email' => 'El correo debe ser válido',
        //     'user_email.unique' => 'El correo ya está registrado',
        //     'user_name.required' => 'El campo nombre es requerido',
        //     'user_name.regex' => 'El campo nombre solo acepta letras y espacios, no números ni caracteres especiales',
        //     'user_position.required' => 'El campo puesto es requerido',
        //     'user_password.required' => 'La contraseña es requerida',
        //     'user_password.min' => 'La contraseña debe tener al menos 6 caracteres',
        //     ];

        // Crear un nuevo usuario
        $user = new User();
        $user->code = $request->input('user_code'); // Asegúrate de que tienes este campo en tu modelo
        $user->email = $request->input('user_email');
        $user->type = 'user';
        $user->name = $request->input('user_name');
        $user->position = $request->input('user_position');
        $user->password = bcrypt($request->input('user_password')); // Encriptar la contraseña
        $user->status = 1; // Asignar status = 1 automáticamente


        // Guardar el nuevo usuario en la base de datos
        $user->save();

        // Redirigir a la lista de usuarios con un mensaje de éxito
        return redirect()->route('user-list')->with('success_message', 'Usuario Creado Correctamente.');
    }
    
    
    public function create()
    {
        $add_userpage = User::get();

        return view('admin.pages.add_userpage', compact('add_userpage'));
    }

    public function destroy($id)
    {
        // Eliminar el usuario
        User::where(['_id' => $id])->delete();

        // Redirigir a la página anterior con un mensaje de éxito
        return redirect()->back()->with('error_message', 'El usuario ha sido eliminado correctamente.');
    }


}