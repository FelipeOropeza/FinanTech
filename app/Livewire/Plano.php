<?php

namespace App\Livewire;

use App\Models\Plan;
use Illuminate\Support\Facades\Auth;
use Livewire\Component;

class Plano extends Component
{
    public $plans;

    public function mount()
    {
        $this->plans = Plan::all();
    }

    public function render()
    {
        return view('livewire.plano');
    }

    public function subscribe($planId)
    {
        // Lógica para assinar o plano
        // Aqui você integraria com um gateway de pagamento como o Stripe
        // Por enquanto, vamos apenas criar a assinatura no banco

        Auth::user()->subscription()->create([
            'plan_id' => $planId,
            'starts_at' => now(),
            'ends_at' => now()->addMonth(), // Assinatura de 1 mês
        ]);

        session()->flash('message', 'Inscrição realizada com sucesso!');

        return redirect()->to('/');
    }
}