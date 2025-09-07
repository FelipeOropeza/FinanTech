<div>
    <div
        class="min-h-screen flex flex-col justify-center items-center bg-gradient-to-br from-green-50 to-emerald-100 px-4">
        <div class="bg-white shadow-xl rounded-2xl px-8 pt-10 pb-8 w-full max-w-md border border-gray-100">
            <div class="mb-8 text-center">
                <h2 class="text-3xl font-extrabold text-gray-900 mb-2">Crie sua conta 🚀</h2>
                <p class="text-gray-600 text-sm">Cadastre-se para começar a usar o FinanTech</p>
            </div>

            <form wire:submit="cadastrar" class="space-y-6">
                @csrf
                <div>
                    <label class="block text-gray-700 text-sm font-semibold mb-2" for="name">Nome</label>
                    <input wire:model="form.name"
                        class="shadow-sm border rounded-lg w-full py-3 px-4 text-gray-700 focus:outline-none focus:ring-2 focus:ring-green-500 focus:border-green-500 transition"
                        id="name" name="name" type="text" placeholder="Seu nome completo" autofocus>
                    @error('form.name') <span class="text-red-500 text-sm mt-1">{{ $message }}</span> @enderror
                </div>

                <div>
                    <label class="block text-gray-700 text-sm font-semibold mb-2" for="email">Email</label>
                    <input wire:model="form.email"
                        class="shadow-sm border rounded-lg w-full py-3 px-4 text-gray-700 focus:outline-none focus:ring-2 focus:ring-green-500 focus:border-green-500 transition"
                        id="email" name="email" type="email" placeholder="seu@email.com">
                    @error('form.email') <span class="text-red-500 text-sm mt-1">{{ $message }}</span> @enderror
                </div>

                <div>
                    <label class="block text-gray-700 text-sm font-semibold mb-2" for="password">Senha</label>
                    <input wire:model="form.password"
                        class="shadow-sm border rounded-lg w-full py-3 px-4 text-gray-700 focus:outline-none focus:ring-2 focus:ring-green-500 focus:border-green-500 transition"
                        id="password" name="password" type="password" placeholder="••••••••">
                    @error('form.password') <span class="text-red-500 text-sm mt-1">{{ $message }}</span> @enderror
                </div>

                <div>
                    <label class="block text-gray-700 text-sm font-semibold mb-2" for="password_confirmation">Confirmar
                        Senha</label>
                    <input wire:model="form.password_confirmation"
                        class="shadow-sm border rounded-lg w-full py-3 px-4 text-gray-700 focus:outline-none focus:ring-2 focus:ring-green-500 focus:border-green-500 transition"
                        id="password_confirmation" name="password_confirmation" type="password" placeholder="••••••••">
                    @error('form.password_confirmation') <span class="text-red-500 text-sm mt-1">{{ $message }}</span>
                    @enderror
                </div>

                <div class="flex items-center justify-between">
                    <button
                        class="bg-gradient-to-r from-green-600 to-emerald-600 hover:from-green-700 hover:to-emerald-700 text-white font-bold py-3 px-6 rounded-xl shadow-md transition focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-green-500"
                        type="submit">
                        Cadastrar
                    </button>
                    <a href="{{ route('login') }}"
                        class="text-sm font-semibold text-green-600 hover:text-green-800 transition">
                        Já tem conta? Entrar
                    </a>
                </div>
            </form>
        </div>
    </div>
</div>