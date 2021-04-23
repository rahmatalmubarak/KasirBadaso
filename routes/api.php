<?php

use App\Http\Controllers\Api\TransactionController;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

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

Route::middleware('auth:api')->get('/user', function (Request $request) {
    return $request->user();
});
Route::get('/transaction', 'Api\TransactionController@index');
Route::post('/transaction/done', 'Api\TransactionController@transaction');
Route::post('/transaction/create', 'Api\TransactionController@store');
Route::get('/transaction/showdetail', 'Api\TransactionController@show');
Route::delete('/transaction/showdetail/delete/{id}', 'Api\TransactionController@deleteDetail');
Route::post('/transaction/showdetail/cancel', 'Api\TransactionController@cancel');
Route::get('/transaction/{id}/detail', 'Api\TransactionController@details');
Route::post('/transaction/{id}/print', 'Api\TransactionController@print');
Route::get('/transaction/{idc}/showname', 'Api\TransactionController@name');
