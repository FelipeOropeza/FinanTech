<div class="container mx-auto px-4 py-12">
    @guest
        <main class="flex-1 flex flex-col items-center justify-center px-4 sm:px-6 lg:px-8 text-center">
            <h1 class="text-4xl sm:text-5xl font-extrabold text-gray-900 mb-6 animate-fade-in">FinanTech</h1>
            <p class="text-lg sm:text-xl text-gray-700 mb-8 max-w-2xl mx-auto animate-fade-in delay-200">
                Controle seu bolso de forma simples e inteligente. Organize suas contas, categorias e transações em um só
                lugar!
            </p>
            <div class="flex flex-wrap justify-center gap-4 mt-6">
                <a href="{{ route('cadastro') ?? '#' }}"
                    class="px-6 py-3 rounded-xl bg-gradient-to-r from-indigo-600 to-blue-600 text-white font-semibold shadow hover:from-indigo-700 hover:to-blue-700 transition">
                    Criar conta grátis
                </a>
                <a href="{{ route('login') }}"
                    class="px-6 py-3 rounded-xl border border-indigo-600 text-indigo-700 font-semibold hover:bg-indigo-50 transition">
                    Entrar
                </a>
            </div>

            <div class="mt-12 grid grid-cols-1 sm:grid-cols-3 gap-6 max-w-5xl mx-auto">
                <div class="p-6 bg-white rounded-2xl shadow-md hover:shadow-lg transition">
                    <h3 class="text-lg font-semibold text-gray-900">Categorias inteligentes</h3>
                    <p class="mt-2 text-gray-500 text-sm">Auto-sugestão por descrição e valor para facilitar o seu controle.
                    </p>
                </div>
                <div class="p-6 bg-white rounded-2xl shadow-md hover:shadow-lg transition">
                    <h3 class="text-lg font-semibold text-gray-900">Relatórios claros</h3>
                    <p class="mt-2 text-gray-500 text-sm">Visualize gráficos por mês, conta e categoria para decisões
                        rápidas.</p>
                </div>
                <div class="p-6 bg-white rounded-2xl shadow-md hover:shadow-lg transition">
                    <h3 class="text-lg font-semibold text-gray-900">Metas e alertas</h3>
                    <p class="mt-2 text-gray-500 text-sm">Receba notificações e defina limites para manter suas finanças no
                        azul.</p>
                </div>
            </div>
        </main>
    @endguest

    @auth
        <main class="flex-1 px-4 sm:px-6 lg:px-8">
            <div class="mx-auto max-w-7xl py-10">
                <h2 class="text-3xl font-bold text-gray-900 mb-6">Bem-vindo de volta, {{ Auth::user()->name }} 👋</h2>
                <p class="text-gray-600 mb-8">Aqui está um resumo do seu mês. Explore e gerencie suas contas facilmente.</p>

                <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-4 gap-6 mb-8">
                    <div class="bg-white p-5 rounded-2xl shadow hover:shadow-md transition">
                        <p class="text-sm text-gray-500">Saldo geral</p>
                        <p class="mt-2 text-2xl font-semibold text-gray-900">R$ {{ number_format($saldo, 2, ',', '.') }}</p>
                    </div>
                    <div class="bg-white p-5 rounded-2xl shadow hover:shadow-md transition">
                        <p class="text-sm text-gray-500">Receitas (mês)</p>
                        <p class="mt-2 text-2xl font-semibold text-emerald-600">R$
                            {{ number_format($totalEntradasMes, 2, ',', '.') }}</p>
                    </div>
                    <div class="bg-white p-5 rounded-2xl shadow hover:shadow-md transition">
                        <p class="text-sm text-gray-500">Despesas (mês)</p>
                        <p class="mt-2 text-2xl font-semibold text-rose-600">R$
                            {{ number_format($totalSaidasMes, 2, ',', '.') }}</p>
                    </div>
                    <div class="bg-white p-5 rounded-2xl shadow hover:shadow-md transition">
                        <p class="text-sm text-gray-500">Economia</p>
                        <p class="mt-2 text-2xl font-semibold text-indigo-700">R$ {{ number_format($saldo, 2, ',', '.') }}
                        </p>
                    </div>
                </div>

            </div>
        </main>
    @endauth
</div>