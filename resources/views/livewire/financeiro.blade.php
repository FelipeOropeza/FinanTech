<div class="p-6 min-h-screen space-y-10 bg-gray-50">

    {{-- Cabeçalho --}}
    <div>
        <h1 class="text-3xl font-semibold text-gray-900">Financeiro</h1>
        <p class="text-sm text-gray-500 mt-1">
            Visão geral das suas movimentações financeiras
        </p>
    </div>

    {{-- Ações --}}
    <div class="flex flex-wrap gap-3">
        <a href="{{ route('bancos') }}"
            class="inline-flex items-center rounded-lg px-4 py-2 text-sm font-medium
                   bg-white text-gray-700 border border-gray-200 hover:bg-gray-100 transition">
            Minhas contas
        </a>

        <a href="{{ route('transacoes') }}"
            class="inline-flex items-center rounded-lg px-4 py-2 text-sm font-medium
                   bg-indigo-600 text-white hover:bg-indigo-700 transition">
            Novo lançamento
        </a>
    </div>

    {{-- Cards resumo --}}
    <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-3 gap-6">
        <div class="bg-white p-6 rounded-xl border border-gray-200">
            <p class="text-sm text-gray-500">Entradas</p>
            <p class="mt-2 text-2xl font-semibold text-gray-900">
                R$ {{ number_format($totalEntradas, 2, ',', '.') }}
            </p>
        </div>

        <div class="bg-white p-6 rounded-xl border border-gray-200">
            <p class="text-sm text-gray-500">Saídas</p>
            <p class="mt-2 text-2xl font-semibold text-gray-900">
                R$ {{ number_format($totalSaidas, 2, ',', '.') }}
            </p>
        </div>

        <div class="bg-white p-6 rounded-xl border border-gray-200">
            <p class="text-sm text-gray-500">Saldo atual</p>
            <p
                class="mt-2 text-2xl font-semibold {{ $saldo < 0 ? 'text-red-600' : 'text-emerald-600' }}">
                R$ {{ number_format($saldo, 2, ',', '.') }}
            </p>
        </div>
    </div>

    {{-- Conteúdo principal --}}
    <div class="grid grid-cols-1 lg:grid-cols-3 gap-6">

        {{-- Gráfico --}}
        <div class="lg:col-span-2 bg-white p-6 rounded-xl border border-gray-200">
            <div class="flex items-center justify-between mb-4">
                <h2 class="text-base font-medium text-gray-800">
                    Movimentação mensal
                </h2>
                <button class="text-sm text-gray-500 hover:text-gray-700">
                    Atualizar
                </button>
            </div>

            <div class="h-96">
                <canvas id="graficoMensal"></canvas>
            </div>
        </div>

        {{-- Últimas transações --}}
        <div class="bg-white p-6 rounded-xl border border-gray-200">
            <div class="flex items-center justify-between mb-4">
                <h2 class="text-base font-medium text-gray-800">
                    Últimas transações
                </h2>
                <a href="{{ route('transacoes') }}"
                    class="text-sm text-indigo-600 hover:text-indigo-700">
                    Ver todas
                </a>
            </div>

            <ul class="space-y-4 text-sm">
                @forelse($ultimasTransacoes as $transacao)
                    <li class="flex justify-between items-start">
                        <div>
                            <p class="font-medium text-gray-800">
                                {{ $transacao->description }}
                            </p>
                            <p class="text-xs text-gray-400">
                                {{ $transacao->created_at->format('d/m/Y') }}
                            </p>
                        </div>

                        <span
                            class="font-medium {{ $transacao->type === 'entrada' ? 'text-emerald-600' : 'text-red-600' }}">
                            {{ $transacao->type === 'entrada' ? '+' : '-' }}
                            R$ {{ number_format($transacao->amount, 2, ',', '.') }}
                        </span>
                    </li>
                @empty
                    <li class="text-sm text-gray-500">
                        Nenhuma transação registrada
                    </li>
                @endforelse
            </ul>
        </div>

    </div>
</div>

@push('scripts')
<script>
    document.addEventListener("livewire:navigated", () => {
        const canvas = document.getElementById('graficoMensal');
        if (!canvas) return;

        const ctx = canvas.getContext("2d");

        const labels = @json($labels);
        const entradas = @json($entradas);
        const saidas = @json($saidas);

        new Chart(ctx, {
            type: 'bar',
            data: {
                labels,
                datasets: [
                    {
                        label: 'Entradas',
                        data: entradas,
                        backgroundColor: 'rgba(16, 185, 129, 0.6)',
                        borderRadius: 6
                    },
                    {
                        label: 'Saídas',
                        data: saidas,
                        backgroundColor: 'rgba(239, 68, 68, 0.6)',
                        borderRadius: 6
                    }
                ]
            },
            options: {
                responsive: true,
                plugins: {
                    legend: {
                        position: 'bottom',
                        labels: {
                            font: { size: 12 }
                        }
                    }
                },
                scales: {
                    y: {
                        beginAtZero: true,
                        ticks: {
                            callback: value =>
                                'R$ ' + value.toLocaleString('pt-BR')
                        }
                    }
                }
            }
        });
    });
</script>
@endpush
