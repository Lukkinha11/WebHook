<?php

use Illuminate\Support\Facades\Route;
use Livewire\Volt\Volt;
 
Volt::route('/', 'welcome');

Volt::route('/welcome2', 'welcome2');

// Route::get('/', function () {
//     return view('welcome');
// });
