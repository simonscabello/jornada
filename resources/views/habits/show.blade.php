<x-app-layout>
    <x-slot name="header">
        <div class="flex justify-between items-center">
            <h2 class="font-semibold text-xl text-indigo-800 leading-tight">
                {{ $habit->name }}
            </h2>
            <div class="flex flex-col md:flex-row md:space-x-2 space-y-2 md:space-y-0 items-center">
                <a href="{{ route('habits.index') }}" class="w-full md:w-auto inline-flex items-center px-4 py-2 bg-indigo-50 border border-transparent rounded-md font-semibold text-xs text-indigo-700 uppercase tracking-widest hover:bg-indigo-100">
                    <svg class="w-4 h-4 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M10 19l-7-7m0 0l7-7m-7 7h18" />
                    </svg>
                    Voltar
                </a>
                <a href="{{ route('habits.edit', $habit) }}" class="w-full md:w-auto inline-flex items-center px-4 py-2 bg-indigo-600 border border-transparent rounded-md font-semibold text-xs text-white uppercase tracking-widest hover:bg-indigo-700">
                    <svg class="w-4 h-4 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M11 5H6a2 2 0 00-2 2v11a2 2 0 002 2h11a2 2 0 002-2v-5m-1.414-9.414a2 2 0 112.828 2.828L11.828 15H9v-2.828l8.586-8.586z"/>
                    </svg>
                    Ajustar
                </a>
                <form action="{{ route('habits.destroy', $habit) }}" method="POST" class="w-full md:w-auto inline">
                    @csrf
                    @method('DELETE')
                    <button type="submit" class="w-full md:w-auto inline-flex items-center px-4 py-2 bg-red-600 border border-transparent rounded-md font-semibold text-xs text-white uppercase tracking-widest hover:bg-red-700" onclick="return confirm('Tem certeza que deseja excluir este hábito?')">
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
                        <!-- Informações do Hábito -->
                        <div class="space-y-4">
                            <div>
                                <h3 class="text-lg font-semibold mb-2 text-indigo-800">Por que este hábito é importante?</h3>
                                <p class="text-gray-600">{{ $habit->description ?: 'Você ainda não definiu por que este hábito é importante para você.' }}</p>
                            </div>

                            <div>
                                <h3 class="text-lg font-semibold mb-2 text-indigo-800">Seu Progresso</h3>
                                <div class="grid grid-cols-2 gap-4">
                                    <div class="bg-indigo-50 p-4 rounded-lg">
                                        <p class="text-sm text-indigo-600">Frequência Semanal</p>
                                        <p class="text-2xl font-bold text-indigo-800">{{ $weekly_frequency }}</p>
                                    </div>
                                    <div class="bg-indigo-50 p-4 rounded-lg">
                                        <p class="text-sm text-indigo-600">Sequência Atual</p>
                                        <p class="text-2xl font-bold text-indigo-800">{{ $current_streak }}</p>
                                    </div>
                                </div>
                            </div>

                            <div>
                                <h3 class="text-lg font-semibold mb-2 text-indigo-800">Progresso do Mês</h3>
                                <div class="bg-indigo-50 p-4 rounded-lg">
                                    <div class="flex justify-between mb-2">
                                        <span class="text-sm text-indigo-600">Dias Completados</span>
                                        <span class="text-sm font-medium text-indigo-800">{{ $monthly_progress['completed_days'] }} / {{ $monthly_progress['total_days'] }}</span>
                                    </div>
                                    <div class="w-full bg-indigo-100 rounded-full h-2.5">
                                        <div class="bg-indigo-600 h-2.5 rounded-full" style="width: {{ $monthly_progress['percentage'] }}%"></div>
                                    </div>
                                    <p class="text-sm text-indigo-600 mt-2">{{ number_format($monthly_progress['percentage'], 1) }}% do mês</p>
                                </div>
                            </div>

                            <form action="{{ route('habits.complete', $habit) }}" method="POST">
                                @csrf
                                <x-primary-button class="bg-indigo-600 hover:bg-indigo-700">
                                    <svg class="w-4 h-4 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7" />
                                    </svg>
                                    Marcar como Completado Hoje
                                </x-primary-button>
                            </form>
                        </div>

                        <!-- Calendário -->
                        <div>
                            <h3 class="text-lg font-semibold mb-4 text-indigo-800">Seu Calendário</h3>
                            <div class="grid grid-cols-7 gap-1">
                                @foreach(['Dom', 'Seg', 'Ter', 'Qua', 'Qui', 'Sex', 'Sáb'] as $day)
                                    <div class="text-center text-sm font-medium text-indigo-600 py-2">
                                        {{ $day }}
                                    </div>
                                @endforeach

                                @foreach($calendar as $day)
                                    <div class="aspect-square p-1">
                                        <div class="h-full w-full rounded-lg flex items-center justify-center text-sm
                                            {{ $day['is_completed'] ? 'bg-indigo-100 text-indigo-800' : 'bg-gray-50 text-gray-600' }}
                                            {{ $day['is_today'] ? 'ring-2 ring-indigo-500' : '' }}">
                                            {{ $day['day'] }}
                                        </div>
                                    </div>
                                @endforeach
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</x-app-layout>
