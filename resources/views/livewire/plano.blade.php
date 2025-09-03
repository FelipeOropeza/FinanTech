<div class="container mx-auto px-4 py-12">
    <h2 class="text-3xl sm:text-4xl font-extrabold mb-8 text-center text-gray-900">Nossos Planos</h2>

    @if (session()->has('message'))
        <div class="bg-green-50 border border-green-400 text-green-800 px-4 py-3 rounded-lg mb-6 shadow" role="alert">
            {{ session('message') }}
        </div>
    @endif

    <div class="grid grid-cols-1 md:grid-cols-3 gap-8">
        @foreach ($plans as $plan)
            <div
                class="bg-white shadow-lg rounded-2xl p-6 flex flex-col transform hover:scale-105 transition-transform duration-300">
                <div class="flex items-center justify-between mb-4">
                    <h3 class="text-2xl font-bold text-gray-900">{{ $plan->name }}</h3>
                    <span
                        class="text-sm font-semibold px-2 py-1 rounded-full bg-indigo-100 text-indigo-700">{{ $plan->type ?? 'Plano' }}</span>
                </div>
                <p class="text-gray-600 mb-6 flex-1">{{ $plan->description }}</p>
                <p class="text-4xl font-extrabold text-gray-900 mb-6">R$ {{ number_format($plan->price, 2, ',', '.') }}</p>

                <button wire:click="subscribe({{ $plan->id }})"
                    class="mt-auto font-bold py-3 px-6 rounded-xl text-white shadow-lg transition-colors duration-300 
                            {{ $userSubscription ? 'bg-gray-400 cursor-not-allowed' : 'bg-gradient-to-r from-indigo-600 to-blue-600 hover:from-indigo-700 hover:to-blue-700' }}"
                    @if($userSubscription) disabled @endif>
                    @if($userSubscription)
                        Já possui assinatura
                    @else
                        Assinar agora
                    @endif
                </button>
            </div>
        @endforeach
    </div>
</div>