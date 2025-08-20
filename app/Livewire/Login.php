<?php

namespace App\Livewire;

use App\Livewire\Forms\LoginForm;
use App\Models\User;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Session;
use Livewire\Attributes\Layout;
use Livewire\Component;

#[Layout('components.layouts.app')]
class Login extends Component
{
    public LoginForm $form;

    public function login()
    {
        $this->form->validate();

        if (Auth::attempt(['email' => $this->form->email, 'password' => $this->form->password])) {
            Session::regenerate();
            return redirect()->route('home');
        }

        $this->addError('form.email', 'Invalid email or password.');
    }
    public function render()
    {
        return view('livewire.login');
    }
}
