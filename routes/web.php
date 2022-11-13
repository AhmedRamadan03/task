<?php

use App\Http\Controllers\FolderController;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\LoginController;
use App\Http\Controllers\UserController;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Route;

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

// auth route
Route::get('/', function(){
    return redirect(route('login'));

});
Route::get('/login', [LoginController::class,"viewLogin"])->name('login');
Route::post('/do-login', [LoginController::class,"doLogin"])->name('dologin');
Route::post('/do-register', [LoginController::class,"doRegister"])->name('register');
Route::post('/logout' , [LoginController::class,"logout"])->name('logout');


Route::group(['middleware' => ['auth']], function () {
// home route
Route::get('/home' , [HomeController::class , 'index'])->name('home');
Route::get('/run-page' , [HomeController::class , 'runCode'])->name('run');
Route::get('/',  function () {
    if (Auth::check()) {
        return redirect()->route('home');
    }
    return view('auth.login');
});
// folder route
Route::get('/folders' , [FolderController::class , 'index'])->name('folders.index');
Route::post('/folders' , [FolderController::class , 'store'])->name('folders.store');
Route::post('/folders/{id}' , [FolderController::class , 'update'])->name('folders.update');
Route::post('/folders/{id}' , [FolderController::class , 'destroy'])->name('folders.destroy');
Route::get('view_file/{file_name}', [FolderController::class, 'openFile'])->name('folders.openFile');
Route::get('download/{file_name}', [FolderController::class, 'download'])->name('folders.download');
// folder route
Route::get('/users' , [UserController::class , 'index'])->name('users.index');
Route::post('/users' , [UserController::class , 'store'])->name('users.store');
Route::post('/users/{id}' , [UserController::class , 'update'])->name('users.update');
Route::post('/users/{id}' , [UserController::class , 'destroy'])->name('users.destroy');
});