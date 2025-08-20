<div>
    <nav class="w-full bg-gray-800 px-6 py-3 flex items-center justify-between">
        <div class="flex items-center">
            <a href="/" class="text-white font-bold text-lg">Home</a>
        </div>

        <div class="relative" x-data="{ open: false }">
            @auth
                <button @click="open = !open" class="text-white font-bold flex items-center gap-2 focus:outline-none">
                    {{ Auth::user()->name }}
                    <svg class="w-4 h-4 transform transition-transform" :class="open ? 'rotate-180' : ''" fill="none"
                        stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 9l-7 7-7-7" />
                    </svg>
                </button>

                <div x-show="open" @click.away="open = false" x-transition
                    class="absolute right-0 mt-2 w-40 bg-white rounded shadow-lg z-50">
                    <form wire:submit="logout">
                        <button type="submit" class="w-full text-left px-4 py-2 text-sm text-gray-700 hover:bg-gray-200">
                            Sair
                        </button>
                    </form>

                </div>
            @else
                <a href="{{ route('login') }}" class="bg-blue-500 hover:bg-blue-700 text-white font-bold py-2 px-4 rounded">
                    Login
                </a>
            @endauth
        </div>
    </nav>
</div>