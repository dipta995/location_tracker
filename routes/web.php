<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\LinkController;
use App\Http\Controllers\UserAuth;
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
    $as = session('user');
        if ($as==false){
            return redirect('/login');
        }
    return view('home');
});

Route::post("/customerlogin",[UserAuth::class,'userLogin']);
Route::get('/login', function () {
    if (session()->has('user'))
    {
        return redirect('/');
    }
    return view('login');
});
Route::get('/logout', function () {
    if (session()->has('user'))
    {
        session()->pull('user');
        session()->pull('userid');
        return redirect('/login');

    }else{
        return redirect('/login');
    }

});
Route::get("/{id}",[LinkController::class,'fixedlink']);
Route::post("/pst",[LinkController::class,'fixedlinks']);
Route::post("remove/track",[LinkController::class,'removetrack']);
Route::get("/create/link",[LinkController::class,'createlink']);
Route::post("/create/link",[LinkController::class,'createnewlink']);
Route::get("/view/link",[LinkController::class,'viewlink']);
Route::get("/link/list",[LinkController::class,'listview']);
 

