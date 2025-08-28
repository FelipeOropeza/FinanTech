<?php

use App\Livewire\Cadastro;
use App\Livewire\Home;
use App\Livewire\Login;
use App\Livewire\Financeiro;
use Illuminate\Support\Facades\Route;

Route::get('/', Home::class)->name('home');
Route::get('/login', Login::class)->name('login');
Route::get('/cadastro', Cadastro::class)->name('cadastro');
Route::get('/financeiro', Financeiro::class)->name('financeiro');