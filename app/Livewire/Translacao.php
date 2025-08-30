<?php

namespace App\Livewire;

use App\Models\Account;
use App\Models\Category;
use App\Models\Transaction;
use Illuminate\Support\Facades\Auth;
use Livewire\Component;

class Translacao extends Component
{
    public $transactions;
    public $accounts;
    public $categories;

    // campos do form
    public $account_id;
    public $category_id;
    public $type = 'entrada';
    public $description;
    public $amount;
    public $transaction_date;

    protected $rules = [
        'account_id' => 'required|exists:accounts,id',
        'category_id' => 'required|exists:categories,id',
        'type' => 'required|in:entrada,saida',
        'description' => 'required|string|max:255',
        'amount' => 'required|numeric|min:0',
        'transaction_date' => 'required|date',
    ];

    public function mount()
    {
        $this->accounts = Account::where('user_id', Auth::id())->get();
        $this->categories = Category::where('user_id', Auth::id())->get();
        $this->loadTransactions();
    }

    public function loadTransactions()
    {
        $this->transactions = Transaction::whereHas('account', function($q) {
            $q->where('user_id', Auth::id());
        })
        ->with(['account', 'category'])
        ->orderBy('transaction_date', 'desc')
        ->get();
    }

    public function save()
    {
        $this->validate();

        Transaction::create([
            'account_id' => $this->account_id,
            'category_id' => $this->category_id,
            'type' => $this->type,
            'description' => $this->description,
            'amount' => $this->amount,
            'transaction_date' => $this->transaction_date,
        ]);

        $this->reset(['account_id', 'category_id', 'type', 'description', 'amount', 'transaction_date']);
        $this->type = 'entrada';

        $this->loadTransactions();

        session()->flash('success', 'Transação registrada com sucesso!');
    }

    public function render()
    {
        return view('livewire.translacao');
    }
}
