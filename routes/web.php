<?php

use App\Http\Controllers\HandleRequestsController;
use Illuminate\Support\Facades\Route;
use Livewire\Volt\Volt;
 
Volt::route('/', 'generator');

Route::match(
    ['get', 'post', 'put', 'delete'],
    '/j/{url:url}',
    HandleRequestsController::class
)->name('handle-requests');
