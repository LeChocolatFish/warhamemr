<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\ImperiumController;

Route::get('/', function(){return response()->json(['Sucesso'=>true]);}); 
Route::get('/Imperium',[ImperiumController::class,'index']);

Route::get('/Imperium/{id}', [ImperiumController::class,'show']);

Route::post('/Imperium',[ImperiumController::class,'store']);

Route::put('/Imperium/{id}',[ImperiumController::class,'update']);

Route::delete('/Imperium/{id}',[ImperiumController::class,'destroy']);
