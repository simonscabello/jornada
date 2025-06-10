<x-app-layout>
    <div class="py-4">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white rounded-xl shadow-lg p-6 space-y-8">
                <!-- Header -->
                <div class="border-b border-gray-200 pb-6">
                    <div class="flex justify-between items-center">
                        <h2 class="font-semibold text-xl text-indigo-800 leading-tight">
                            {{ $lifeEvent->title }}
                        </h2>
                        <div class="flex flex-col md:flex-row md:space-x-2 space-y-2 md:space-y-0 items-center">
                            <a href="{{ route('life-events.index') }}" class="w-full md:w-auto inline-flex items-center px-4 py-2 bg-indigo-50 border border-transparent rounded-md font-semibold text-xs text-indigo-700 uppercase tracking-widest hover:bg-indigo-100">
                                <svg class="w-4 h-4 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M10 19l-7-7m0 0l7-7m-7 7h18" />
                                </svg>
                                Voltar
                            </a>
                            <a href="{{ route('life-events.edit', $lifeEvent) }}" class="w-full md:w-auto inline-flex items-center px-4 py-2 bg-indigo-600 border border-transparent rounded-md font-semibold text-xs text-white uppercase tracking-widest hover:bg-indigo-700">
                                <svg class="w-4 h-4 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M11 5H6a2 2 0 00-2 2v11a2 2 0 002 2h11a2 2 0 002-2v-5m-1.414-9.414a2 2 0 112.828 2.828L11.828 15H9v-2.828l8.586-8.586z"/>
                                </svg>
                                Ajustar
                            </a>
                            <form action="{{ route('life-events.destroy', $lifeEvent) }}" method="POST" class="w-full md:w-auto inline">
                                @csrf
                                @method('DELETE')
                                <button type="submit" class="w-full md:w-auto inline-flex items-center px-4 py-2 bg-red-600 border border-transparent rounded-md font-semibold text-xs text-white uppercase tracking-widest hover:bg-red-700" onclick="return confirm('Tem certeza que deseja excluir este evento?')">
                                    <svg class="w-4 h-4 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 7l-.867 12.142A2 2 0 0116.138 21H7.862a2 2 0 01-1.995-1.858L5 7m5 4v6m4-6v6m1-10V4a1 1 0 00-1-1h-4a1 1 0 00-1 1v3M4 7h16" />
                                    </svg>
                                    Excluir
                                </button>
                            </form>
                        </div>
                    </div>
                </div>

                @if (session('success'))
                    <div class="bg-green-100 border border-green-400 text-green-700 px-4 py-3 rounded relative" role="alert">
                        <span class="block sm:inline">{{ session('success') }}</span>
                    </div>
                @endif

                <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                    <!-- Informações do Evento -->
                    <div class="space-y-4">
                        <div>
                            <h3 class="text-lg font-semibold mb-2 text-indigo-800">Detalhes do Evento</h3>
                            <div class="bg-indigo-50 p-4 rounded-lg space-y-4">
                                <div>
                                    <p class="text-sm text-indigo-600">Data</p>
                                    <p class="text-lg font-semibold text-indigo-800">{{ $lifeEvent->event_date->format('d/m/Y') }}</p>
                                </div>
                                <div>
                                    <p class="text-sm text-indigo-600">Tipo</p>
                                    <p class="text-lg font-semibold text-indigo-800">{{ ucfirst($lifeEvent->type) }}</p>
                                </div>
                                @if($lifeEvent->location)
                                    <div>
                                        <p class="text-sm text-indigo-600">Local</p>
                                        <p class="text-lg font-semibold text-indigo-800">{{ $lifeEvent->location }}</p>
                                    </div>
                                @endif
                            </div>
                        </div>

                        @if($lifeEvent->description)
                            <div>
                                <h3 class="text-lg font-semibold mb-2 text-indigo-800">Sobre este momento</h3>
                                <div class="bg-indigo-50 p-4 rounded-lg">
                                    <p class="text-gray-600 whitespace-pre-line">{{ $lifeEvent->description }}</p>
                                </div>
                            </div>
                        @endif
                    </div>

                    <!-- Galeria de Imagens -->
                    @if($lifeEvent->images->count() > 0)
                        <div>
                            <h3 class="text-lg font-semibold mb-4 text-indigo-800">Memórias</h3>
                            <div class="grid grid-cols-2 gap-4">
                                @foreach($lifeEvent->images as $image)
                                    <div class="relative group">
                                        <img src="{{ $image->url }}" alt="{{ $lifeEvent->title }}" class="h-48 w-full object-cover rounded-lg">
                                        <div class="absolute inset-0 bg-black bg-opacity-0 group-hover:bg-opacity-50 transition-all duration-300 rounded-lg flex items-center justify-center opacity-0 group-hover:opacity-100">
                                            <a href="{{ $image->url }}" target="_blank" class="text-white hover:text-indigo-300 transition-colors">
                                                <svg class="w-8 h-8" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 12a3 3 0 11-6 0 3 3 0 016 0z" />
                                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M2.458 12C3.732 7.943 7.523 5 12 5c4.478 0 8.268 2.943 9.542 7-1.274 4.057-5.064 7-9.542 7-4.477 0-8.268-2.943-9.542-7z" />
                                                </svg>
                                            </a>
                                        </div>
                                    </div>
                                @endforeach
                            </div>
                        </div>
                    @endif
                </div>
            </div>
        </div>
    </div>
</x-app-layout>
