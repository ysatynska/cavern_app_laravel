<?php
use App\Http\Controllers\CavernController;
use App\Http\Controllers\OrderController;
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

Route::get('login', function () {
    $returnURL = Session::get('returnURL', Request::url().'/../');

    return RCAuth::redirectToLogin($returnURL);
});

Route::get('logout', function () {
    RCAuth::logout();
    $returnURL = Request::url().'/../';

    return RCAuth::redirectToLogout($returnURL);
});

Route::get('/', [CavernController::class, 'index']);

Route::middleware('force_login')->group(function () {
    Route::get('/order', [OrderController::class, 'orderForm']);
    Route::post('/order/store', [OrderController::class, 'storeOrder']);
    Route::get('/thank_you/{order:name}', [OrderController::class, 'thankYou']);
    Route::get('/secret_base', [CavernController::class, 'secretBase'])->middleware('force_secret_agent');
    Route::post('/form_submitted', [CavernController::class, 'secretBaseFileUpload']);
    Route::get('/retrieved/{id}', [CavernController::class, 'secretBaseFileRetrieve']);
    Route::get('/newest', [CavernController::class, 'secretBaseFileNewest']);
});

