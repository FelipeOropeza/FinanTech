<div class="p-6 min-h-screen space-y-8">

    <!-- Título -->
    <div>
        <h1 class="text-3xl font-bold text-gray-800 mb-2">💰 Financeiro</h1>
        <p class="text-gray-600">Bem-vindo à sua área financeira.</p>
    </div>

    <!-- Ações -->
    <div class="flex flex-wrap gap-3">
        <a href="{{ route('contas') }}"
            class="flex items-center gap-2 px-4 py-2 bg-blue-600 text-white rounded-lg hover:bg-blue-700 transition">
            ➕ Nova Conta
        </a>
        <a href="{{ route('categorias') }}"
            class="flex items-center gap-2 px-4 py-2 bg-green-600 text-white rounded-lg hover:bg-green-700 transition">
            🏷️ Nova Categoria
        </a>
        <a href="{{ route('transacoes') }}"
            class="flex items-center gap-2 px-4 py-2 bg-purple-600 text-white rounded-lg hover:bg-purple-700 transition">
            📌 Novo Lançamento
        </a>
    </div>

    <!-- Resumo -->
    <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-3 gap-6">
        <div class="bg-white p-6 rounded-2xl shadow hover:shadow-lg transition transform hover:-translate-y-1">
            <h2 class="text-sm font-semibold text-gray-500">Entradas</h2>
            <p class="text-2xl font-bold text-green-600 mt-2">
                R$ {{ number_format($totalEntradas, 2, ',', '.') }}
            </p>
        </div>
        <div class="bg-white p-6 rounded-2xl shadow hover:shadow-lg transition transform hover:-translate-y-1">
            <h2 class="text-sm font-semibold text-gray-500">Saídas</h2>
            <p class="text-2xl font-bold text-red-600 mt-2">
                R$ {{ number_format($totalSaidas, 2, ',', '.') }}
            </p>
        </div>
        <div class="bg-white p-6 rounded-2xl shadow hover:shadow-lg transition transform hover:-translate-y-1">
            <h2 class="text-sm font-semibold text-gray-500">Saldo</h2>
            <p class="text-2xl font-bold {{ $saldo < 0 ? 'text-red-600' : 'text-blue-600' }} mt-2">
                R$ {{ number_format($saldo, 2, ',', '.') }}
            </p>
        </div>
    </div>

    <!-- Conteúdo -->
    <div class="grid grid-cols-1 lg:grid-cols-3 gap-6">

        <!-- Gráfico -->
        <div class="lg:col-span-2 bg-white p-6 rounded-2xl shadow">
            <div class="flex justify-between items-center mb-4">
                <h2 class="text-lg font-semibold text-gray-700">Movimentação Mensal</h2>
                <button class="text-sm text-blue-600 hover:underline">🔄 Atualizar</button>
            </div>
            <div
                class="h-64 flex items-center justify-center bg-gradient-to-r from-gray-50 to-gray-100 text-gray-400 border-2 border-dashed rounded-xl">
                📊 O gráfico será exibido aqui
            </div>
        </div>

        <!-- Últimas Transações -->
        <div class="bg-white p-6 rounded-2xl shadow">
            <div class="flex justify-between items-center mb-4">
                <h2 class="text-lg font-semibold text-gray-700">Últimas Transações</h2>
                <a href="{{ route('transacoes') }}" class="text-sm text-blue-600 hover:underline">Ver todas</a>
            </div>
            <ul class="space-y-3 text-sm">
                @forelse($ultimasTransacoes as $transacao)
                    <li class="flex justify-between items-center">
                        <div class="flex items-center gap-2">
                            <span class="text-lg">
                                {{ $transacao->type === 'entrada' ? '💰' : '💸' }}
                            </span>
                            <span>{{ $transacao->description }}</span>
                            <span class="text-gray-400 text-xs">({{ $transacao->created_at->format('d/m') }})</span>
                        </div>
                        <span
                            class="{{ $transacao->type === 'entrada' ? 'text-green-600' : 'text-red-600' }} font-semibold">
                            {{ $transacao->type === 'entrada' ? '+' : '-' }}
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