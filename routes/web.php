<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\CompanyController;
use App\Http\Controllers\CommentController;
use App\Http\Controllers\ItemsController;
use App\Http\Controllers\ShopinghistoryController;
use App\Models\Category;
use App\Http\Controllers\CategoryController;


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
Route::get('/',[CompanyController::class, 'index']);
Route::get('/add-company',[CompanyController::class, 'addCompany']);
Route::get('/company/{company}',[CompanyController::class, 'showCompany']);
Route::post('/store',[CompanyController::class, 'storeCompany']);
Route::get('/delete/company/{company}',[CompanyController::class, 'deleteCompany']);
Route::get('/update/company/{company}',[CompanyController::class, 'updateCompany']);
Route::post('/update/{company}',[CompanyController::class, 'storeUpdate']);
Route::get('/import', [CompanyController::class, 'importCompany']);
Route::post('/preview', [CompanyController::class, 'processImport']);
Route::post('/', [CompanyController::class, 'importAdd']);
Route::post('/company/{company}/comment',[CommentController::class, 'create']);

Route::get('/show-items',[ItemsController::class, 'showItems']);
Route::get('/add-items',[ItemsController::class, 'addItems']);
Route::post('/stores',[ItemsController::class, 'storeItems']);

Route::get('/useritemlist',[ItemsController::class, 'useritemlist']);
Route::get('/usercompanylist',[ItemsController::class, 'usercompanylist']);
Route::get('/dashboard',[ItemsController::class,'dashboard']);

Route::get('/add-category', [CategoryController::class, 'showAddCategory']);
Route::post('/create-category', [CategoryController::class, 'create']);
Route::get('/company-categories', [CategoryController::class, 'showCompanies']);

Route::get('/updat/items/{items}',[ItemsController::class, 'updateItems']);
Route::post('/updat/{items}',[ItemsController::class, 'storeUpdateItems']);
Route::get('/delet/items/{items}',[ItemsController::class, 'deleteItems']);
Route::get('/usercategorylist', [CategoryController::class, 'userCategoryList']);

Route::get('/updateshoping/items/{items}',[ShopinghistoryController::class, 'addShoping']);
Route::post('/storeShoping',[ShopinghistoryController::class, 'storeShoping']);
Route::get('/shoping-history',[ShopinghistoryController::class, 'showShopingHistory']);


Auth::routes();
Route::get('/logout','\App\Http\Controllers\Auth\LoginController@logout');
Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home');
