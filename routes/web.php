<?php

use App\Livewire\Cadastro;
use App\Livewire\Categoria;
use App\Livewire\Conta;
use App\Livewire\Home;
use App\Livewire\Login;
use App\Livewire\Financeiro;
use Illuminate\Support\Facades\Route;

Route::get('/', Home::class)->name('home');
Route::get('/login', Login::class)->name('login');
Route::get('/cadastro', Cadastro::class)->name('cadastro');
Route::get('/financeiro', Financeiro::class)->name('financeiro');
Route::get('/contas', Conta::class)->name('contas');
Route::get('/categorias', Categoria::class)->name('categorias');