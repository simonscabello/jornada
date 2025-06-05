<x-app-layout>
    <x-slot name="header">
        <div class="flex justify-between items-center">
            <h2 class="font-semibold text-xl text-indigo-800 leading-tight">
                {{ $goal->title }}
            </h2>
            <div class="flex space-x-2">
                <a href="{{ route('goals.index') }}" class="inline-flex items-center px-4 py-2 bg-indigo-50 border border-transparent rounded-md font-semibold text-xs text-indigo-700 uppercase tracking-widest hover:bg-indigo-100">
                    <svg class="w-4 h-4 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M10 19l-7-7m0 0l7-7m-7 7h18" />
                    </svg>
                    Voltar
                </a>
                <a href="{{ route('goals.edit', $goal) }}" class="inline-flex items-center px-4 py-2 bg-indigo-600 border border-transparent rounded-md font-semibold text-xs text-white uppercase tracking-widest hover:bg-indigo-700">
                    <svg class="w-4 h-4 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M11 5H6a2 2 0 00-2 2v11a2 2 0 002 2h11a2 2 0 002-2v-5m-1.414-9.414a2 2 0 112.828 2.828L11.828 15H9v-2.828l8.586-8.586z"/>
                    </svg>
                    Ajustar
                </a>
                <form action="{{ route('goals.destroy', $goal) }}" method="POST" class="inline">
                    @csrf
                    @method('DELETE')
                    <button type="submit" class="inline-flex items-center px-4 py-2 bg-red-600 border border-transparent rounded-md font-semibold text-xs text-white uppercase tracking-widest hover:bg-red-700" onclick="return confirm('Tem certeza que deseja excluir esta meta?')">
                        <svg class="w-4 h-4 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 7l-.867 12.142A2 2 0 0116.138 21H7.862a2 2 0 01-1.995-1.858L5 7m5 4v6m4-6v6m1-10V4a1 1 0 00-1-1h-4a1 1 0 00-1 1v3M4 7h16" />
                        </svg>
                        Excluir
                    </button>
                </form>
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
                    <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                        <!-- Informações da Meta -->
                        <div class="space-y-4">
                            <div>
                                <h3 class="text-lg font-semibold mb-2 text-indigo-800">Descrição</h3>
                                <p class="text-gray-600">{{ $goal->description ?: 'Você ainda não descreveu esta meta.' }}</p>
                            </div>
                            <div>
                                <h3 class="text-lg font-semibold mb-2 text-indigo-800">Data Alvo</h3>
                                <p class="text-gray-600">{{ $goal->target_date->format('d/m/Y') }}</p>
                            </div>
                            <div>
                                <h3 class="text-lg font-semibold mb-2 text-indigo-800">Status</h3>
                                @if($goal->is_completed)
                                    <span class="inline-flex items-center px-2 py-1 bg-green-100 text-green-700 text-xs font-bold rounded-full animate-pulse">
                                        <svg class="w-4 h-4 mr-1" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7" />
                                        </svg>
                                        Concluída em {{ $goal->completed_at ? $goal->completed_at->format('d/m/Y') : '' }}
                                    </span>
                                @elseif($goal->target_date->isPast())
                                    <span class="inline-flex items-center px-2 py-1 bg-red-100 text-red-700 text-xs font-bold rounded-full">
                                        <svg class="w-4 h-4 mr-1" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12l2 2 4-4m6 2a9 9 0 11-18 0 9 9 0 0118 0z" />
                                        </svg>
                                        Vencida
                                    </span>
                                @else
                                    <span class="inline-flex items-center px-2 py-1 bg-indigo-100 text-indigo-700 text-xs font-bold rounded-full">
                                        <svg class="w-4 h-4 mr-1" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12l2 2 4-4m6 2a9 9 0 11-18 0 9 9 0 0118 0z" />
                                        </svg>
                                        Em andamento
                                    </span>
                                @endif
                            </div>
                        </div>
                        <!-- Espaço para evolução futura: progresso, gráficos, etc. -->
                        <div class="flex flex-col justify-center items-center">
                            @if(!$goal->is_completed)
                                <form action="{{ route('goals.complete', $goal) }}" method="POST">
                                    @csrf
                                    <x-primary-button class="bg-indigo-600 hover:bg-indigo-700">
                                        <svg class="w-4 h-4 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7" />
                                        </svg>
                                        Marcar como Concluída
                                    </x-primary-button>
                                </form>
                            @endif
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</x-app-layout>
