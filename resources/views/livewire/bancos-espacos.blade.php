<div class="p-6 space-y-8">

    {{-- HEADER --}}
    <div class="flex justify-between items-center">
        <h1 class="text-2xl font-semibold text-gray-800">Minhas Contas</h1>

        <button
            wire:click="$set('showAccountForm', true)"
            class="bg-blue-600 text-white px-4 py-2 rounded-lg hover:bg-blue-700">
            Nova Conta
        </button>
    </div>

    {{-- FORM NOVA CONTA --}}
    @if($showAccountForm)
        <div class="bg-white p-6 rounded-2xl shadow space-y-4">
            <h2 class="font-semibold">Criar conta</h2>

            <input
                wire:model.defer="account_name"
                placeholder="Nome do banco (ex: Nubank)"
                class="border rounded-lg p-3 w-full">

            <div class="flex justify-end gap-3">
                <button
                    wire:click="$set('showAccountForm', false)"
                    class="text-gray-500">
                    Cancelar
                </button>

                <button
                    wire:click="saveAccount"
                    class="bg-blue-600 text-white px-6 py-2 rounded-lg">
                    Criar
                </button>
            </div>
        </div>
    @endif

    {{-- LISTA DE CONTAS --}}
    <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
        @foreach($accounts as $account)
            <div class="bg-white p-6 rounded-2xl shadow space-y-4">

                {{-- CABEÇALHO --}}
                <div class="flex justify-between items-center">
                    <h3 class="font-semibold text-gray-800">
                        {{ $account->name }}
                    </h3>

                    <button
                        wire:click="openWalletForm({{ $account->id }})"
                        class="text-sm text-blue-600 hover:underline">
                        + Novo espaço
                    </button>
                </div>

                {{-- ESPAÇOS --}}
                <ul class="space-y-2">
                    @foreach ($account->wallets as $wallet)
                        <li class="flex justify-between text-sm border-b pb-1">
                            <span>
                                {{ $wallet->name }}
                                <span class="text-gray-400">
                                    ({{ ucfirst($wallet->type) }})
                                </span>
                            </span>

                            <span class="font-semibold">
                                R$ {{ number_format($wallet->balance, 2, ',', '.') }}
                            </span>
                        </li>
                    @endforeach
                </ul>

                {{-- FORM NOVO ESPAÇO --}}
                @if($activeAccount === $account->id)
                    <div class="pt-4 border-t space-y-3">
                        <input
                            wire:model.defer="wallet_name"
                            placeholder="Nome do espaço"
                            class="border rounded-lg p-2 w-full">

                        <select
                            wire:model.defer="wallet_type"
                            class="border rounded-lg p-2 w-full">
                            <option value="corrente">Uso diário</option>
                            <option value="reserva">Reserva</option>
                            <option value="investimento">Investimento</option>
                        </select>

                        <input
                            wire:model.defer="wallet_balance"
                            type="number"
                            step="0.01"
                            placeholder="Saldo inicial"
                            class="border rounded-lg p-2 w-full">

                        <button
                            wire:click="saveWallet"
                            class="w-full bg-gray-800 text-white py-2 rounded-lg">
                            Criar espaço
                        </button>
                    </div>
                @endif

            </div>
        @endforeach
    </div>

</div>
