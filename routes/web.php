<?php

use Illuminate\Support\Facades\Route;

Route::get('/', function () {
    return "tes";
})->middleware(\App\Http\Middleware\Tenant\TenantMiddleware::class);;
