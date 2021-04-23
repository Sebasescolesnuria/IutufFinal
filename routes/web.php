<?php

use Illuminate\Support\Facades\Route;
use Illuminate\Support\Facades\Auth;

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

Route::get('/', function () {
    return view('welcome');
});

Route::resource('video','App\Http\Controllers\VideoController');
Route::resource('videouser','App\Http\Controllers\VideoUserController');

Route::put('post/{id}', function ($id) {
    //
})->middleware('auth', 'role:admin');

Auth::routes();

//Routes HomeController
Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home');

//Routes VideoController
Route::get('/index', [App\Http\Controllers\VideoController::class, 'index'])->name('index');
Route::get('/upload', [App\Http\Controllers\VideoController::class, 'upload'])->name('upload');
Route::get('/edit', [App\Http\Controllers\VideoController::class, 'edit'])->name('edit');
Route::get('/perfil', [App\Http\Controllers\VideoController::class, 'perfil'])->name('perfil');
Route::get('/show', [App\Http\Controllers\VideoController::class, 'show'])->name('show');
Route::get('/insertcomments', [App\Http\Controllers\VideoController::class, 'insertcomments'])->name('insertcomments');
Route::get('/insertpuntuaciones', [App\Http\Controllers\VideoController::class, 'insertpuntuaciones'])->name('insertpuntuaciones');

//Routes VideoUserController
Route::get('/editadmin', [App\Http\Controllers\VideoUserController::class, 'edit'])->name('editadmin');
Route::get('/show', [App\Http\Controllers\VideoUserController::class, 'show'])->name('show');
Route::get('/store', [App\Http\Controllers\VideoUserController::class, 'store'])->name('store');
Route::get('/destroy', [App\Http\Controllers\VideoUserController::class, 'destroy'])->name('destroy');




