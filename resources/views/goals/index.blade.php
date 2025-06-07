<x-app-layout>
    <div class="py-4">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white rounded-xl shadow-lg p-6 space-y-8">
                <!-- Header -->
                <div class="border-b border-gray-200 pb-6">
                    <div class="flex justify-between items-center">
                        <h2 class="font-semibold text-xl text-indigo-800 leading-tight">
                            {{ __('Minhas Metas e Objetivos') }}
                        </h2>
                        <a href="{{ route('goals.create') }}" class="inline-flex items-center px-4 py-2 bg-indigo-600 border border-transparent rounded-md font-semibold text-xs text-white uppercase tracking-widest hover:bg-indigo-700">
                            <svg class="w-4 h-4 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 4v16m8-8H4" />
                            </svg>
                            Nova Meta
                        </a>
                    </div>
                </div>

                @if (session('success'))
                    <div class="bg-green-100 border border-green-400 text-green-700 px-4 py-3 rounded relative" role="alert">
                        <span class="block sm:inline">{{ session('success') }}</span>
                    </div>
                @endif

                <div class="mb-6">
                    <h3 class="text-2xl font-bold text-indigo-700">Vamos juntos conquistar seus sonhos! ✨</h3>
                    <p class="text-gray-600 mt-1">Aqui estão suas metas. Lembre-se: cada passo te aproxima do seu objetivo!</p>
                </div>

                @if($activeGoals->isEmpty() && $completedGoals->isEmpty() && $overdueGoals->isEmpty())
                    <div class="text-center py-8">
                        <svg class="mx-auto h-12 w-12 text-gray-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5H7a2 2 0 00-2 2v12a2 2 0 002 2h10a2 2 0 002-2V7a2 2 0 00-2-2h-2M9 5a2 2 0 002 2h2a2 2 0 002-2M9 5a2 2 0 012-2h2a2 2 0 012 2" />
                        </svg>
                        <h3 class="mt-2 text-sm font-medium text-gray-900">Nenhuma meta cadastrada</h3>
                        <p class="mt-1 text-sm text-gray-500">Defina sua primeira meta e comece a trilhar seu caminho de conquistas!</p>
                        <div class="mt-6">
                            <a href="{{ route('goals.create') }}" class="inline-flex items-center px-4 py-2 bg-indigo-600 border border-transparent rounded-md font-semibold text-xs text-white uppercase tracking-widest hover:bg-indigo-700">
                                <svg class="w-4 h-4 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 4v16m8-8H4" />
                                </svg>
                                Criar Minha Primeira Meta
                            </a>
                        </div>
                    </div>
                @else
                    <div class="mb-8">
                        <h3 class="text-lg font-semibold text-indigo-800 mb-4">Em Andamento</h3>
                        @if($activeGoals->isEmpty())
                            <p class="text-gray-500 mb-6">Nenhuma meta em andamento no momento. Que tal criar uma nova?</p>
                        @else
                            <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-6">
                                @foreach($activeGoals as $goal)
                                    <div class="relative bg-gradient-to-br from-indigo-50 via-white to-green-50 border rounded-xl shadow-md p-6 transition-all duration-300 hover:shadow-xl hover:scale-105">
                                        <div class="flex items-center mb-2">
                                            <svg class="w-6 h-6 text-indigo-400 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12l2 2 4-4m6 2a9 9 0 11-18 0 9 9 0 0118 0z" />
                                            </svg>
                                            <h3 class="text-lg font-semibold text-indigo-800">{{ $goal->title }}</h3>
                                        </div>
                                        @if($goal->description)
                                            <p class="text-gray-600 mb-4">{{ $goal->description }}</p>
                                        @endif
                                        <div class="flex justify-between items-center mt-4">
                                            <a href="{{ route('goals.show', $goal) }}" class="inline-flex items-center px-4 py-2 bg-gradient-to-r from-indigo-200 to-indigo-400 border border-transparent rounded-md font-semibold text-xs text-indigo-900 uppercase tracking-widest hover:from-indigo-300 hover:to-indigo-500 transition">
                                                <svg class="w-4 h-4 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M10 6H6a2 2 0 00-2 2v10a2 2 0 002 2h10a2 2 0 002-2v-4M14 4h6m0 0v6m0-6L10 14" />
                                                </svg>
                                                Acompanhar
                                            </a>
                                            @if($goal->is_completed)
                                                <span class="inline-flex items-center px-2 py-1 bg-green-100 text-green-700 text-xs font-bold rounded-full ml-2 animate-pulse">
                                                    <svg class="w-4 h-4 mr-1" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7" />
                                                    </svg>
                                                    Concluída!
                                                </span>
                                            @endif
                                        </div>
                                    </div>
                                @endforeach
                            </div>
                        @endif
                    </div>

                    <div class="mb-8">
                        <h3 class="text-lg font-semibold text-indigo-800 mb-4">Concluídas</h3>
                        @if($completedGoals->isEmpty())
                            <p class="text-gray-500 mb-6">Nenhuma meta concluída ainda. Continue se esforçando! 💪</p>
                        @else
                            <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-6">
                                @foreach($completedGoals as $goal)
                                    <div class="relative bg-gradient-to-br from-green-50 via-white to-indigo-50 border rounded-xl shadow-md p-6 transition-all duration-300 hover:shadow-xl hover:scale-105">
                                        <div class="flex items-center mb-2">
                                            <svg class="w-6 h-6 text-green-400 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7" />
                                            </svg>
                                            <h3 class="text-lg font-semibold text-green-800">{{ $goal->title }}</h3>
                                        </div>
                                        @if($goal->description)
                                            <p class="text-gray-600 mb-4">{{ $goal->description }}</p>
                                        @endif
                                        <div class="flex justify-between items-center mt-4">
                                            <a href="{{ route('goals.show', $goal) }}" class="inline-flex items-center px-4 py-2 bg-gradient-to-r from-green-200 to-green-400 border border-transparent rounded-md font-semibold text-xs text-green-900 uppercase tracking-widest hover:from-green-300 hover:to-green-500 transition">
                                                <svg class="w-4 h-4 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M10 6H6a2 2 0 00-2 2v10a2 2 0 002 2h10a2 2 0 002-2v-4M14 4h6m0 0v6m0-6L10 14" />
                                                </svg>
                                                Ver Detalhes
                                            </a>
                                        </div>
                                    </div>
                                @endforeach
                            </div>
                        @endif
                    </div>

                    <div>
                        <h3 class="text-lg font-semibold text-indigo-800 mb-4">Vencidas</h3>
                        @if($overdueGoals->isEmpty())
                            <p class="text-gray-500 mb-6">Ótimo! Você está em dia com suas metas! 🎉</p>
                        @else
                            <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-6">
                                @foreach($overdueGoals as $goal)
                                    <div class="relative bg-gradient-to-br from-red-50 via-white to-indigo-50 border rounded-xl shadow-md p-6 transition-all duration-300 hover:shadow-xl hover:scale-105">
                                        <div class="flex items-center mb-2">
                                            <svg class="w-6 h-6 text-red-400 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12l2 2 4-4m6 2a9 9 0 11-18 0 9 9 0 0118 0z" />
                                            </svg>
                                            <h3 class="text-lg font-semibold text-red-800">{{ $goal->title }}</h3>
                                        </div>
                                        @if($goal->description)
                                            <p class="text-gray-600 mb-4">{{ $goal->description }}</p>
                                        @endif
                                        <div class="flex justify-between items-center mt-4">
                                            <a href="{{ route('goals.show', $goal) }}" class="inline-flex items-center px-4 py-2 bg-gradient-to-r from-red-200 to-red-400 border border-transparent rounded-md font-semibold text-xs text-red-900 uppercase tracking-widest hover:from-red-300 hover:to-red-500 transition">
                                                <svg class="w-4 h-4 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M10 6H6a2 2 0 00-2 2v10a2 2 0 002 2h10a2 2 0 002-2v-4M14 4h6m0 0v6m0-6L10 14" />
                                                </svg>
                                                Ver Detalhes
                                            </a>
                                        </div>
                                    </div>
                                @endforeach
                            </div>
                        @endif
                    </div>
                @endif
            </div>
        </div>
    </div>
</x-app-layout>
