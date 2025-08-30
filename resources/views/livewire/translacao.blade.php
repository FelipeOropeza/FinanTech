<div class="p-6">
    <h1 class="text-2xl font-bold mb-4">💰 Transações</h1>

    @if(session('success'))
        <div class="bg-green-100 text-green-800 p-2 rounded mb-4">
            {{ session('success') }}
        </div>
    @endif

    <!-- Formulário -->
    <form wire:submit.prevent="save" class="grid grid-cols-1 md:grid-cols-2 gap-4 mb-6">
        <div>
            <label class="block">Conta</label>
            <select wire:model="account_id" class="w-full border rounded p-2">
                <option value="">Selecione</option>
                @foreach($accounts as $acc)
                    <option value="{{ $acc->id }}">{{ $acc->name }}</option>
                @endforeach
            </select>
            @error('account_id') <span class="text-red-500 text-sm">{{ $message }}</span> @enderror
        </div>

        <div>
            <label class="block">Categoria</label>
            <select wire:model="category_id" class="w-full border rounded p-2">
                <option value="">Selecione</option>
                @foreach($categories as $cat)
                    <option value="{{ $cat->id }}">{{ $cat->name }} ({{ ucfirst($cat->type) }})</option>
                @endforeach
            </select>
            @error('category_id') <span class="text-red-500 text-sm">{{ $message }}</span> @enderror
        </div>

        <div>
            <label class="block">Tipo</label>
            <select wire:model="type" class="w-full border rounded p-2">
                <option value="entrada">Entrada</option>
                <option value="saida">Saída</option>
            </select>
            @error('type') <span class="text-red-500 text-sm">{{ $message }}</span> @enderror
        </div>

        <div>
            <label class="block">Descrição</label>
            <input type="text" wire:model="description" class="w-full border rounded p-2">
            @error('description') <span class="text-red-500 text-sm">{{ $message }}</span> @enderror
        </div>

        <div>
            <label class="block">Valor</label>
            <input type="number" step="0.01" wire:model="amount" class="w-full border rounded p-2">
            @error('amount') <span class="text-red-500 text-sm">{{ $message }}</span> @enderror
        </div>

        <div>
            <label class="block">Data</label>
            <input type="date" wire:model="transaction_date" class="w-full border rounded p-2">
            @error('transaction_date') <span class="text-red-500 text-sm">{{ $message }}</span> @enderror
        </div>

        <div class="col-span-2">
            <button type="submit" class="bg-blue-600 text-white px-4 py-2 rounded">Salvar</button>
        </div>
    </form>

    <!-- Listagem -->
    <table class="w-full border-collapse border">
        <thead>
            <tr class="bg-gray-100">
                <th class="border p-2">Data</th>
                <th class="border p-2">Descrição</th>
                <th class="border p-2">Conta</th>
                <th class="border p-2">Categoria</th>
                <th class="border p-2">Tipo</th>
                <th class="border p-2">Valor</th>
            </tr>
        </thead>
        <tbody>
            @forelse($transactions as $t)
                <tr>
                    <td class="border p-2">{{ \Carbon\Carbon::parse($t->transaction_date)->format('d/m/Y') }}</td>
                    <td class="border p-2">{{ $t->description }}</td>
                    <td class="border p-2">{{ $t->account->name }}</td>
                    <td class="border p-2">{{ $t->category->name }}</td>
                    <td class="border p-2">
                        @if($t->type === 'entrada')
                            <span class="text-green-600 font-semibold">Entrada</span>
                        @else
                            <span class="text-red-600 font-semibold">Saída</span>
                        @endif
                    </td>
                    <td class="border p-2">R$ {{ number_format($t->amount, 2, ',', '.') }}</td>
                </tr>
            @empty
                <tr>
                    <td colspan="6" class="border p-2 text-center text-gray-500">Nenhuma transação registrada</td>
                </tr>
            @endforelse
        </tbody>
    </table>
</div>
