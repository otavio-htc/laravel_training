<?php

use App\Http\Controllers\MainController;
use App\Http\Controllers\AuthController;
use App\Http\Middleware\CheckIsLogged;
use App\Http\Middleware\CheckIsNotLogged;

use Illuminate\Support\Facades\Route;

// Auth Routes - Usuário não logado
Route::middleware([CheckIsNotLogged::class])->group(function () {
    Route::get('/login', [AuthController::class, 'login']);
    Route::post('/loginSubmit', [AuthController::class, 'loginSubmit'])->name('loginSubmit');
});

// Main Routes
Route::middleware([CheckIsLogged::class])->group(function () {
    Route::get('/', [MainController::class, 'index'])->name('home');
    Route::get('/new-note', [MainController::class, 'newNote'])->name('new-note');

    //Editar nota
    Route::get('/editar/{id}', [MainController::class, 'editarNota'])->name('editar-nota');
    Route::post('/editar/{id}', [MainController::class, 'editarNotaSubmit'])->name('editar-nota-submit');

    //Excluir nota
    Route::get('/excluir/{id}', [MainController::class, 'excluirNota'])->name('excluir-nota');
    Route::post('/excluir/{id}', [MainController::class, 'excluirNotaSubmit'])->name('excluir-nota-submit');


    // Logout
    Route::get('/logout', [AuthController::class, 'logout'])->name('logout');


});