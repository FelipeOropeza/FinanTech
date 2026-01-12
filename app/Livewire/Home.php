<?php

namespace App\Livewire;

use Livewire\Attributes\Layout;
use Livewire\Attributes\Title;
use Livewire\Component;
use Illuminate\Support\Facades\Auth;
use App\Models\Transaction;
use Carbon\Carbon;

#[Layout('components.layouts.app')]
class Home extends Component
{
    public $totalEntradasMes = 0;
    public $totalSaidasMes = 0;
    public $saldo = 0;

    #[Title('Home')]
    public function mount()
    {
        $user = Auth::user();

        if (! $user) {
            return;
        }

        $inicioMes = Carbon::now()->startOfMonth();
        $fimMes = Carbon::now()->endOfMonth();

        $baseQuery = Transaction::whereHas(
            'wallet.account',
            fn ($q) => $q->where('user_id', $user->id)
        )->whereBetween('transaction_date', [$inicioMes, $fimMes]);

        $this->totalEntradasMes = (clone $baseQuery)
            ->where('type', 'entrada')
            ->sum('amount');

        $this->totalSaidasMes = (clone $baseQuery)
            ->where('type', 'saida')
            ->sum('amount');

        $this->saldo = $this->totalEntradasMes - $this->totalSaidasMes;
    }

    public function render()
    {
        return view('livewire.home');
    }
}
