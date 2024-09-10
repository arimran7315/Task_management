<?php

use App\Http\Controllers\api\SearchController;
use App\Http\Controllers\api\taskController;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

Route::apiResource('tasks',taskController::class);
Route::post('search',[SearchController::class, 'search']);