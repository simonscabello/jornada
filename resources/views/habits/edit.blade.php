<x-app-layout>
    <div class="py-4">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white rounded-xl shadow-lg p-6 space-y-8">
                <!-- Header -->
                <div class="border-b border-gray-200 pb-6">
                    <div class="flex justify-between items-center">
                        <h2 class="font-semibold text-xl text-indigo-800 leading-tight">
                            {{ __('Ajustando seu hábito') }}
                        </h2>
                    </div>
                </div>

                <p class="text-gray-600">Ajustar seus hábitos é parte natural do processo de desenvolvimento pessoal. Faça as alterações que achar necessárias.</p>

                <form method="POST" action="{{ route('habits.update', $habit) }}" class="space-y-6">
                    @csrf
                    @method('PUT')

                    <div>
                        <x-input-label for="name" :value="__('Qual hábito você está ajustando?')" />
                        <x-text-input id="name" name="name" type="text" class="mt-1 block w-full" :value="old('name', $habit->name)" required autofocus />
                        <x-input-error class="mt-2" :messages="$errors->get('name')" />
                    </div>

                    <div>
                        <x-input-label for="description" :value="__('Por que este hábito é importante para você?')" />
                        <textarea
                            id="description"
                            name="description"
                            class="mt-1 block w-full border-gray-300 focus:border-indigo-500 focus:ring-indigo-500 rounded-md shadow-sm"
                            rows="3"
                            placeholder="Descreva como este hábito vai impactar positivamente sua vida..."
                        >{{ old('description', $habit->description) }}</textarea>
                        <x-input-error class="mt-2" :messages="$errors->get('description')" />
                    </div>

                    <div class="flex items-center gap-4">
                        <x-primary-button class="bg-indigo-600 hover:bg-indigo-700">{{ __('Salvar Alterações') }}</x-primary-button>
                        <a href="{{ route('habits.show', $habit) }}" class="inline-flex items-center px-4 py-2 bg-indigo-50 border border-transparent rounded-md font-semibold text-xs text-indigo-700 uppercase tracking-widest hover:bg-indigo-100">
                            <svg class="w-4 h-4 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M10 19l-7-7m0 0l7-7m-7 7h18" />
                            </svg>
                            Voltar
                        </a>
                    </div>
                </form>
            </div>
        </div>
    </div>
</x-app-layout>
