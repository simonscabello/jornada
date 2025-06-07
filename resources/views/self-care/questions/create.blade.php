<x-app-layout>
    <div class="py-4">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white rounded-xl shadow-lg p-6 space-y-8">
                <!-- Header -->
                <div class="border-b border-gray-200 pb-6">
                    <h2 class="font-semibold text-xl text-indigo-800 leading-tight">
                        {{ __('Nova Pergunta de Autocuidado') }}
                    </h2>
                </div>

                <div class="mb-6">
                    <h3 class="text-2xl font-bold text-indigo-700">Crie sua Pergunta 🌟</h3>
                    <p class="text-gray-600 mt-1">Pense em algo que realmente importa para seu bem-estar. Sua pergunta pode inspirar reflexões importantes!</p>
                </div>

                <form method="POST" action="{{ route('self-care.questions.store') }}">
                    @csrf

                    <div>
                        <x-input-label for="question" :value="__('Pergunta')" class="text-indigo-800" />
                        <x-text-input id="question" name="question" type="text" class="mt-1 block w-full border-indigo-300 focus:border-indigo-500 focus:ring-indigo-500" :value="old('question')" required autofocus />
                        <x-input-error class="mt-2" :messages="$errors->get('question')" />
                    </div>

                    <div class="flex items-center justify-end space-x-4">
                        <a href="{{ route('self-care.questions.index') }}" class="inline-flex items-center px-4 py-2 bg-indigo-50 border border-transparent rounded-md font-semibold text-xs text-indigo-700 uppercase tracking-widest hover:bg-indigo-100">
                            <svg class="w-4 h-4 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M10 19l-7-7m0 0l7-7m-7 7h18" />
                            </svg>
                            {{ __('Cancelar') }}
                        </a>
                        <x-primary-button class="bg-indigo-600 hover:bg-indigo-700 text-white">
                            <svg class="w-4 h-4 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7" />
                            </svg>
                            {{ __('Criar Pergunta') }}
                        </x-primary-button>
                    </div>
                </form>
            </div>
        </div>
    </div>
</x-app-layout>
