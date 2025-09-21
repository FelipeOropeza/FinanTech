<?php

namespace App\Livewire;

use App\Models\Transaction;
use Illuminate\Support\Facades\Auth;
use Livewire\Attributes\Layout;
use Livewire\Component;

#[Layout('components.layouts.app')]
class Financeiro extends Component
{
    public $totalEntradas;
    public $totalSaidas;
    public $saldo;
    public $ultimasTransacoes;
    public $labels = [];
    public $entradas = [];
    public $saidas = [];

    public function mount()
    {
        $userId = Auth::id();

        $this->totalEntradas = Transaction::whereHas('account', fn($q) => $q->where('user_id', $userId))
            ->where('type', 'entrada')
            ->sum('amount');

        $this->totalSaidas = Transaction::whereHas('account', fn($q) => $q->where('user_id', $userId))
            ->where('type', 'saida')
            ->sum('amount');

        $this->saldo = $this->totalEntradas - $this->totalSaidas;

        $this->ultimasTransacoes = Transaction::whereHas('account', fn($q) => $q->where('user_id', $userId))
            ->latest('transaction_date')
            ->take(5)
            ->get();

        $dados = Transaction::selectRaw("DATE_FORMAT(transaction_date, '%m/%Y') as mes, type, SUM(amount) as total")
            ->whereHas('account', fn($q) => $q->where('user_id', $userId))
            ->groupBy('mes', 'type')
            ->orderByRaw("MIN(transaction_date)")
            ->get()
            ->groupBy('mes');

        $this->labels = [];
        $this->entradas = [];
        $this->saidas = [];

        $mesesOrdenados = $dados->keys()->sortBy(fn($mes) => \Carbon\Carbon::createFromFormat('m/Y', $mes));

        foreach ($mesesOrdenados as $mes) {
            $this->labels[] = $mes;
            $this->entradas[] = $dados->get($mes)?->where('type', 'entrada')->sum('total') ?? 0;
            $this->saidas[] = $dados->get($mes)?->where('type', 'saida')->sum('total') ?? 0;
        }
    }



    public function render()
    {
        return view('livewire.financeiro');
    }
}
