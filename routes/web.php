<?php

use App\Livewire\Cadastro;
use App\Livewire\BancosEspacos;
use App\Livewire\Home;
use App\Livewire\Login;
use App\Livewire\Financeiro;
use App\Livewire\Translacao;
use App\Livewire\Plano;
use Illuminate\Support\Facades\Route;

Route::get('/', Home::class)->name('home');
Route::get('/login', Login::class)->name('login');
Route::get('/cadastro', Cadastro::class)->name('cadastro');
Route::get('/financeiro', Financeiro::class)->name('financeiro');
Route::get('/transacoes', Translacao::class)->name('transacoes');
Route::get('/planos', Plano::class)->name('planos');
Route::get('/bancos', BancosEspacos::class)->name('bancos');
