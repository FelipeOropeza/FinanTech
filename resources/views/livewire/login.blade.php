<div>
    <div
        class="min-h-screen flex flex-col justify-center items-center bg-gradient-to-br from-indigo-50 to-blue-100 px-4">
        <div class="bg-white shadow-xl rounded-2xl px-8 pt-10 pb-8 w-full max-w-md border border-gray-100">
            <div class="mb-8 text-center">
                <h2 class="text-3xl font-extrabold text-gray-900 mb-2">Bem-vindo de volta 👋</h2>
                <p class="text-gray-600 text-sm">Acesse sua conta para continuar</p>
            </div>
            <form method="POST" wire:submit="login" class="space-y-6">
                @csrf
                <div>
                    <label class="block text-gray-700 text-sm font-semibold mb-2" for="email">Email</label>
                    <input wire:model="form.email"
                        class="shadow-sm border rounded-lg w-full py-3 px-4 text-gray-700 focus:outline-none focus:ring-2 focus:ring-indigo-500 focus:border-indigo-500 transition"
                        id="email" name="email" type="email" placeholder="seu@email.com" autofocus>
                    @error('form.email') <span class="text-red-500 text-sm mt-1">{{ $message }}</span> @enderror
                </div>
                <div>
                    <label class="block text-gray-700 text-sm font-semibold mb-2" for="password">Senha</label>
                    <input wire:model="form.password"
                        class="shadow-sm border rounded-lg w-full py-3 px-4 text-gray-700 focus:outline-none focus:ring-2 focus:ring-indigo-500 focus:border-indigo-500 transition"
                        id="password" name="password" type="password" placeholder="••••••••">
                    @error('form.password') <span class="text-red-500 text-sm mt-1">{{ $message }}</span> @enderror
                </div>
                <div class="flex items-center justify-between">
                    <button
                        class="bg-gradient-to-r from-indigo-600 to-blue-600 hover:from-indigo-700 hover:to-blue-700 text-white font-bold py-3 px-6 rounded-xl shadow-md transition focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-indigo-500"
                        type="submit">Entrar</button>
                    <a href="{{ route('cadastro') }}"
                        class="font-semibold text-sm text-indigo-600 hover:text-indigo-800 transition">Não tem
                        cadastro?</a>
                </div>
            </form>
        </div>
    </div>
</div>