<?php

namespace App\Livewire;

use App\Livewire\Forms\CadastroForm;
use App\Models\User;
use Livewire\Component;

class Cadastro extends Component
{
    public CadastroForm $form;

    public function cadastrar()
    {
        $this->validate();

        User::create($this->form->all());

        $this->form->reset();

        return redirect()->route('login');
    }

    public function render()
    {
        return view('livewire.cadastro');
    }
}
