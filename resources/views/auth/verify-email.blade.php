<x-guest-layout>
    <div class="h-screen w-screen fixed inset-0 flex items-center justify-center z-10 bg-gradient-to-br from-indigo-50 via-white to-green-50">
        <div class="w-full sm:max-w-md px-6 py-4 bg-white shadow-md overflow-hidden sm:rounded-lg">
            <div class="mb-6 text-center">
                <h2 class="text-2xl font-bold text-indigo-800">Verificação de Email</h2>
                <p class="text-gray-600 mt-2">Obrigado por se registrar! Por favor, verifique seu email</p>
            </div>

            <div class="mb-4 text-sm text-gray-600">
                {{ __('Obrigado por se registrar! Antes de começar, você poderia verificar seu endereço de e-mail clicando no link que acabamos de enviar para você? Se você não recebeu o e-mail, teremos o prazer de enviar outro.') }}
            </div>

            @if (session('status') == 'verification-link-sent')
                <div class="mb-4 font-medium text-sm text-green-600">
                    {{ __('Um novo link de verificação foi enviado para o endereço de e-mail que você forneceu durante o registro.') }}
                </div>
            @endif

            <div class="mt-4 flex items-center justify-between">
                <form method="POST" action="{{ route('verification.send') }}">
                    @csrf

                    <div>
                        <x-primary-button class="bg-indigo-600 hover:bg-indigo-700">
                            {{ __('Reenviar Email de Verificação') }}
                        </x-primary-button>
                    </div>
                </form>

                <form method="POST" action="{{ route('logout') }}">
                    @csrf

                    <button type="submit" class="text-sm text-indigo-600 hover:text-indigo-800 rounded-md focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-indigo-500">
                        {{ __('Sair') }}
                    </button>
                </form>
            </div>
        </div>
    </div>
</x-guest-layout>
