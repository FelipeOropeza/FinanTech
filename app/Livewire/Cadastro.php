<?php

namespace App\Livewire;

use App\Livewire\Forms\CadastroForm;
use Livewire\Component;

class Cadastro extends Component
{
    public CadastroForm $form;

    public function cadastrar()
    {
        $this->validate();

        dd('Cadastro realizado com sucesso!', [
            'name' => $this->form->name,
            'email' => $this->form->email,
            'password' => $this->form->password,
            'password_confirmation' => $this->form->password_confirmation,
        ]);
    }

    public function render()
    {
        return view('livewire.cadastro');
    }
}
