<?php

namespace App\Livewire;

use Livewire\Component;
use Illuminate\Support\Facades\Auth;

class NavBar extends Component
{
    public function logout()
    {
        var_dump("Teste");
        Auth::logout();

        request()->session()->invalidate();

        request()->session()->regenerateToken();

        dd(Auth::check(), Auth::user());
    }

    public function render()
    {
        dd(Auth::check(), Auth::user());
        return view('components.layouts.nav-bar');
    }
}
