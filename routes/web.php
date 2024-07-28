<?php

use Illuminate\Support\Facades\Route;

use App\Http\Controllers\WorldController;

/*
|---------------------------------------------------------------------
| Routes
|---------------------------------------------------------------------
*/

Route::get('/world/{moveKey}/{option?}', [WorldController::class, 'index']);
