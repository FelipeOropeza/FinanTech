@php
    $user = Auth::user();
    $userSubscription = $userSubscription ?? optional(optional($user)->subscription)->plan_id ?? null;
    $planMeta = [
        1 => ['label' => 'Basic', 'color' => 'text-gray-200', 'bg' => 'bg-gray-700', 'chip' => 'bg-gray-200 text-gray-800'],
        2 => ['label' => 'Pro', 'color' => 'text-green-400', 'bg' => 'bg-green-700', 'chip' => 'bg-green-100 text-green-800'],
        3 => ['label' => 'Gold', 'color' => 'text-yellow-400', 'bg' => 'bg-yellow-700', 'chip' => 'bg-yellow-100 text-yellow-800'],
    ];
    $plan = $planMeta[$userSubscription] ?? ['label' => 'Free', 'color' => 'text-white', 'bg' => 'bg-gray-800', 'chip' => 'bg-blue-100 text-blue-800'];
@endphp

<header x-data="{ open: false, menu: false }"
    class="sticky top-0 z-50 border-b border-gray-200/60 bg-white/80 backdrop-blur">
    <nav class="mx-auto max-w-7xl px-4 sm:px-6 lg:px-8">
        <div class="flex h-16 items-center justify-between">
            <div class="flex items-center gap-3">
                <a href="/" class="flex items-center gap-2 group">
                    <span
                        class="inline-flex h-9 w-9 items-center justify-center rounded-2xl bg-gradient-to-br from-blue-500 to-indigo-600 shadow-sm">
                        <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" fill="currentColor"
                            class="h-5 w-5 text-white">
                            <path
                                d="M12 2a10 10 0 100 20 10 10 0 000-20zm.75 5a.75.75 0 00-1.5 0v.56A3.94 3.94 0 009 11c0 1.657 1.343 3 3 3h.5a2 2 0 110 4h-3a.75.75 0 000 1.5h1.75v.5a.75.75 0 001.5 0v-.56A3.94 3.94 0 0015 13a3.94 3.94 0 00-3-3h-.5a2 2 0 110-4h3a.75.75 0 000-1.5H12.75V7z" />
                        </svg>
                    </span>
                    <span
                        class="text-xl font-semibold tracking-tight text-gray-900 group-hover:text-indigo-700 transition">FinanTech</span>
                </a>
                @auth
                    <span
                        class="hidden sm:inline-flex items-center rounded-full px-2.5 py-1 text-xs font-medium ring-1 ring-inset ring-gray-200 {{ $plan['chip'] }}">Plano:
                        {{ $plan['label'] }}</span>
                @endauth
            </div>

            <div class="hidden md:flex items-center gap-6">
                <a href="/" class="text-sm font-medium text-gray-700 hover:text-gray-900">Home</a>
                @auth
                    <a href="{{ route('planos') }}"
                        class="text-sm font-medium text-gray-700 hover:text-gray-900">Planos</a>
                    <a href="{{ route('financeiro') }}"
                        class="text-sm font-medium text-gray-700 hover:text-gray-900">Financeiro</a>
                @endauth
            </div>

            <div class="flex items-center gap-3">
                @guest
                    <a href="{{ route('login') }}"
                        class="inline-flex items-center rounded-xl px-4 py-2 text-sm font-semibold text-white bg-gradient-to-r from-indigo-600 to-blue-600 shadow hover:from-indigo-700 hover:to-blue-700 focus:outline-none focus:ring-2 focus:ring-indigo-500">Entrar</a>
                    <a href="{{ route('cadastro') ?? '#' }}"
                        class="hidden sm:inline-flex items-center rounded-xl px-4 py-2 text-sm font-semibold text-indigo-700 bg-indigo-50 hover:bg-indigo-100 ring-1 ring-inset ring-indigo-200">Criar
                        conta</a>
                @endguest

                @auth
                    <div class="relative" x-data="{ open:false }">
                        <button @click="open = !open" :aria-expanded="open"
                            class="group flex items-center gap-2 rounded-xl px-3 py-2 text-sm font-semibold text-gray-800 hover:bg-gray-100">
                            <span
                                class="inline-flex h-8 w-8 items-center justify-center rounded-full {{ $plan['bg'] }} {{ $plan['color'] }} font-bold">{{ strtoupper(substr($user->name, 0, 1)) }}</span>
                            <span class="hidden sm:block">{{ $user->name }}</span>
                            <svg class="h-4 w-4 text-gray-500 transition group-hover:text-gray-700" fill="none"
                                viewBox="0 0 24 24" stroke="currentColor">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 9l-7 7-7-7" />
                            </svg>
                        </button>
                        <div x-cloak x-show="open" @click.away="open=false" x-transition
                            class="absolute right-0 mt-2 w-56 overflow-hidden rounded-2xl bg-white shadow-xl ring-1 ring-gray-200">
                            <div class="px-4 py-3">
                                <p class="text-sm text-gray-500">Conectado como</p>
                                <p class="truncate text-sm font-medium text-gray-900">{{ $user->email }}</p>
                            </div>
                            <div class="py-1">
                                <a href="{{ route('financeiro') }}"
                                    class="block px-4 py-2 text-sm text-gray-700 hover:bg-gray-50">Gerenciar Banco</a>
                            </div>
                            <div class="border-t border-gray-100">
                                <form wire:submit="logout">
                                    <button type="submit"
                                        class="w-full text-left px-4 py-2 text-sm text-red-600 hover:bg-red-50">Sair</button>
                                </form>
                            </div>
                        </div>
                    </div>
                @endauth

                <button class="md:hidden inline-flex h-10 w-10 items-center justify-center rounded-xl hover:bg-gray-100"
                    @click="menu=!menu" :aria-expanded="menu">
                    <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" fill="currentColor"
                        class="h-6 w-6 text-gray-700" x-show="!menu">
                        <path d="M4 6h16M4 12h16M4 18h16" />
                    </svg>
                    <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" fill="currentColor"
                        class="h-6 w-6 text-gray-700" x-show="menu">
                        <path fill-rule="evenodd"
                            d="M6.225 4.811a1 1 0 011.414 0L12 9.172l4.361-4.361a1 1 0 111.414 1.414L13.414 10.586l4.361 4.361a1 1 0 01-1.414 1.414L12 12l-4.361 4.361a1 1 0 01-1.414-1.414l4.361-4.361-4.361-4.361a1 1 0 010-1.414z"
                            clip-rule="evenodd" />
                    </svg>
                </button>
            </div>
        </div>

        <div class="md:hidden" x-cloak x-show="menu" x-transition>
            <div class="space-y-1 pb-4 pt-2">
                <a href="/"
                    class="block rounded-lg px-3 py-2 text-base font-medium text-gray-700 hover:bg-gray-100">Home</a>
                @auth
                    <a href="{{ route('planos') }}"
                        class="block rounded-lg px-3 py-2 text-base font-medium text-gray-700 hover:bg-gray-100">Planos</a>
                    <a href="{{ route('financeiro') }}"
                        class="block rounded-lg px-3 py-2 text-base font-medium text-gray-700 hover:bg-gray-100">Financeiro</a>
                @endauth
                @guest
                    <a href="{{ route('login') }}"
                        class="block rounded-lg px-3 py-2 text-base font-medium text-indigo-700 hover:bg-indigo-50 ring-1 ring-inset ring-indigo-200">Entrar</a>
                    <a href="{{ route('cadastro') ?? '#' }}"
                        class="block rounded-lg px-3 py-2 text-base font-medium text-gray-700 hover:bg-gray-100">Criar
                        conta</a>
                @endguest
            </div>
        </div>
    </nav>
</header>