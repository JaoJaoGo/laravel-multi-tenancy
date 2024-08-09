<?php

use Illuminate\Support\Facades\Route;

Route::view('/404-tenant', 'errors.404-tenant')->name('404.tenant');

Route::get('/', function () {
    return view('welcome');
})->middleware(\App\Http\Middleware\Tenant\TenantMiddleware::class);
