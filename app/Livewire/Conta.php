<?php

namespace App\Livewire;

use App\Models\Account;
use Illuminate\Support\Facades\Auth;
use Livewire\Attributes\Layout;
use Livewire\Component;

#[Layout('components.layouts.app')]
class Conta extends Component
{
    public $name, $type, $balance;

    protected $rules = [
        'name' => 'required|string|max:255',
        'type' => 'required|in:corrente,poupanca,investimento',
        'balance' => 'required|numeric|min:0',
    ];

    public function save()
    {
        $this->validate();

        Account::create([
            'user_id' => Auth::id(),
            'name' => $this->name,
            'type' => $this->type,
            'balance' => $this->balance,
        ]);

        $this->reset(['name', 'type', 'balance']);
        session()->flash('success', 'Conta criada com sucesso!');
    }

    public function render()
    {
        return view('livewire.conta', [
            'accounts' => Account::where('user_id', Auth::id())->get(),
        ]);
    }
}
