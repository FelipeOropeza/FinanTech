<?php

namespace App\Livewire;

use App\Livewire\Forms\LoginForm;
use App\Models\User;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Livewire\Attributes\Layout;
use Livewire\Component;

#[Layout('components.layouts.app')]
class Login extends Component
{
    public LoginForm $form;

    public function login()
    {
        $this->form->validate();

        $user = User::where('email', $this->form->email)->first();

        if ($user && Hash::check($this->form->password, $user->password)) {
            session()->regenerate();
            Auth::login($user);
            return redirect()->route('home');
        }

        $this->addError('form.email', 'Invalid email or password.');
    }
    public function render()
    {
        return view('livewire.login');
    }
}
