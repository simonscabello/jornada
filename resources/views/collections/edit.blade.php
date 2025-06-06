<x-app-layout>
    <x-slot name="header">
        <div class="flex justify-between items-center">
            <h2 class="font-semibold text-xl text-indigo-800 leading-tight">
                {{ __('Editar Coleção') }}
            </h2>
        </div>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6 text-gray-900">
                    <div class="mb-6">
                        <h3 class="text-2xl font-bold text-indigo-700">Vamos atualizar sua coleção! ✨</h3>
                        <p class="text-gray-600 mt-1">Ajuste os detalhes da sua coleção para mantê-la organizada e personalizada.</p>
                    </div>

                    <form method="POST" action="{{ route('collections.update', $collection) }}" class="space-y-6">
                        @csrf
                        @method('PUT')

                        <div>
                            <x-input-label for="title" :value="__('Nome da Coleção')" />
                            <x-text-input id="title" name="title" type="text" class="mt-1 block w-full" :value="old('title', $collection->title)" required autofocus placeholder="Ex: Livros para ler, Versículos favoritos, Ideias para projetos..." />
                            <x-input-error class="mt-2" :messages="$errors->get('title')" />
                        </div>

                        <div>
                            <x-input-label for="type" :value="__('Tipo (opcional)')" />
                            <x-text-input id="type" name="type" type="text" class="mt-1 block w-full" :value="old('type', $collection->type)" placeholder="Ex: Leitura, Espiritual, Projetos..." />
                            <p class="mt-1 text-sm text-gray-500">O tipo ajuda a categorizar sua coleção</p>
                            <x-input-error class="mt-2" :messages="$errors->get('type')" />
                        </div>

                        <div>
                            <x-input-label for="icon" :value="__('Ícone (opcional)')" />
                            <x-text-input id="icon" name="icon" type="text" class="mt-1 block w-full" :value="old('icon', $collection->icon)" placeholder="Ex: fas fa-book, fas fa-heart, fas fa-lightbulb" />
                            <p class="mt-1 text-sm text-gray-500">Escolha um ícone do Font Awesome para personalizar sua coleção</p>
                            <x-input-error class="mt-2" :messages="$errors->get('icon')" />
                        </div>

                        <div class="flex items-center gap-4">
                            <x-primary-button class="bg-indigo-600 hover:bg-indigo-700">
                                {{ __('Atualizar Coleção') }}
                            </x-primary-button>
                            <a href="{{ route('collections.show', $collection) }}" class="text-sm text-gray-600 hover:text-gray-900">
                                {{ __('Cancelar') }}
                            </a>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</x-app-layout>
