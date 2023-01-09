<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\UserAuth;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\RequestTagController;
use App\Http\Controllers\DocumentsController;
use App\Http\Controllers\FirmasController;
use App\Http\Controllers\MensajeriaController;
use App\Http\Controllers\ComercioController;
use App\Http\Controllers\UserController;
use App\Http\Controllers\LocalController;
use App\Http\Controllers\EmpleadosController;
use App\Http\Controllers\DespachosController;
use App\Http\Controllers\Valor_TagController;
use App\Http\Controllers\Valor_DeliveryController;
use App\Http\Controllers\DevolucionesController;
use App\Http\Controllers\DevtagController;
use App\Http\Controllers\Valor_DevController;



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

Route::get('/', function () { return view('index'); });

Route::get('/suscripcion', function () { return view('tag.index'); });
Route::get('/natural', function () { return view('tag.natural'); })->name('natural');
Route::get('/tagdevolucion', function () { return view('tag.devolucion'); })->name('tagdevolucion');
Route::get('/tagdevolucionempresa', function () { return view('tag.devolucionempresa'); })->name('tagdevolucionempresa');
Route::get('/empresa', function () { return view('tag.empresa'); })->name('empresa');
Route::get('/document', function () { return view('tag.document'); })->name('document');

Route::get('/mensaje', [MensajeriaController::class, 'mensajes'])->name('mensaje');
Route::get('/mensaje_pendiente/{id}', [MensajeriaController::class, 'mensaje_pendiente'])->name('mensaje_pendiente')->middleware('auth');
Route::get('/pago_pendiente/{id}', [MensajeriaController::class, 'pago_pendiente'])->name('pago_pendiente')->middleware('auth');
Route::get('/mensaje_estado_aprobado/{id}', [MensajeriaController::class, 'mensaje_estado_aprobado'])->name('mensaje_estado_aprobado')->middleware('auth');
Route::get('/mensaje_estado_habilitado/{id}', [MensajeriaController::class, 'mensaje_estado_habilitado'])->name('mensaje_estado_habilitado')->middleware('auth');


Route::get('/dashboard', [HomeController::class, 'home'])->name('home')->middleware('auth');
Route::get('/login', [HomeController::class, 'index'])->middleware('guest');
Route::post('/logout', [HomeController::class, 'destroy'])->name('logout')->middleware('auth');
Route::post('/valida', [HomeController::class, 'userLogin']);

Route::resource('/empleado', EmpleadosController::class)->middleware('auth');
Route::resource('/local', LocalController::class)->middleware('auth');
Route::resource('/user', UserController::class)->middleware('auth');
Route::resource('/document', DocumentsController::class);
Route::resource('/firma', FirmasController::class);
Route::resource('/despacho', DespachosController::class);
Route::resource('/valortag', Valor_TagController::class)->middleware('auth');
Route::resource('/valordelivery', Valor_DeliveryController::class)->middleware('auth');
Route::resource('/valordev', Valor_DevController::class)->middleware('auth');

Route::resource('/devtag', DevtagController::class);
Route::resource('/devoluciones', DevolucionesController::class);
Route::get('/devolucion/{id}', [DevolucionesController::class, 'recepcion'])->name('devolucion');
Route::get('/devoluciones.list', [DevolucionesController::class, 'list'])->name('devoluciones.list')->middleware('auth');

Route::resource('/request_tag', RequestTagController::class);
Route::get('request_tag/pdf/{id}', [RequestTagController::class, 'pdf'])->name('request_tag.pdf')->middleware('auth');

Route::get('/pendiente_datos/{id}', [RequestTagController::class, 'pendiente_datos'])->name('pendiente_datos')->middleware('auth');
Route::get('/pendiente_pago/{id}', [RequestTagController::class, 'pendiente_pago'])->name('pendiente_pago')->middleware('auth');


Route::get('/comercio/{id}', [ComercioController::class, 'index'])->name('comercio');
Route::resource('/comercio', ComercioController::class);
