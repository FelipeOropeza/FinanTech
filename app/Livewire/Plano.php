<?php

namespace App\Livewire;

use App\Models\Plan;
use Illuminate\Support\Facades\Auth;
use Livewire\Component;

class Plano extends Component
{
    public $plans;
    public $userSubscription;

    public function mount()
    {
        $this->plans = Plan::all();
        $this->userSubscription = Auth::user()->subscription; // Assumindo relação 1:1
    }

    public function render()
    {
        return view('livewire.plano');
    }

    public function subscribe($planId)
    {
        if ($this->userSubscription) {
            session()->flash('message', 'Você já possui uma assinatura ativa!');
            return;
        }

        Auth::user()->subscription()->create([
            'plan_id'   => $planId,
            'starts_at' => now(),
            'ends_at'   => now()->addMonth(),
        ]);

        session()->flash('message', 'Inscrição realizada com sucesso!');

        return redirect()->to('/');
    }
}
