<?php

use Illuminate\Support\Facades\Route;

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
    return redirect()->route('login');
});

Auth::routes();

Route::get('/home', function() {
    return redirect()->route('dashboard');
})->name('home');

Route::get('/dashboard',[App\Http\Controllers\Dashboard::class,'index'])->name('dashboard');

Route::get('/user',[App\Http\Controllers\Profile::class,'index'])->name('user');
Route::post('/user',[App\Http\Controllers\Profile::class,'create'])->name('postuser');
Route::get('/profile',[App\Http\Controllers\Profile::class,'show'])->name('mydata');

Route::get('/tables',function() {
  return view('dashboard.tables');
})->name('tabela');

Route::get('/carteira',[App\Http\Controllers\Wallet::class,'index'])->name('wallet');
Route::post('/carteira',[App\Http\Controllers\Wallet::class,'create'])->name('createFund');
Route::post('/carteira/atualizar',[App\Http\Controllers\Wallet::class,'update'])->name('updateFund');
Route::post('/carteira/deletar',[App\Http\Controllers\Wallet::class,'destroy'])->name('deleteFund');
Route::get('/funds',[App\Http\Controllers\Wallet::class,'show'])->name('listfunds');


Route::get('/stock',[App\Http\Controllers\Stock::class,'show'])->name('stock');

Route::get('/price',[App\Http\Controllers\Price::class,'index'])->name('price');
Route::get('/price/show',[App\Http\Controllers\Price::class,'show'])->name('showprice');

Route::get('/price/create/crypto',[App\Http\Controllers\Price::class,'create'])->name('createpricecrypto');
Route::get('/price/create/bovespa',[App\Http\Controllers\Price::class,'ibovespaCreate'])->name('createpricebovespa');


Route::get('/graph/highvalues',[App\Http\Controllers\Graphic::class,'highValues'])->name('highValues');
Route::get('/graph/timefund',[App\Http\Controllers\Graphic::class,'timeFund'])->name('timefund');
Route::get('/graph/timebovespa',[App\Http\Controllers\Graphic::class,'timeBovespa'])->name('timebovespa');
Route::get('/graph/timecrypto',[App\Http\Controllers\Graphic::class,'timeCrypto'])->name('timecrypto');



Route::get('/graph/graphtime',[App\Http\Controllers\Graphic::class,'graphTime'])->name('graphTime');





Route::get('/investors',[App\Http\Controllers\Permissions::class,'index'])->name('investors');
Route::get('/permissions',[App\Http\Controllers\Permissions::class,'show'])->name('listpermission');

Route::get('/criador',function() {
  return view('criador');
});

Route::get('/logout',[App\Http\Controllers\Dashboard::class,'logout'])->name('logout');
