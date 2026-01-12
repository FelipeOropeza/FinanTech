<?php

namespace App\Livewire;

use App\Models\Transaction;
use Illuminate\Support\Facades\Auth;
use Livewire\Attributes\Layout;
use Livewire\Component;
use Carbon\Carbon;

#[Layout('components.layouts.app')]
class Financeiro extends Component
{
    public $totalEntradas = 0;
    public $totalSaidas = 0;
    public $saldo = 0;
    public $ultimasTransacoes = [];

    public $labels = [];
    public $entradas = [];
    public $saidas = [];

    public function mount()
    {
        $userId = Auth::id();

        if (! $userId) {
            return;
        }

        // Query base: só transações do usuário
        $baseQuery = Transaction::whereHas(
            'wallet.account',
            fn ($q) => $q->where('user_id', $userId)
        );

        // Totais
        $this->totalEntradas = (clone $baseQuery)
            ->where('type', 'entrada')
            ->sum('amount');

        $this->totalSaidas = (clone $baseQuery)
            ->where('type', 'saida')
            ->sum('amount');

        $this->saldo = $this->totalEntradas - $this->totalSaidas;

        // Últimas transações
        $this->ultimasTransacoes = (clone $baseQuery)
            ->with('wallet.account')
            ->latest('transaction_date')
            ->take(5)
            ->get();

        // Dados do gráfico mensal
        $dados = (clone $baseQuery)
            ->selectRaw("
                DATE_FORMAT(transaction_date, '%m/%Y') as mes,
                type,
                SUM(amount) as total
            ")
            ->groupBy('mes', 'type')
            ->orderByRaw("MIN(transaction_date)")
            ->get()
            ->groupBy('mes');

        $mesesOrdenados = $dados->keys()->sortBy(
            fn ($mes) => Carbon::createFromFormat('m/Y', $mes)
        );

        foreach ($mesesOrdenados as $mes) {
            $this->labels[] = $mes;
            $this->entradas[] = $dados[$mes]->where('type', 'entrada')->sum('total') ?? 0;
            $this->saidas[] = $dados[$mes]->where('type', 'saida')->sum('total') ?? 0;
        }
    }

    public function render()
    {
        return view('livewire.financeiro');
    }
}
