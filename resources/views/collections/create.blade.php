<x-app-layout>
    <div class="py-4">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white rounded-xl shadow-lg p-6 space-y-8">
                <!-- Header -->
                <div class="border-b border-gray-200 pb-6">
                    <h2 class="font-semibold text-xl text-indigo-800 leading-tight">
                        {{ __('Nova Coleção') }}
                    </h2>
                </div>

                <div>
                    <h3 class="text-2xl font-bold text-indigo-700">Vamos criar uma nova coleção! 🎯</h3>
                    <p class="text-gray-600 mt-1">Dê um nome à sua coleção e personalize-a com um tipo e ícone para identificá-la facilmente.</p>
                </div>

                <form method="POST" action="{{ route('collections.store') }}" class="space-y-6">
                    @csrf

                    <div>
                        <x-input-label for="title" :value="__('Nome da Coleção')" />
                        <x-text-input id="title" name="title" type="text" class="mt-1 block w-full" :value="old('title')" required autofocus placeholder="Ex: Livros para ler, Versículos favoritos, Ideias para projetos..." />
                        <x-input-error class="mt-2" :messages="$errors->get('title')" />
                    </div>

                    <div>
                        <x-input-label for="type" :value="__('Tipo (opcional)')" />
                        <x-text-input id="type" name="type" type="text" class="mt-1 block w-full" :value="old('type')" placeholder="Ex: Leitura, Espiritual, Projetos..." />
                        <p class="mt-1 text-sm text-gray-500">O tipo ajuda a categorizar sua coleção</p>
                        <x-input-error class="mt-2" :messages="$errors->get('type')" />
                    </div>

                    <div>
                        <x-input-label for="icon" :value="__('Ícone (opcional)')" />
                        <x-text-input id="icon" name="icon" type="text" class="mt-1 block w-full" :value="old('icon')" placeholder="Ex: fas fa-book, fas fa-heart, fas fa-lightbulb" />
                        <p class="mt-1 text-sm text-gray-500">Escolha um ícone do Font Awesome para personalizar sua coleção</p>
                        <x-input-error class="mt-2" :messages="$errors->get('icon')" />
                    </div>

                    <div class="flex items-center gap-4">
                        <x-primary-button class="bg-indigo-600 hover:bg-indigo-700">
                            {{ __('Criar Coleção') }}
                        </x-primary-button>
                        <a href="{{ route('collections.index') }}" class="inline-flex items-center px-4 py-2 bg-indigo-50 border border-transparent rounded-md font-semibold text-xs text-indigo-700 uppercase tracking-widest hover:bg-indigo-100">
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
