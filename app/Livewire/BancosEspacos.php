<?php

namespace App\Livewire;

use App\Models\Account;
use App\Models\Wallet;
use Illuminate\Support\Facades\Auth;
use Livewire\Component;
use Livewire\Attributes\Layout;

#[Layout('components.layouts.app')]
class BancosEspacos extends Component
{
    public $accounts;

    public $showAccountForm = false;

    public $account_name;

    public $activeAccount = null;
    public $wallet_name;
    public $wallet_type = 'corrente';
    public $wallet_balance = 0;

    protected $rules = [
        'account_name' => 'required|string|max:255',
        'wallet_name' => 'required|string|max:255',
        'wallet_type' => 'required|in:corrente,reserva,investimento',
        'wallet_balance' => 'required|numeric|min:0',
    ];

    public function mount()
    {
        $this->loadAccounts();
    }

    public function loadAccounts()
    {
        $this->accounts = Account::with('wallets')
            ->where('user_id', Auth::id())
            ->get();
    }

    public function saveAccount()
    {
        $this->validateOnly('account_name');

        Account::create([
            'user_id' => Auth::id(),
            'name' => $this->account_name,
        ]);

        $this->reset('account_name', 'showAccountForm');
        $this->loadAccounts();

        session()->flash('success', 'Conta criada com sucesso!');
    }

    public function openWalletForm($accountId)
    {
        $this->activeAccount = $accountId;
        $this->reset(['wallet_name', 'wallet_type', 'wallet_balance']);
    }

    public function saveWallet()
    {
        $this->validate([
            'wallet_name' => 'required|string|max:255',
            'wallet_type' => 'required|in:corrente,reserva,investimento',
            'wallet_balance' => 'required|numeric|min:0',
        ]);

        Wallet::create([
            'account_id' => $this->activeAccount,
            'name' => $this->wallet_name,
            'type' => $this->wallet_type,
            'balance' => $this->wallet_balance,
        ]);

        $this->reset(['wallet_name', 'wallet_type', 'wallet_balance', 'activeAccount']);

        $this->loadAccounts();

        session()->flash('success', 'Espaço criado com sucesso!');
    }


    public function render()
    {
        return view('livewire.bancos-espacos');
    }
}
