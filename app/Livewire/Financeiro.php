<?php

namespace App\Livewire;

use App\Models\Transaction;
use Illuminate\Support\Facades\Auth;
use Livewire\Attributes\Layout;
use Livewire\Component;

#[Layout('components.layouts.banco')]
class Financeiro extends Component
{
    public $totalEntradas;
    public $totalSaidas;
    public $saldo;
    public $ultimasTransacoes;

    public function mount()
    {
        $userId = Auth::id();

        $this->totalEntradas = Transaction::whereHas('account', function ($q) use ($userId) {
            $q->where('user_id', $userId);
        })->where('type', 'entrada')->sum('amount');

        $this->totalSaidas = Transaction::whereHas('account', function ($q) use ($userId) {
            $q->where('user_id', $userId);
        })->where('type', 'saida')->sum('amount');

        $this->ultimasTransacoes = Transaction::whereHas('account', function ($q) use ($userId) {
            $q->where('user_id', $userId);
        })->latest()->take(5)->get();

        $this->saldo = $this->totalEntradas - $this->totalSaidas;
    }

    public function render()
    {
        return view('livewire.financeiro');
    }
}
