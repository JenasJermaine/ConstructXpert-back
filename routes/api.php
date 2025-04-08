<?php
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Api\ClientsController;
use App\Http\Controllers\Api\RolesController;

Route::get('/clients', [ClientsController::class, 'index']);
Route::post('/clients', [ClientsController::class, 'store']);
Route::get('/roles', [RolesController::class, 'index']);
Route::post('/roles', [RolesController::class, 'store']);