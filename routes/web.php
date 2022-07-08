<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Admin\AdminLogin;
use App\Http\Controllers\Admin\AdminClientController;
use App\Http\Controllers\Admin\AdminResourceController;
use App\Http\Controllers\Admin\AdminResourceControllerUtil;
use App\Http\Controllers\Pm\PmLogin;
use App\Http\Controllers\Pm\ObjectController;
use Illuminate\Http\Request;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/
// Auth::routes();
Route::get('/', function () {
    return view('welcome');
})->name('home');

Route::get('/admin', function () {
    return view('admin.loginpage');
})->name('adminlogin');

Route::get('/pm', function () {
    return view('pm.loginpage');
})->name('pmlogin');

Route::get('/resource', function () {
    return view('resource.loginpage');
})->name('resourcelogin');


Route::get('/logout',function(Request $request){
    $request->session()->flush();
    return redirect('/');
});

Route::group(['prefix'=>'admin'],function(){
    Route::post('/login', [AdminLogin::class,'login']);
    Route::get('/dashboard',[AdminLogin::class,'index'])->middleware('useraccess:admin');
    Route::resource('clients',AdminClientController::class)->middleware('useraccess:admin');
    Route::resource('resources',AdminResourceController::class)->middleware('useraccess:admin');
    Route::post('update/resources/{id}',[AdminResourceControllerUtil::class,'updateresource'])->middleware('useraccess:admin');

});

Route::prefix('pm')->group(function () {
    Route::post('/login', [PmLogin::class,'login']);
    Route::get('/dashboard',[PmLogin::class,'index'])->middleware('useraccess:pm');
    Route::get('/clients',[PmLogin::class,'viewclients'])->middleware('useraccess:pm');
    Route::get('/clients/{id}',[PmLogin::class,'viewclientsdetails'])->middleware('useraccess:pm');
    Route::get('/clients/{id}/objects',[PmLogin::class,'viewclientsobjects'])->middleware('useraccess:pm');
    Route::get('/object/{id}/create',[ObjectController::class,'view'])->middleware('useraccess:pm');
    Route::post('/object/create',[ObjectController::class,'create'])->middleware('useraccess:pm');
    Route::get('/object/updatestatecomplete/{id}',[ObjectController::class,'updatestatecomplete'])->middleware('useraccess:pm');
    Route::get('/object/updatestaterunning/{id}',[ObjectController::class,'updatestaterunning'])->middleware('useraccess:pm');
    Route::get('/object/updatestaterejected/{id}',[ObjectController::class,'updatestaterejected'])->middleware('useraccess:pm');
    Route::get('/object/view/{id}',[ObjectController::class,'showdetails'])->middleware('useraccess:pm');

});