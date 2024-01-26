<?php
use App\Http\Controllers\CavernController;
use App\Http\Controllers\OrderController;
use App\Http\Controllers\ToppingController;
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

    Route::get('/delete/{order:id}', [OrderController::class, 'delete']);
    Route::get('/update/{order:id}', [OrderController::class, 'update']);
    Route::post('save_updated_order/{order:id}', [OrderController::class, 'saveUpdatedOrder']);

    Route::get('/secret_base', [CavernController::class, 'secretBase'])->middleware('force_secret_agent');
    Route::get('/all_orders', [CavernController::class, 'allOrders'])->middleware('force_secret_agent');
    Route::post('/form_submitted', [CavernController::class, 'secretBaseFileUpload']);
    Route::get('/retrieved/{id}', [CavernController::class, 'secretBaseFileRetrieve']);
    Route::get('/newest', [CavernController::class, 'secretBaseFileNewest']);

    Route::get('/toppings', [ToppingController::class, 'index'])->middleware('force_secret_agent');;
    Route::get('topping/delete/{topping:id}', [ToppingController::class, 'delete'])->middleware('force_secret_agent');;
    Route::post('add_topping', [ToppingController::class, 'addTopping'])->middleware('force_secret_agent');;
});

