<div>
    <div class="container mx-auto px-4 py-8">
        <h2 class="text-2xl font-bold mb-6 text-center">Nossos Planos</h2>
        @if (session()->has('message'))
            <div class="bg-green-100 border border-green-400 text-green-700 px-4 py-3 rounded relative mb-4" role="alert">
                <span class="block sm:inline">{{ session('message') }}</span>
            </div>
        @endif
        <div class="grid grid-cols-1 md:grid-cols-3 gap-8">
            @foreach ($plans as $plan)
                <div class="bg-white shadow-md rounded-lg p-6 flex flex-col">
                    <h3 class="text-xl font-bold mb-4">{{ $plan->name }}</h3>
                    <p class="text-gray-700 mb-4">{{ $plan->description }}</p>
                    <p class="text-3xl font-bold mb-4">R$ {{ number_format($plan->price, 2, ',', '.') }}</p>
                    <button wire:click="subscribe({{ $plan->id }})" class="mt-auto bg-blue-500 hover:bg-blue-700 text-white font-bold py-2 px-4 rounded">
                        Assinar
                    </button>
                </div>
            @endforeach
        </div>
    </div>
</div>