<div class="max-w-7xl mx-auto p-6 space-y-8">

    <h1 class="text-2xl font-semibold text-gray-800">
        Movimentações Financeiras
    </h1>

    @if (session('success'))
        <div class="bg-emerald-100 text-emerald-800 px-4 py-3 rounded-md text-sm">
            {{ session('success') }}
        </div>
    @endif

    {{-- FORM --}}
    <form wire:submit.prevent="save" class="bg-white rounded-xl shadow-sm p-6 grid grid-cols-1 md:grid-cols-6 gap-4">

        {{-- Banco --}}
        <div class="md:col-span-2">
            <label class="text-sm text-gray-600">Banco</label>
            <select wire:model.live="account_id"
                class="w-full border rounded-md px-3 py-2 text-sm focus:ring focus:ring-blue-200">
                <option value="">Selecione</option>
                @foreach ($accounts as $acc)
                    <option value="{{ $acc->id }}">{{ $acc->name }}</option>
                @endforeach
            </select>
        </div>

        {{-- Categoria --}}
        <div class="md:col-span-2">
            <label class="text-sm text-gray-600">Categoria</label>
            <select wire:model.live="wallet_id" class="w-full border rounded-md px-3 py-2 text-sm disabled:bg-gray-100"
                @disabled(!$account_id)>
                <option value="">
                    {{ $account_id ? 'Selecione um espaço' : 'Escolha um banco primeiro' }}
                </option>

                @foreach ($wallets as $w)
                    <option value="{{ $w->id }}">
                        {{ $w->name }}
                    </option>
                @endforeach
            </select>

        </div>

        {{-- Tipo --}}
        <div>
            <label class="text-sm text-gray-600">Tipo</label>
            <select wire:model="type" class="w-full border rounded-md px-3 py-2 text-sm">
                <option value="entrada">Entrada</option>
                <option value="saida">Saída</option>
            </select>
        </div>

        {{-- Valor --}}
        <div>
            <label class="text-sm text-gray-600">Valor</label>
            <input wire:model="amount" type="number" step="0.01" class="w-full border rounded-md px-3 py-2 text-sm">
        </div>

        {{-- Descrição --}}
        <div class="md:col-span-4">
            <label class="text-sm text-gray-600">Descrição</label>
            <input wire:model="description" class="w-full border rounded-md px-3 py-2 text-sm">
        </div>

        {{-- Data --}}
        <div class="md:col-span-2">
            <label class="text-sm text-gray-600">Data</label>
            <input wire:model="transaction_date" type="date" class="w-full border rounded-md px-3 py-2 text-sm">
        </div>

        <div class="md:col-span-6 flex justify-end">
            <button class="bg-blue-600 text-white px-6 py-2 rounded-md text-sm hover:bg-blue-700">
                Salvar movimentação
            </button>
        </div>
    </form>

    {{-- LISTA --}}
    <div class="bg-white rounded-xl shadow-sm p-6">
        <h2 class="text-lg font-semibold text-gray-700 mb-4">
            Histórico
        </h2>

        <table class="w-full text-sm text-gray-700">
            <thead class="border-b text-gray-500">
                <tr>
                    <th class="py-2 text-left">Data</th>
                    <th>Banco</th>
                    <th>Categoria</th>
                    <th>Descrição</th>
                    <th>Tipo</th>
                    <th class="text-right">Valor</th>
                </tr>
            </thead>
            <tbody>
                @foreach ($transactions as $t)
                    <tr class="border-b last:border-0">
                        <td class="py-2">
                            {{ \Carbon\Carbon::parse($t->transaction_date)->format('d/m/Y') }}
                        </td>
                        <td>{{ $t->wallet->account->name }}</td>
                        <td>{{ $t->wallet->name }}</td>
                        <td>{{ $t->description }}</td>
                        <td class="{{ $t->type === 'entrada' ? 'text-emerald-600' : 'text-red-600' }}">
                            {{ ucfirst($t->type) }}
                        </td>
                        <td class="text-right font-medium">
                            R$ {{ number_format($t->amount, 2, ',', '.') }}
                        </td>
                    </tr>
                @endforeach
            </tbody>
        </table>
    </div>

</div>
