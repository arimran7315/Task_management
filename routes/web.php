<?php

use App\Http\Controllers\UserController;
use App\Http\Middleware\ValidUser;
use Illuminate\Support\Facades\Route;

Route::get('/', function () {
    return view('index');
})->name('index')->middleware(ValidUser::class);
Route::get('/register', function () {
    return view('register');
})->name('register');
Route::get('/login', function () {
    return view('login');
})->name('login');
Route::get('/task-view/{id}', function () {
    return view('viewTask');
});
Route::get('/task-update/{id}', function () {
    return view('updateTask');
});
Route::get('task-add', function () {
    return view('addTask');
})->name('addTask');

Route::get('/approvals',[UserController::class, 'index'])->name('approvals')->middleware('can:isAdmin');
Route::get('/updateApprovel/{id}',[UserController::class, 'update'])->name('upate.approvel')->middleware('can:isAdmin');

Route::post('/signup',[UserController::class,'register'])->name('register.function');
Route::post('/signin',[UserController::class,'login'])->name('login.function');
Route::get('/logout',[UserController::class,'logout'])->name('logout.function');