<?php
use App\Http\Controllers\Admin\AdminController;
use App\Http\Controllers\Admin\UserController;
use App\Http\Controllers\ESP32Controller;
use Illuminate\Support\Facades\Route;

Route::get('/', function () {
    return view('/admin/login');
});

Route::prefix('/admin')->namespace('App\Http\Controllers\Admin')->group(function(){
    Route::match(['get','post'],'login',[AdminController::class,'login']);

        Route::group(['middleware'=>['admin']],function(){
        Route::match(['get','post'],'dashboard',[AdminController::class,'dashboard']);
        Route::match(['get','post'],'update-password',[AdminController::class,'updatePassword']);
        Route::post('check-current-password',[AdminController::class,'checkCurrentPassword']);
        Route::match(['get','post'],'update-admin-details',[AdminController::class,'updateAdminDetails']);
        Route::get('logout',[AdminController::class,'logout']);

        //ruta para esp32
        Route::get('/led', [ESP32Controller::class, 'showLedControl'])->name('led');
        Route::post('/led/toggle', [ESP32Controller::class, 'toggleLed'])->name('led.toggle');
        Route::get('/led/state', [ESP32Controller::class, 'getLedState'])->name('led.state');
        Route::post('/led/off', [ESP32Controller::class, 'turnOffLed'])->name('led.off');
        //user page
        Route::get('user-list',[UserController::class,'index'])->name('user-list');
        Route::post('update-user-status',[UserController::class,'update']);
        
        Route::get('add_userpage', [UserController::class, 'create'])->name('create');
        Route::post('user_register', [UserController::class, 'store'])->name('store');
        Route::match(['get','post','put'],'add-edit-user-page/{id?}',[UserController::class,'edit']);
        Route::get('delete-user-page/{id}','UserController@destroy');

    });
});

