<div class="p-6 bg-white rounded-2xl shadow">
    <h2 class="text-xl font-semibold mb-4">Cadastrar Categoria</h2>

    @if (session('success'))
        <div class="mb-4 p-2 bg-green-100 text-green-700 rounded">
            {{ session('success') }}
        </div>
    @endif

    <form wire:submit.prevent="save" class="space-y-4">
        <input type="text" wire:model="name" placeholder="Nome da categoria (ex: Alimentação)"
            class="w-full border rounded p-2" />

        <select wire:model="type" class="w-full border rounded p-2">
            <option value="">Selecione o tipo</option>
            <option value="entrada">Entrada</option>
            <option value="saida">Saída</option>
        </select>

        <button type="submit"
            class="px-4 py-2 bg-blue-600 text-white rounded hover:bg-blue-700 transition">
            Salvar
        </button>
    </form>

    <h3 class="mt-6 font-semibold">Minhas Categorias</h3>
    <ul class="mt-2 space-y-2">
        @foreach ($categories as $cat)
            <li class="flex justify-between border-b pb-1">
                <span>{{ $cat->name }}</span>
                <span class="text-gray-500">{{ ucfirst($cat->type) }}</span>
            </li>
        @endforeach
    </ul>
</div>
