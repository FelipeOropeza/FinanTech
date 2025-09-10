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

        // Totais gerais
        $this->totalEntradas = Transaction::whereHas('account', fn($q) => $q->where('user_id', $userId))
            ->where('type', 'entrada')
            ->sum('amount');

        $this->totalSaidas = Transaction::whereHas('account', fn($q) => $q->where('user_id', $userId))
            ->where('type', 'saida')
            ->sum('amount');

        $this->saldo = $this->totalEntradas - $this->totalSaidas;

        $this->ultimasTransacoes = Transaction::whereHas('account', fn($q) => $q->where('user_id', $userId))
            ->latest()
            ->take(5)
            ->get();

        // Criar range de meses (últimos 6 meses)
        $periodo = collect();
        for ($i = 5; $i >= 0; $i--) {
            $periodo->push(now()->subMonths($i)->format('m/Y'));
        }

        // Buscar dados agrupados
        $dados = Transaction::selectRaw("DATE_FORMAT(created_at, '%m/%Y') as mes, type, SUM(amount) as total")
            ->whereHas('account', fn($q) => $q->where('user_id', $userId))
            ->whereBetween('created_at', [now()->subMonths(5)->startOfMonth(), now()->endOfMonth()])
            ->groupBy('mes', 'type')
            ->orderByRaw("MIN(created_at)")
            ->get()
            ->groupBy('mes');

        // Preencher arrays
        foreach ($periodo as $mes) {
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
