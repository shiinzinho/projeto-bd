<?php

use App\Http\Controllers\UsuarioController;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

Route::post('store', [UsuarioController::class, 'store']);

Route::get('find/{id}', [UsuarioController::class, 'pesquisarPorId']);

Route::get('find/cpf/{cpf}', [UsuarioController::class, 'pesquisarPorCpf']);

Route::get('/all', [UsuarioController::class, 'retornarTodos']);

Route::post('/name', [UsuarioController::class, 'pesquisarPorNome']);