<x-app-layout>
    <x-slot name="header">
        <div class="flex justify-between items-center">
            <h2 class="font-semibold text-xl text-indigo-800 leading-tight">
                {{ __('Editar Meta') }}
            </h2>
            <a href="{{ route('goals.index') }}" class="inline-flex items-center px-4 py-2 bg-indigo-50 border border-transparent rounded-md font-semibold text-xs text-indigo-700 uppercase tracking-widest hover:bg-indigo-100">
                <svg class="w-4 h-4 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M10 19l-7-7m0 0l7-7m-7 7h18" />
                </svg>
                Voltar
            </a>
        </div>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6 text-gray-900">
                    <form method="POST" action="{{ route('goals.update', $goal) }}" class="space-y-6">
                        @csrf
                        @method('PUT')

                        <div>
                            <x-input-label for="title" :value="__('Título da Meta')" />
                            <x-text-input id="title" name="title" type="text" class="mt-1 block w-full" :value="old('title', $goal->title)" required autofocus placeholder="Ex: Aprender a tocar violão" />
                            <x-input-error class="mt-2" :messages="$errors->get('title')" />
                        </div>

                        <div>
                            <x-input-label for="description" :value="__('Descrição')" />
                            <textarea id="description" name="description" class="mt-1 block w-full border-gray-300 focus:border-indigo-500 focus:ring-indigo-500 rounded-md shadow-sm" rows="4" placeholder="Descreva sua meta em detalhes...">{{ old('description', $goal->description) }}</textarea>
                            <x-input-error class="mt-2" :messages="$errors->get('description')" />
                        </div>

                        <div>
                            <x-input-label for="target_date" :value="__('Data Alvo')" />
                            <x-text-input id="target_date" name="target_date" type="date" class="mt-1 block w-full" :value="old('target_date', $goal->target_date->format('Y-m-d'))" required />
                            <p class="mt-1 text-sm text-gray-500">Escolha uma data realista para alcançar sua meta.</p>
                            <x-input-error class="mt-2" :messages="$errors->get('target_date')" />
                        </div>

                        <div class="flex items-center gap-4">
                            <x-primary-button class="inline-flex items-center">
                                <svg class="w-4 h-4 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7" />
                                </svg>
                                {{ __('Atualizar Meta') }}
                            </x-primary-button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</x-app-layout>
