<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Admin;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Validator;
// use App\Http\Controllers\Admin\Image;
use Intervention\Image\Facades\Image; // Importación de la clase Image de Intervention Image
use Illuminate\Support\Facades\Session;

class AdminController extends Controller
{
    public function dashboard(){
        Session::put('page', 'dashboard');
        return view('admin.dashboard');
    }
    public function login(Request $request){
        if($request->isMethod('post')){
            $data = $request->all();
            //echo "<pre>"; print_r($data); die;
            $rules = [
                'email' => 'required|email|max:255',
                'password' => 'required',
                ];
                $customMessages = [
                    // aqui se configuran los mensajes de validacion de inicio de sesion de si ponen sus datos o no
                    'email.required' => 'El email es requerido',
                    'email.email' => 'Email es invalido',
                    'password.required' => 'La contraseña es requerida',
                ];
                // Reemplazar el método validate() por Validator::make()
                $validator = Validator::make($data, $rules, $customMessages);
                        
                if ($validator->fails()) {
                    return redirect()->back()->withErrors($validator)->withInput();
                }

            if(Auth::guard('admin')->attempt(['email'=>$data['email'],'password'=>$data['password']])){

                if(!empty($_POST['remember'])){
                    setcookie("email",$_POST['email'],time()+3600);
                    setcookie("password",$_POST['password'],time()+3600);
                }else{
                    setcookie("email","");
                    setcookie("password","");
                }

                return redirect('admin/dashboard');
            }
            else{
                return redirect()->back()->with('error_message','Email o Contraseña invalidos');
                }
            }
            return view('admin.login');
        }
    
    public function logout(){
        Auth::guard('admin')->logout();
        return redirect('admin/login');
    }

    public function updatePassword(Request $request){
        Session::put('page', 'update-password');

        if($request->isMethod('post')){
            $data = $request->input();
            //checa que la contrasena actual es correcta
            if (Hash::check($data['current_pwd'], Auth::guard('admin')->user()->password)) {
            //checa que la nueva contrasena coincida con la confirmacion de contrasena
            if ($data['new_pwd'] == $data['confirm_pwd']) {
                //actualiza la contrasena
                Admin::where('id',Auth::guard('admin')->user()->id)->update(['password'=>bcrypt($data['new_pwd'])]);
                return redirect()->back()->with('success_message','Contraseña actualizada con Exito!');
            }else{
                return redirect()->back()->with('error_message','La Contraseña Nueva y la Confirmacion no Coinciden');
            }
        }else{
                return redirect()->back()->with('error_message','La Contraseña Actual es incorrecta!');
        }}
        return view('admin.update_password');
    }

    public function checkCurrentPassword(Request $request) {
        $data = $request->all();
        if (Hash::check($data['current_pwd'], Auth::guard('admin')->user()->password)) {
            return "true";
        } else {
            return "false";
        }
    }
    
    public function updateAdminDetails(Request $request){
        Session::put('page', 'update-admin-details');
    if ($request->isMethod('post')) {
        $data = $request->all();
        // echo"<pre>"; print_r($data); die;
        // Reglas de validación
        $rules = [
            'admin_name' => 'required|regex:/^[\p{L}\s]+$/u',
            'admin_mobile' => 'required|numeric',
        ];

        // Mensajes de error personalizados
        $customMessages = [
            'admin_name.required' => 'El campo nombre es requerido',
            'admin_name.regex' => 'El campo nombre solo acepta letras y espacios pero no numeros ni caracteres especiales',
            'admin_mobile.required' => 'El campo teléfono es requerido',
            'admin_mobile.numeric' => 'El campo teléfono solo acepta números',
        ];

        // Validación de datos
        $validator = Validator::make($data, $rules, $customMessages);
        
        if ($validator->fails()) {
            return redirect()->back()->withErrors($validator)->withInput();
        }

        //Subir Imagen para foto Del Administrador
        if ($request->hasFile('admin_image')) {
            $image_tmp = $request->file('admin_image');
            if ($image_tmp->isValid()){
                // Obtener la extensión de la imagen
                $extension = $image_tmp->getClientOriginalExtension();
                
                // Generar un nuevo nombre de archivo
                $fileName = rand(111, 99999) . '.' . $extension;
                
                // Definir la ruta para guardar la imagen
                $banner_path = 'admin/img/adminimg/' . $fileName;
                // Guardar la imagen utilizando la librería Intervention Image
                Image::make($image_tmp)->save($banner_path);
            }
            
            } else if(!empty($data['current_image'])){
                $fileName = $data['current_image'];
                } else {
                    $fileName = '';
                    }
        // Actualización de los detalles del admin
        Admin::where('email', Auth::guard('admin')->user()->email)
            ->update([
                'name' => $data['admin_name'],
                'mobile' => $data['admin_mobile'],
                'image'=>$fileName]);

        // Mensaje de éxito
        return redirect()->back()->with('success_message','¡Datos del Admin actualizados con éxito!');
        
    }

    // Retorno de la vista
    return view('admin.update_admin_details');
}

}