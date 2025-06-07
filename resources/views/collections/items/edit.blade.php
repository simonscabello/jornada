<x-app-layout>
    <x-slot name="header">
        <div class="flex justify-between items-center">
            <div class="flex items-center">
                @if($collection->icon)
                    <i class="{{ $collection->icon }} text-2xl text-indigo-400 mr-3"></i>
                @endif
                <h2 class="font-semibold text-xl text-indigo-800 leading-tight">
                    Editar Item
                </h2>
            </div>
            <div class="flex flex-col md:flex-row md:space-x-4 space-y-2 md:space-y-0 items-center">
                <a href="{{ route('collections.show', $collection) }}" class="w-full md:w-auto inline-flex items-center px-4 py-2 bg-indigo-50 border border-transparent rounded-md font-semibold text-xs text-indigo-700 uppercase tracking-widest hover:bg-indigo-100">
                    <svg class="w-4 h-4 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M10 19l-7-7m0 0l7-7m-7 7h18" />
                    </svg>
                    Voltar
                </a>
            </div>
        </div>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            @if (session('success'))
                <div class="mb-4 bg-green-100 border border-green-400 text-green-700 px-4 py-3 rounded relative" role="alert">
                    <span class="block sm:inline">{{ session('success') }}</span>
                </div>
            @endif

            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6 text-gray-900">
                    <div class="mb-6">
                        <h3 class="text-2xl font-bold text-indigo-700">Editar Item da Coleção</h3>
                        <p class="text-gray-600 mt-1">Ajuste as informações do item conforme necessário.</p>
                    </div>

                    <form method="POST" action="{{ route('collection-items.update', [$collection, $item]) }}" class="space-y-6">
                        @csrf
                        @method('PUT')

                        <div class="space-y-4">
                            <div>
                                <x-input-label for="content" :value="__('Conteúdo')" />
                                <x-text-input id="content" name="content" type="text" class="mt-1 block w-full"
                                    :value="old('content', $item->content)" required placeholder="Digite o conteúdo do item..." />
                                <x-input-error class="mt-2" :messages="$errors->get('content')" />
                            </div>

                            <div>
                                <x-input-label for="notes" :value="__('Notas (opcional)')" />
                                <x-text-input id="notes" name="notes" type="text" class="mt-1 block w-full"
                                    :value="old('notes', $item->notes)" placeholder="Adicione observações ou detalhes sobre o item..." />
                                <x-input-error class="mt-2" :messages="$errors->get('notes')" />
                            </div>

                            <div class="flex items-center">
                                <input type="checkbox" id="done" name="done" value="1"
                                    class="rounded border-gray-300 text-indigo-600 shadow-sm focus:ring-indigo-500"
                                    {{ $item->done ? 'checked' : '' }}>
                                <label for="done" class="ml-2 block text-sm text-gray-900">
                                    Marcar como concluído
                                </label>
                            </div>
                        </div>

                        <div class="flex flex-col md:flex-row items-center space-y-2 md:space-y-0 md:space-x-4">
                            <x-primary-button class="w-full md:w-auto bg-indigo-600 hover:bg-indigo-700">
                                Salvar Alterações
                            </x-primary-button>
                            <a href="{{ route('collections.show', $collection) }}"
                                class="w-full md:w-auto inline-flex items-center px-4 py-2 bg-gray-50 border border-transparent rounded-md font-semibold text-xs text-gray-700 uppercase tracking-widest hover:bg-gray-100">
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
