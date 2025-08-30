<div class="p-6 min-h-screen">

    <!-- Título -->
    <h1 class="text-3xl font-bold text-gray-800 mb-2">💰 Financeiro</h1>
    <p class="text-gray-600 mb-6">Bem-vindo à sua área financeira.</p>

    <!-- Ações rápidas -->
    <div class="flex flex-wrap gap-3 mb-8">
        <a href="{{ route('contas') }}"
           class="px-4 py-2 bg-blue-600 text-white rounded-lg hover:bg-blue-700 transition">
            ➕ Nova Conta
        </a>
        <a href="{{ route('categorias') }}"
           class="px-4 py-2 bg-green-600 text-white rounded-lg hover:bg-green-700 transition">
            ➕ Nova Categoria
        </a>
        <a href="{{ route('transacoes') }}"
           class="px-4 py-2 bg-purple-600 text-white rounded-lg hover:bg-purple-700 transition">
            ➕ Novo Lançamento
        </a>
    </div>

    <!-- Cards Resumo -->
    <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-3 gap-6 mb-8">
        <div class="bg-white p-6 rounded-2xl shadow">
            <h2 class="text-sm font-semibold text-gray-500">Entradas</h2>
            <p class="text-2xl font-bold text-green-600 mt-2">
                R$ {{ number_format($totalEntradas, 2, ',', '.') }}
            </p>
        </div>
        <div class="bg-white p-6 rounded-2xl shadow">
            <h2 class="text-sm font-semibold text-gray-500">Saídas</h2>
            <p class="text-2xl font-bold text-red-600 mt-2">
                R$ {{ number_format($totalSaidas, 2, ',', '.') }}
            </p>
        </div>
        <div class="bg-white p-6 rounded-2xl shadow">
            <h2 class="text-sm font-semibold text-gray-500">Saldo</h2>
            <p class="text-2xl font-bold text-blue-600 mt-2">
                R$ {{ number_format($saldo, 2, ',', '.') }}
            </p>
        </div>
    </div>

    <!-- Movimentação + Últimas Transações -->
    <div class="grid grid-cols-1 lg:grid-cols-3 gap-6">

        <!-- Gráfico -->
        <div class="lg:col-span-2 bg-white p-6 rounded-2xl shadow">
            <h2 class="text-lg font-semibold text-gray-700 mb-4">Movimentação Mensal</h2>
            <div class="h-64 flex items-center justify-center text-gray-400 border-2 border-dashed rounded-xl">
                📊 Aqui vai o gráfico
            </div>
        </div>

        <!-- Últimas Transações -->
        <div class="bg-white p-6 rounded-2xl shadow">
            <h2 class="text-lg font-semibold text-gray-700 mb-4">Últimas Transações</h2>
            <ul class="space-y-3 text-sm">
                @forelse($ultimasTransacoes as $transacao)
                    <li class="flex justify-between">
                        <span>{{ $transacao->descricao }}</span>
                        <span class="{{ $transacao->tipo === 'entrada' ? 'text-green-600' : 'text-red-600' }}">
                            {{ $transacao->tipo === 'entrada' ? '+' : '-' }}
                            R$ {{ number_format($transacao->amount, 2, ',', '.') }}
                        </span>
                    </li>
                @empty
                    <li class="text-gray-500">Nenhuma transação encontrada</li>
                @endforelse
            </ul>
        </div>
    </div>

</div>
