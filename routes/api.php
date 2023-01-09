<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\TransbankController;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| is assigned the "api" middleware group. Enjoy building your API!
|
*/
/*
Route::middleware('auth:sanctum')->get('/user', function (Request $request) {
    return $request->user();
});
*/

//Route::resource('/iniciar_compra', TransbankController::class);

Route::get('/iniciar_compra', [TransbankController::class, 'iniciar_compra'])->name('iniciar_compra');
Route::get('/confirma_pago', [TransbankController::class, 'confirma_pago'])->name('confirma_pago');
Route::post('/confirma_pago', [TransbankController::class, 'confirma_pago'])->name('confirma_pago');