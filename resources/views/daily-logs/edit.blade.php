<x-app-layout>
    <x-slot name="header">
        <div class="flex justify-between items-center">
            <h2 class="font-semibold text-xl text-indigo-800 leading-tight">
                {{ __('Ajustando seu registro') }}
            </h2>
        </div>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6 text-gray-900">
                    <p class="text-gray-600 mb-6">Ajustar seus registros é uma parte natural do processo de reflexão. Faça as alterações que achar necessárias.</p>

                    <form method="POST" action="{{ route('daily-logs.update', $dailyLog) }}" class="space-y-6">
                        @csrf
                        @method('PUT')

                        <div>
                            <x-input-label for="content" :value="__('Conte um pouco como foi o seu dia')" />
                            <textarea id="content" name="content" class="mt-1 block w-full border-gray-300 focus:border-indigo-500 focus:ring-indigo-500 rounded-md shadow-sm" required placeholder="Como foi seu dia? O que você fez? Como se sentiu?">{{ old('content', $dailyLog->content) }}</textarea>
                            <x-input-error :messages="$errors->get('content')" class="mt-2" />
                        </div>

                        <div>
                            <x-input-label for="mood" :value="__('Como você está se sentindo?')" />
                            <x-text-input id="mood" name="mood" type="text" class="mt-1 block w-full" :value="old('mood', $dailyLog->mood)" placeholder="Ex: Feliz, Calmo, Ansioso, Motivado..." />
                            <x-input-error :messages="$errors->get('mood')" class="mt-2" />
                        </div>

                        <div class="flex items-center gap-4">
                            <x-primary-button class="bg-indigo-600 hover:bg-indigo-700">
                                <svg class="w-4 h-4 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7" />
                                </svg>
                                Salvar Alterações
                            </x-primary-button>
                            <a href="{{ route('daily-logs.show', $dailyLog) }}" class="inline-flex items-center px-4 py-2 bg-indigo-50 border border-transparent rounded-md font-semibold text-xs text-indigo-700 uppercase tracking-widest hover:bg-indigo-100">
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
    </div>
</x-app-layout>
