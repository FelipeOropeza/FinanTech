<?php

namespace App\Livewire;

use App\Models\Account;
use App\Models\Wallet;
use App\Models\Transaction;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Livewire\Component;
use Livewire\Attributes\Layout;

#[Layout('components.layouts.app')]
class Translacao extends Component
{
    public $accounts = [];
    public $wallets = [];
    public $transactions = [];

    public $account_id;
    public $wallet_id;
    public $type = 'entrada';
    public $description;
    public $amount;
    public $transaction_date;

    protected $rules = [
        'account_id' => 'required|exists:accounts,id',
        'wallet_id' => 'required|exists:wallets,id',
        'type' => 'required|in:entrada,saida',
        'description' => 'required|string|max:255',
        'amount' => 'required|numeric|min:0.01',
        'transaction_date' => 'required|date',
    ];

    public function mount()
    {
        $this->accounts = Account::where('user_id', Auth::id())
            ->orderBy('name')
            ->get();

        $this->loadTransactions();
    }

    public function updatedAccountId()
    {
        if (! $this->account_id) {
            $this->wallets = [];
            $this->wallet_id = null;
            return;
        }

        $this->wallets = Wallet::where('account_id', $this->account_id)
            ->orderBy('name')
            ->get();

        $this->wallet_id = null;
    }


    public function save()
    {
        $this->validate();

        DB::transaction(function () {

            $wallet = Wallet::where('id', $this->wallet_id)
                ->where('account_id', $this->account_id)
                ->whereHas('account', fn ($q) =>
                    $q->where('user_id', Auth::id())
                )
                ->lockForUpdate()
                ->firstOrFail();

            if ($this->type === 'entrada') {
                $wallet->increment('balance', $this->amount);
            } else {
                if ($wallet->balance < $this->amount) {
                    $this->addError('amount', 'Saldo insuficiente.');
                    return;
                }
                $wallet->decrement('balance', $this->amount);
            }

            Transaction::create([
                'wallet_id' => $wallet->id,
                'type' => $this->type,
                'description' => $this->description,
                'amount' => $this->amount,
                'transaction_date' => $this->transaction_date,
            ]);
        });

        $this->reset(['wallet_id', 'description', 'amount', 'transaction_date']);
        $this->type = 'entrada';

        $this->loadTransactions();

        session()->flash('success', 'Movimentação registrada com sucesso.');
    }

    public function loadTransactions()
    {
        $this->transactions = Transaction::with('wallet.account')
            ->whereHas('wallet.account', fn ($q) =>
                $q->where('user_id', Auth::id())
            )
            ->latest('transaction_date')
            ->get();
    }

    public function render()
    {
        return view('livewire.translacao');
    }
}
