<x-guest-layout>
    <div class="h-screen w-screen fixed inset-0 flex items-center justify-center z-10 bg-gradient-to-br from-indigo-50 via-white to-green-50">
        <div class="w-full sm:max-w-md px-6 py-4 bg-white shadow-md overflow-hidden sm:rounded-lg">
            <div class="mb-6 text-center">
                <h2 class="text-2xl font-bold text-indigo-800">Bem-vindo de volta!</h2>
                <p class="text-gray-600 mt-2">Entre para continuar sua jornada</p>
            </div>

            <!-- Session Status -->
            <x-auth-session-status class="mb-4" :status="session('status')" />

            <form method="POST" action="{{ route('login') }}">
                @csrf

                <!-- Email Address -->
                <div>
                    <x-input-label for="email" :value="__('Email')" class="text-indigo-800" />
                    <x-text-input id="email" class="block mt-1 w-full border-indigo-200 focus:border-indigo-300 focus:ring focus:ring-indigo-200 focus:ring-opacity-50 rounded-md shadow-sm" type="email" name="email" :value="old('email')" required autofocus autocomplete="username" />
                    <x-input-error :messages="$errors->get('email')" class="mt-2" />
                </div>

                <!-- Password -->
                <div class="mt-4">
                    <x-input-label for="password" :value="__('Senha')" class="text-indigo-800" />
                    <x-text-input id="password" class="block mt-1 w-full border-indigo-200 focus:border-indigo-300 focus:ring focus:ring-indigo-200 focus:ring-opacity-50 rounded-md shadow-sm" type="password" name="password" required autocomplete="current-password" />
                    <x-input-error :messages="$errors->get('password')" class="mt-2" />
                </div>

                <!-- Remember Me -->
                <div class="block mt-4">
                    <label for="remember_me" class="inline-flex items-center">
                        <input id="remember_me" type="checkbox" class="rounded border-indigo-200 text-indigo-600 shadow-sm focus:ring-indigo-300" name="remember">
                        <span class="ms-2 text-sm text-gray-600">{{ __('Lembrar-me') }}</span>
                    </label>
                </div>

                <div class="flex items-center justify-between mt-4">
                    @if (Route::has('password.request'))
                        <a class="text-sm text-indigo-600 hover:text-indigo-800 rounded-md focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-indigo-500" href="{{ route('password.request') }}">
                            {{ __('Esqueceu sua senha?') }}
                        </a>
                    @endif

                    <x-primary-button class="ms-3 bg-indigo-600 hover:bg-indigo-700">
                        {{ __('Entrar') }}
                    </x-primary-button>
                </div>
            </form>

            <div class="mt-6 text-center">
                <p class="text-sm text-gray-600">
                    {{ __('Não tem uma conta?') }}
                    <a href="{{ route('register') }}" class="font-medium text-indigo-600 hover:text-indigo-800">
                        {{ __('Registre-se') }}
                    </a>
                </p>
            </div>
        </div>
    </div>
</x-guest-layout>
