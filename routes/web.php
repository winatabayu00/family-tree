<?php

use App\Http\Controllers\FamilyController;
use App\Http\Controllers\QueryController;
use App\Models\Family;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "web" middleware group. Make something great!
|
*/

Route::get('/', function () {
    return to_route('family.index')->send();
    return view('welcome');
});


Route::prefix('family')->name('family.')
    ->controller(FamilyController::class)
    ->group(function (){
        Route::model('family', Family::class);
        Route::get('/', 'index')->name('index');
        Route::get('/create', 'create')->name('create');
        Route::post('/create', 'store')->name('store');
        Route::get('/{family}', 'show')->name('show');
        Route::get('/{family}/edit', 'edit')->name('edit');
        Route::put('/{family}/edit', 'update')->name('update');
        Route::delete('/{family}', 'destroy')->name('destroy');
    });

Route::prefix('query')->name('query.')
    ->controller(QueryController::class)
    ->group(function (){
        Route::get('/', 'index')->name('index');
        Route::post('/query', 'executeQuery')->name('executeQuery');
    });


