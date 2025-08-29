<?php

namespace App\Livewire;

use App\Models\Category;
use Illuminate\Support\Facades\Auth;
use Livewire\Attributes\Layout;
use Livewire\Component;

#[Layout('components.layouts.banco')]
class Categoria extends Component
{
    public $name, $type;

    protected $rules = [
        'name' => 'required|string|max:255',
        'type' => 'required|in:entrada,saida',
    ];

    public function save()
    {
        $this->validate();

        Category::create([
            'user_id' => Auth::id(),
            'name' => $this->name,
            'type' => $this->type,
        ]);

        $this->reset(['name', 'type']);
        session()->flash('success', 'Categoria criada com sucesso!');
    }

    public function render()
    {
        return view('livewire.categoria', [
            'categories' => Category::where('user_id', Auth::id())->get(),
        ]);
    }
}
