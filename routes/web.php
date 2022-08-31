<?php
use App\Notifications\TestNotification;
use App\Http\Controllers\LibroController;
use App\Http\Controllers\CategoriaController;
use Illuminate\Support\Facades\Route;
use Illuminate\Support\Facades\Notification;
use App\Http\Controllers\ContactanosController;
use App\Exports\LibroExport;

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

Auth::routes();

Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home');

Route::resource('libros', App\Http\Controllers\LibroController::class)->middleware('auth');

Route::resource('categorias', App\Http\Controllers\CategoriaController::class)->middleware('auth');


Route::get('contactanos', [ContactanosController::class,'index'])->name('contactanos.index');

Route::post('contactanos', [ContactanosController::class,'store'])->name('contactanos.store');  

Route::get('/libro/export', [LibroController::class,'exportExcel'])->name('libro.exportExcel');

Route::post('/libro/import', [LibroController::class,'importExcel'])->name('libro.importExcel');

Route::get('libros.pdf', [App\Http\Controllers\LibroController::class, 'pdf'])->name('libros.pdf');

Route::get('libros.descargar-pdf', [App\Http\Controllers\LibroController::class, 'descargarpdf'])->name('libros.descargar-pdf');