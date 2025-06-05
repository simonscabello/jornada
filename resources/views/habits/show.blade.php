<x-app-layout>
    <x-slot name="header">
        <div class="flex justify-between items-center">
            <h2 class="font-semibold text-xl text-gray-800 leading-tight">
                {{ $habit->name }}
            </h2>
            <div class="flex space-x-2">
                <a href="{{ route('habits.index') }}" class="inline-flex items-center px-4 py-2 bg-gray-600 border border-transparent rounded-md font-semibold text-xs text-white uppercase tracking-widest hover:bg-gray-500">
                    Voltar
                </a>
                <a href="{{ route('habits.edit', $habit) }}" class="inline-flex items-center px-4 py-2 bg-gray-800 border border-transparent rounded-md font-semibold text-xs text-white uppercase tracking-widest hover:bg-gray-700">
                    Editar
                </a>
                <form action="{{ route('habits.destroy', $habit) }}" method="POST" class="inline">
                    @csrf
                    @method('DELETE')
                    <button type="submit" class="inline-flex items-center px-4 py-2 bg-red-600 border border-transparent rounded-md font-semibold text-xs text-white uppercase tracking-widest hover:bg-red-700" onclick="return confirm('Tem certeza que deseja excluir este hábito?')">
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
                                <h3 class="text-lg font-semibold mb-2">Descrição</h3>
                                <p class="text-gray-600">{{ $habit->description ?: 'Sem descrição' }}</p>
                            </div>

                            <div>
                                <h3 class="text-lg font-semibold mb-2">Estatísticas</h3>
                                <div class="grid grid-cols-2 gap-4">
                                    <div class="bg-gray-50 p-4 rounded-lg">
                                        <p class="text-sm text-gray-600">Frequência Semanal</p>
                                        <p class="text-2xl font-bold">{{ $weekly_frequency }}</p>
                                    </div>
                                    <div class="bg-gray-50 p-4 rounded-lg">
                                        <p class="text-sm text-gray-600">Sequência Atual</p>
                                        <p class="text-2xl font-bold">{{ $current_streak }}</p>
                                    </div>
                                </div>
                            </div>

                            <div>
                                <h3 class="text-lg font-semibold mb-2">Progresso Mensal</h3>
                                <div class="bg-gray-50 p-4 rounded-lg">
                                    <div class="flex justify-between mb-2">
                                        <span class="text-sm text-gray-600">Completado</span>
                                        <span class="text-sm font-medium">{{ $monthly_progress['completed_days'] }} / {{ $monthly_progress['total_days'] }}</span>
                                    </div>
                                    <div class="w-full bg-gray-200 rounded-full h-2.5">
                                        <div class="bg-blue-600 h-2.5 rounded-full" style="width: {{ $monthly_progress['percentage'] }}%"></div>
                                    </div>
                                    <p class="text-sm text-gray-600 mt-2">{{ number_format($monthly_progress['percentage'], 1) }}% do mês</p>
                                </div>
                            </div>

                            <form action="{{ route('habits.complete', $habit) }}" method="POST">
                                @csrf
                                <x-primary-button>
                                    Marcar como Completado Hoje
                                </x-primary-button>
                            </form>
                        </div>

                        <!-- Calendário -->
                        <div>
                            <h3 class="text-lg font-semibold mb-4">Calendário</h3>
                            <div class="grid grid-cols-7 gap-1">
                                @foreach(['Dom', 'Seg', 'Ter', 'Qua', 'Qui', 'Sex', 'Sáb'] as $day)
                                    <div class="text-center text-sm font-medium text-gray-500 py-2">
                                        {{ $day }}
                                    </div>
                                @endforeach

                                @foreach($calendar as $day)
                                    <div class="aspect-square p-1">
                                        <div class="h-full w-full rounded-lg flex items-center justify-center text-sm
                                            {{ $day['is_completed'] ? 'bg-green-100 text-green-800' : 'bg-gray-50 text-gray-600' }}
                                            {{ $day['is_today'] ? 'ring-2 ring-blue-500' : '' }}">
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
