<?php

use App\Livewire\Backend\Brands;
use App\Livewire\Backend\BrandsForm;
use Illuminate\Support\Facades\Route;

Route::get('/', function () {
    return view('welcome');
});

Route::middleware([
    'auth:sanctum',
    config('jetstream.auth_session'),
    'verified',
])->group(function () {
    Route::get('/dashboard', function () {
        return view('backend.admin');
    })->name('admin');
    Route::get('/marcas', Brands::class)->name('brands');
    Route::get('/marcas/formulario/{id?}', BrandsForm::class)->name('brands-form');
});