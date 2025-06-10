<x-app-layout>
    <div class="py-4">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white rounded-xl shadow-lg p-6 space-y-8">
                <!-- Header -->
                <div class="border-b border-gray-200 pb-6">
                    <div class="flex justify-between items-center">
                        <h2 class="font-semibold text-xl text-indigo-800 leading-tight">
                            {{ $goal->title }}
                        </h2>
                        <div class="flex flex-col md:flex-row md:space-x-2 space-y-2 md:space-y-0 items-center">
                            <a href="{{ route('goals.index') }}" class="w-full md:w-auto inline-flex items-center px-4 py-2 bg-indigo-50 border border-transparent rounded-md font-semibold text-xs text-indigo-700 uppercase tracking-widest hover:bg-indigo-100">
                                <svg class="w-4 h-4 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M10 19l-7-7m0 0l7-7m-7 7h18" />
                                </svg>
                                Voltar
                            </a>
                            <a href="{{ route('goals.edit', $goal) }}" class="w-full md:w-auto inline-flex items-center px-4 py-2 bg-indigo-600 border border-transparent rounded-md font-semibold text-xs text-white uppercase tracking-widest hover:bg-indigo-700">
                                <svg class="w-4 h-4 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M11 5H6a2 2 0 00-2 2v11a2 2 0 002 2h11a2 2 0 002-2v-5m-1.414-9.414a2 2 0 112.828 2.828L11.828 15H9v-2.828l8.586-8.586z"/>
                                </svg>
                                Ajustar
                            </a>
                            <form action="{{ route('goals.destroy', $goal) }}" method="POST" class="w-full md:w-auto inline">
                                @csrf
                                @method('DELETE')
                                <button type="submit" class="w-full md:w-auto inline-flex items-center px-4 py-2 bg-red-600 border border-transparent rounded-md font-semibold text-xs text-white uppercase tracking-widest hover:bg-red-700" onclick="return confirm('Tem certeza que deseja excluir esta meta?')">
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
                    <!-- Informações da Meta -->
                    <div class="space-y-4">
                        <div>
                            <h3 class="text-lg font-semibold mb-2 text-indigo-800">Detalhes da Meta</h3>
                            <div class="bg-indigo-50 p-4 rounded-lg space-y-4">
                                <div>
                                    <p class="text-sm text-indigo-600">Data Alvo</p>
                                    <p class="text-lg font-semibold text-indigo-800">{{ $goal->target_date->format('d/m/Y') }}</p>
                                </div>
                                <div>
                                    <p class="text-sm text-indigo-600">Status</p>
                                    <p class="text-lg font-semibold {{ $goal->is_completed ? 'text-green-600' : 'text-indigo-800' }}">
                                        {{ $goal->is_completed ? 'Concluída' : 'Em Andamento' }}
                                    </p>
                                </div>
                                @if($goal->completed_at)
                                    <div>
                                        <p class="text-sm text-indigo-600">Concluída em</p>
                                        <p class="text-lg font-semibold text-green-600">{{ $goal->completed_at->format('d/m/Y') }}</p>
                                    </div>
                                @endif
                            </div>
                        </div>

                        @if($goal->description)
                            <div>
                                <h3 class="text-lg font-semibold mb-2 text-indigo-800">Sobre esta meta</h3>
                                <div class="bg-indigo-50 p-4 rounded-lg">
                                    <p class="text-gray-600 whitespace-pre-line">{{ $goal->description }}</p>
                                </div>
                            </div>
                        @endif
                    </div>

                    <!-- Ações -->
                    <div>
                        <h3 class="text-lg font-semibold mb-4 text-indigo-800">Ações</h3>
                        <div class="bg-indigo-50 p-4 rounded-lg">
                            @if(!$goal->is_completed)
                                <form action="{{ route('goals.complete', $goal) }}" method="POST" class="space-y-4">
                                    @csrf
                                    <button type="submit" class="w-full inline-flex items-center justify-center px-4 py-2 bg-green-600 border border-transparent rounded-md font-semibold text-xs text-white uppercase tracking-widest hover:bg-green-700">
                                        <svg class="w-4 h-4 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7" />
                                        </svg>
                                        Marcar como Concluída
                                    </button>
                                </form>
                            @else
                                <div class="text-center py-4">
                                    <svg class="mx-auto h-12 w-12 text-green-500" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7" />
                                    </svg>
                                    <p class="mt-2 text-sm text-green-600">Parabéns! Esta meta foi concluída com sucesso! 🎉</p>
                                </div>
                            @endif
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</x-app-layout>
