<?php

use Illuminate\Support\Facades\Route;
use Vizir\KeycloakWebGuard\Controllers\AuthController;

Route::get('/', function () {
    return view('welcome');
});


Route::get('/login', [AuthController::class, 'login'])->name('login');
Route::get('/callback', [AuthController::class, 'callback'])->name('keycloak.callback');
Route::get('/logout', [AuthController::class, 'logout'])->name('logout');


Route::middleware('keycloak.auth')->group(function () {
   Route::get('/dashboard', function () {
        return Auth::user()->roles;
   });
});
