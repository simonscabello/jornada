<x-guest-layout>
    <div class="h-screen w-screen fixed inset-0 flex items-center justify-center z-10 bg-gradient-to-br from-indigo-50 via-white to-green-50">
        <div class="w-full sm:max-w-md px-6 py-4 bg-white shadow-md overflow-hidden sm:rounded-lg">
            <div class="mb-6 text-center">
                <h2 class="text-2xl font-bold text-indigo-800">Confirmação de Senha</h2>
                <p class="text-gray-600 mt-2">Por favor, confirme sua senha antes de continuar</p>
            </div>

            <div class="mb-4 text-sm text-gray-600">
                {{ __('Esta é uma área segura da aplicação. Por favor, confirme sua senha antes de continuar.') }}
            </div>

            <form method="POST" action="{{ route('password.confirm') }}">
                @csrf

                <!-- Password -->
                <div>
                    <x-input-label for="password" :value="__('Senha')" class="text-indigo-800" />
                    <x-text-input id="password" class="block mt-1 w-full border-indigo-200 focus:border-indigo-300 focus:ring focus:ring-indigo-200 focus:ring-opacity-50 rounded-md shadow-sm" type="password" name="password" required autocomplete="current-password" />
                    <x-input-error :messages="$errors->get('password')" class="mt-2" />
                </div>

                <div class="flex justify-end mt-4">
                    <x-primary-button class="bg-indigo-600 hover:bg-indigo-700">
                        {{ __('Confirmar') }}
                    </x-primary-button>
                </div>
            </form>
        </div>
    </div>
</x-guest-layout>
