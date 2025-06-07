<x-app-layout>
    <div class="py-4">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white rounded-xl shadow-lg p-6 space-y-8">
                <!-- Header -->
                <div class="border-b border-gray-200 pb-6">
                    <div class="flex justify-between items-center">
                        <h2 class="font-semibold text-xl text-indigo-800 leading-tight">
                            {{ __('Minhas Coleções') }}
                        </h2>
                        <a href="{{ route('collections.create') }}" class="inline-flex items-center px-4 py-2 bg-indigo-600 border border-transparent rounded-md font-semibold text-xs text-white uppercase tracking-widest hover:bg-indigo-700">
                            <svg class="w-4 h-4 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 4v16m8-8H4" />
                            </svg>
                            Nova Coleção
                        </a>
                    </div>
                </div>

                @if (session('success'))
                    <div class="bg-green-100 border border-green-400 text-green-700 px-4 py-3 rounded relative" role="alert">
                        <span class="block sm:inline">{{ session('success') }}</span>
                    </div>
                @endif

                <div class="mb-6">
                    <h3 class="text-2xl font-bold text-indigo-700">Olá! 👋</h3>
                    <p class="text-gray-600 mt-1">Organize suas ideias, metas e sonhos em coleções temáticas. Cada coleção é um espaço para você guardar o que importa!</p>
                </div>

                @if($collections->isEmpty())
                    <div class="text-center py-8">
                        <svg class="mx-auto h-12 w-12 text-gray-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 11H5m14 0a2 2 0 012 2v6a2 2 0 01-2 2H5a2 2 0 01-2-2v-6a2 2 0 012-2m14 0V9a2 2 0 00-2-2M5 11V9a2 2 0 012-2m0 0V5a2 2 0 012-2h6a2 2 0 012 2v2M7 7h10" />
                        </svg>
                        <h3 class="mt-2 text-sm font-medium text-gray-900">Nenhuma coleção criada</h3>
                        <p class="mt-1 text-sm text-gray-500">Comece organizando suas ideias criando sua primeira coleção.</p>
                        <div class="mt-6">
                            <a href="{{ route('collections.create') }}" class="inline-flex items-center px-4 py-2 bg-indigo-600 border border-transparent rounded-md font-semibold text-xs text-white uppercase tracking-widest hover:bg-indigo-700">
                                <svg class="w-4 h-4 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 4v16m8-8H4" />
                                </svg>
                                Criar Minha Primeira Coleção
                            </a>
                        </div>
                    </div>
                @else
                    <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-6">
                        @foreach($collections as $collection)
                            <div class="relative bg-gradient-to-br from-indigo-50 via-white to-green-50 border rounded-xl shadow-md p-6 transition-all duration-300 hover:shadow-xl hover:scale-105">
                                <div class="flex items-center mb-2">
                                    @if($collection->icon)
                                        <i class="{{ $collection->icon }} text-2xl text-indigo-400 mr-2"></i>
                                    @else
                                        <svg class="w-6 h-6 text-indigo-400 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 11H5m14 0a2 2 0 012 2v6a2 2 0 01-2 2H5a2 2 0 01-2-2v-6a2 2 0 012-2m14 0V9a2 2 0 00-2-2M5 11V9a2 2 0 012-2m0 0V5a2 2 0 012-2h6a2 2 0 012 2v2M7 7h10" />
                                        </svg>
                                    @endif
                                    <h3 class="text-lg font-semibold text-indigo-800">{{ $collection->title }}</h3>
                                </div>
                                @if($collection->type)
                                    <p class="text-gray-600 mb-4">{{ $collection->type }}</p>
                                @endif
                                <div class="flex justify-between items-center mt-4">
                                    <a href="{{ route('collections.show', $collection) }}" class="inline-flex items-center px-4 py-2 bg-gradient-to-r from-indigo-200 to-indigo-400 border border-transparent rounded-md font-semibold text-xs text-indigo-900 uppercase tracking-widest hover:from-indigo-300 hover:to-indigo-500 transition">
                                        <svg class="w-4 h-4 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M10 6H6a2 2 0 00-2 2v10a2 2 0 002 2h10a2 2 0 002-2v-4M14 4h6m0 0v6m0-6L10 14" />
                                        </svg>
                                        Ver Coleção
                                    </a>
                                    <span class="inline-flex items-center px-2 py-1 bg-indigo-100 text-indigo-700 text-xs font-bold rounded-full ml-2">
                                        {{ $collection->completed_items_count }} de {{ $collection->items_count }} concluídos
                                    </span>
                                </div>
                            </div>
                        @endforeach
                    </div>
                @endif
            </div>
        </div>
    </div>
</x-app-layout>
