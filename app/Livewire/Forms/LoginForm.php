<?php

namespace App\Livewire\Forms;

use Livewire\Attributes\Validate;
use Livewire\Form;

class LoginForm extends Form
{
    #[Validate('required|email|min:5|max:100')]
    public string $email = '';

    #[Validate('required|min:8|max:100')]
    public string $password = '';
}
