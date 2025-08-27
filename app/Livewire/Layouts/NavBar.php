<?php

namespace App\Livewire\Layouts;

use Livewire\Component;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Session;
use Illuminate\Support\Facades\Log;

class NavBar extends Component
{
    public $userSubscription;

    public function mount()
    {
        $this->userSubscription = Auth::user()->subscription->plan_id ?? null;
    }

    public function logout()
    {
        try {
            Auth::logout();
            Session::invalidate();
            Session::regenerateToken();
            return redirect()->route('home');
        } catch (\Exception $e) {
            Log::error('Logout failed: ' . $e->getMessage());
            $this->addError('logout', 'Logout failed. Please try again.');
        }
    }

    public function render()
    {
        return view('livewire.nav-bar');
    }
}
