<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Api\AuthController;
use App\Http\Controllers\Api\ApiController;

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

Route::middleware('auth:sanctum')->get('/user', function (Request $request) {
    return $request->user();
});
Route::get('/companies', [ApiController::class, 'companies']);
Route::get('/company/{company}', [ApiController::class, 'company']);
Route::post('/add-company', [ApiController::class, 'addCompany']);
Route::get('/user-company', [ApiController::class, 'userCompany']);
Route::delete('/delete-company/{id}', [ApiController::class, 'destroy']);
Route::post('/update/{id}', [ApiController::class, 'update']);
Route::get('/category', [ApiController::class, 'category']);


Route::post('login',[AuthController::class,'login']);
Route::post('register',[AuthController::class,'register']);
Route::group(['middleware' => ['auth:sanctum']], function (){
    Route::post('logout',[AuthController::class,'logout']);
});

