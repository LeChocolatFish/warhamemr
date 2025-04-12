<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\AdeptusAstardesController;
use App\Http\Controllers\AstraMilitarumController;

Route::get('/', function(){return response()->json(['Sucesso'=>true]);}); 
Route::get('/militarum',[AstraMilitarumController::class,'index']);
Route::get('/astardes',[AstraMilitarumController::class,'index']);

Route::get('/militarum/{id}', [AstraMilitarumController::class,'show']);
Route::get('/astardes/{id}', [AdeptusAstardesController::class,'show']);

Route::post('/militarum/store',[AstraMilitarumController::class,'store']);
Route::post('/astardes',[AdeptusAstardesController::class,'store']);

Route::put('/militarum/{id}',[AstraMilitarumController::class,'update']);
Route::put('/astardes/{id}',[AdeptusAstardesController::class,'update']);

Route::delete('/militarum/{id}',[AstraMilitarumController::class,'destroy']);
Route::delete('/astardes/{id}',[AdeptusAstardesController::class,'destroy']);
