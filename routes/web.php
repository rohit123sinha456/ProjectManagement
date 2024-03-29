<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Admin\AdminLogin;
use App\Http\Controllers\Admin\AdminSdlcController;
use App\Http\Controllers\Admin\AdminClientController;
use App\Http\Controllers\Admin\AdminResourceController;
use App\Http\Controllers\Admin\AdminResourceControllerUtil;
use App\Http\Controllers\Admin\AdminController;
use App\Http\Controllers\Pm\PmLogin;
use App\Http\Controllers\Pm\ObjectController;
use App\Http\Controllers\Resource\ResourceLogin;
use App\Http\Controllers\Resource\ResourceController;


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
    Route::get('/sdlc',[AdminSdlcController::class,'index'])->middleware('useraccess:admin');
    Route::get('/sdlc/create',[AdminSdlcController::class,'create'])->middleware('useraccess:admin');
    Route::post('/sdlc',[AdminSdlcController::class,'update'])->middleware('useraccess:admin');
    Route::resource('clients',AdminClientController::class)->middleware('useraccess:admin');
    Route::resource('resources',AdminResourceController::class)->middleware('useraccess:admin');
    Route::post('update/resources/{id}',[AdminResourceControllerUtil::class,'updateresource'])->middleware('useraccess:admin');
    Route::get('/selecteddate',[AdminController::class,'viewselectdate'])->middleware('useraccess:admin');
    Route::post('/selecteddate',[AdminController::class,'showcharts'])->middleware('useraccess:admin');

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

Route::prefix('resource')->group(function(){
    Route::get('/dashboard',[ResourceLogin::class,'index'])->middleware('useraccess:resource');
    Route::get('/timesheetselectdate',[ResourceController::class,'selectdate'])->middleware('useraccess:resource');
    Route::get('/viewtimesheetentry',[ResourceController::class,'viewtimesheetentry'])->middleware('useraccess:resource');
    Route::get('/vieweffortestimation',[ResourceController::class,'vieweffortestimation'])->middleware('useraccess:resource');
    Route::get('/filleffortestimation/{id}',[ResourceController::class,'filleffortestimation'])->middleware('useraccess:resource');
    Route::get('/selecteddate',function(){return redirect('/resource/timesheetselectdate');})->middleware('useraccess:resource');
    
    Route::post('/login',[ResourceLogin::class,'login']);
    Route::post('/viewtimesheetentry',[ResourceController::class,'viewtimesheetentry'])->middleware('useraccess:resource');
    Route::post('/selecteddate',[ResourceController::class,'viewtimesheet'])->middleware('useraccess:resource');
    Route::post('/submittimesheet',[ResourceController::class,'submittimesheet'])->middleware('useraccess:resource');
    Route::post('/submittimesheetentry',[ResourceController::class,'submittimesheetentry'])->middleware('useraccess:resource');
    Route::post('/submiteffortestimate',[ResourceController::class,'submiteffortestimate'])->middleware('useraccess:resource');

    Route::get('/settings', [ResourceController::class ,'showresourceSettings'])->middleware('useraccess:resource');
    Route::get('/passwordreset', [ResourceController::class ,'showresourcePasswordReset'])->middleware('useraccess:resource');
    Route::post('/passwordreset', [ResourceController::class ,'resourcePasswordReset'])->middleware('useraccess:resource');

});
