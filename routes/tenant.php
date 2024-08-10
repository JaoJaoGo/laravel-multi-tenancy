<?php

use Illuminate\Support\Facades\Route;

Route::get('/', function () {
    return 'tenant';
});

Route::get('company/store', 'Tenant\CompanyController@store')->name('company.store');
