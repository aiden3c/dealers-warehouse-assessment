<?php

use App\Http\Controllers\CustomerController;
use Illuminate\Support\Facades\Route;

Route::get('/', function () {
    return view('addOrEdit');
});
Route::get('/customers', [CustomerController::class, 'list']);
Route::get('/customers/{account_number}', [CustomerController::class, 'show']);

Route::post('/', [CustomerController::class, 'submit']);
Route::post('/customers/{account_number}', [CustomerController::class, 'update']);
