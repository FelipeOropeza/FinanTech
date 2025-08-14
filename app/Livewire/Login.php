<?php

namespace App\Livewire;

use Livewire\Attributes\Layout;
use Livewire\Attributes\Title;
use Livewire\Component;

#[Layout('components.layouts.app')]
class Login extends Component
{
    #[Title('Login')]
    public function render()
    {
        return view('livewire.login');
    }
}
