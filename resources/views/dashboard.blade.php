<x-app-layout>
    <div class="py-4">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white rounded-xl shadow-lg p-6 space-y-8">
                <!-- Saudação -->
                <div class="border-b border-gray-200 pb-6">
                    <h2 class="font-semibold text-xl text-indigo-800 leading-tight">
                        {{ __('Olá, :name!', ['name' => Auth::user()->name]) }}
                    </h2>
                </div>

                <!-- Mensagem de Boas-vindas -->
                <div class="bg-indigo-50 border-l-4 border-indigo-400 p-6 rounded-xl">
                    <p class="text-lg text-indigo-900 font-semibold mb-2">Que bom te ver por aqui!</p>
                    <p class="text-indigo-800">Lembre-se: cada pequeno passo conta. Mantenha o foco nos seus hábitos, celebre suas conquistas e não se cobre tanto nos dias difíceis. Sua jornada é única e você está evoluindo a cada dia. ✨</p>
                </div>

                <!-- Grid de Cards -->
                <div class="grid grid-cols-1 md:grid-cols-2 gap-8">
                    <!-- Resumo dos Hábitos -->
                    <div class="bg-gray-50 rounded-lg p-6">
                        <div class="flex items-center justify-between mb-4">
                            <h3 class="text-lg font-semibold text-indigo-800">Seus Hábitos</h3>
                            <a href="{{ route('habits.index') }}" class="inline-flex items-center px-4 py-2 bg-indigo-600 border border-transparent rounded-md font-semibold text-xs text-white uppercase tracking-widest hover:bg-indigo-700">
                                <svg class="w-4 h-4 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 4v16m8-8H4" />
                                </svg>
                                Novo
                            </a>
                        </div>
                        <div class="space-y-2">
                            <p class="text-gray-600">
                                Total: <span class="font-semibold text-indigo-800">{{ $habits['total'] }}</span>
                            </p>
                            <p class="text-gray-600">
                                Concluídos hoje: <span class="font-semibold text-indigo-800">{{ $habits['completed_today'] }}</span>
                            </p>
                        </div>
                        <a href="{{ route('habits.index') }}" class="mt-4 inline-flex items-center text-indigo-600 hover:text-indigo-800">
                            Ver todos os hábitos
                            <svg class="w-4 h-4 ml-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5l7 7-7 7" />
                            </svg>
                        </a>
                    </div>

                    <!-- Resumo dos Registros Diários -->
                    <div class="bg-gray-50 rounded-lg p-6">
                        <div class="flex items-center justify-between mb-4">
                            <h3 class="text-lg font-semibold text-indigo-800">Seus Registros</h3>
                            @if(!$dailyLog)
                                <a href="{{ route('daily-logs.create') }}" class="inline-flex items-center px-4 py-2 bg-indigo-600 border border-transparent rounded-md font-semibold text-xs text-white uppercase tracking-widest hover:bg-indigo-700">
                                    <svg class="w-4 h-4 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 4v16m8-8H4" />
                                    </svg>
                                    Registrar hoje
                                </a>
                            @endif
                        </div>
                        @if($dailyLog)
                            <p class="text-gray-600 mb-4 line-clamp-3">{{ Str::limit($dailyLog->content, 200) }}</p>
                            <a href="{{ route('daily-logs.show', $dailyLog) }}" class="inline-flex items-center text-indigo-600 hover:text-indigo-800">
                                Ver entrada
                                <svg class="w-4 h-4 ml-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5l7 7-7 7" />
                                </svg>
                            </a>
                        @else
                            <div class="bg-yellow-50 border-l-4 border-yellow-400 p-4">
                                <div class="flex">
                                    <div class="flex-shrink-0">
                                        <svg class="h-5 w-5 text-yellow-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 9v2m0 4h.01m-6.938 4h13.856c1.54 0 2.502-1.667 1.732-3L13.732 4c-.77-1.333-2.694-1.333-3.464 0L3.34 16c-.77 1.333.192 3 1.732 3z" />
                                        </svg>
                                    </div>
                                    <div class="ml-3">
                                        <p class="text-sm text-yellow-700">
                                            Você ainda não registrou seu dia hoje.
                                        </p>
                                    </div>
                                </div>
                            </div>
                        @endif
                    </div>

                    <!-- Resumo das Metas -->
                    <div class="bg-gray-50 rounded-lg p-6">
                        <div class="flex items-center justify-between mb-4">
                            <h3 class="text-lg font-semibold text-indigo-800">Suas Metas</h3>
                            <a href="{{ route('goals.index') }}" class="inline-flex items-center px-4 py-2 bg-indigo-600 border border-transparent rounded-md font-semibold text-xs text-white uppercase tracking-widest hover:bg-indigo-700">
                                <svg class="w-4 h-4 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 4v16m8-8H4" />
                                </svg>
                                Nova
                            </a>
                        </div>
                        <div class="space-y-2">
                            <p class="text-gray-600">
                                Total: <span class="font-semibold text-indigo-800">{{ $goals['total'] }}</span>
                            </p>
                            <p class="text-gray-600">
                                Concluídas: <span class="font-semibold text-indigo-800">{{ $goals['completed'] }}</span>
                            </p>
                        </div>
                        @if($goals['upcoming']->isNotEmpty())
                            <div class="mt-4">
                                <h4 class="text-sm font-semibold text-indigo-800 mb-2">Próximas do prazo:</h4>
                                <ul class="space-y-2">
                                    @foreach($goals['upcoming'] as $goal)
                                        <li class="text-sm text-gray-600">
                                            {{ $goal->title }} ({{ $goal->target_date->format('d/m') }})
                                        </li>
                                    @endforeach
                                </ul>
                            </div>
                        @endif
                        <a href="{{ route('goals.index') }}" class="mt-4 inline-flex items-center text-indigo-600 hover:text-indigo-800">
                            Ver todas as metas
                            <svg class="w-4 h-4 ml-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5l7 7-7 7" />
                            </svg>
                        </a>
                    </div>

                    <!-- Resumo das Coleções -->
                    <div class="bg-gray-50 rounded-lg p-6">
                        <div class="flex items-center justify-between mb-4">
                            <h3 class="text-lg font-semibold text-indigo-800">Suas Coleções</h3>
                            <a href="{{ route('collections.index') }}" class="inline-flex items-center px-4 py-2 bg-indigo-600 border border-transparent rounded-md font-semibold text-xs text-white uppercase tracking-widest hover:bg-indigo-700">
                                <svg class="w-4 h-4 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 4v16m8-8H4" />
                                </svg>
                                Nova
                            </a>
                        </div>
                        <div class="space-y-2">
                            <p class="text-gray-600">
                                Total: <span class="font-semibold text-indigo-800">{{ $collections['total'] }}</span>
                            </p>
                            <p class="text-gray-600">
                                Itens pendentes: <span class="font-semibold text-indigo-800">{{ $collections['pending_items'] }}</span>
                            </p>
                        </div>
                        <a href="{{ route('collections.index') }}" class="mt-4 inline-flex items-center text-indigo-600 hover:text-indigo-800">
                            Ver todas as coleções
                            <svg class="w-4 h-4 ml-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5l7 7-7 7" />
                            </svg>
                        </a>
                    </div>
                </div>

                <!-- Check-in de Autocuidado -->
                <div class="bg-gray-50 rounded-lg p-6">
                    <div class="flex items-center justify-between mb-4">
                        <h3 class="text-lg font-semibold text-indigo-800">Check-in de Autocuidado</h3>
                        @if(!$todayCheckin)
                            <a href="{{ route('self-care.checkins.create') }}" class="inline-flex items-center px-4 py-2 bg-indigo-600 border border-transparent rounded-md font-semibold text-xs text-white uppercase tracking-widest hover:bg-indigo-700">
                                <svg class="w-4 h-4 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 4v16m8-8H4" />
                                </svg>
                                Fazer check-in
                            </a>
                        @endif
                    </div>
                    @if($todayCheckin)
                        <div class="flex items-center space-x-2 text-green-600">
                            <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7" />
                            </svg>
                            <span>Check-in de hoje já realizado</span>
                        </div>
                    @else
                        <div class="bg-yellow-50 border-l-4 border-yellow-400 p-4">
                            <div class="flex">
                                <div class="flex-shrink-0">
                                    <svg class="h-5 w-5 text-yellow-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 9v2m0 4h.01m-6.938 4h13.856c1.54 0 2.502-1.667 1.732-3L13.732 4c-.77-1.333-2.694-1.333-3.464 0L3.34 16c-.77 1.333.192 3 1.732 3z" />
                                    </svg>
                                </div>
                                <div class="ml-3">
                                    <p class="text-sm text-yellow-700">
                                        Você ainda não fez seu check-in de autocuidado hoje.
                                    </p>
                                </div>
                            </div>
                        </div>
                    @endif
                </div>
            </div>
        </div>
    </div>
</x-app-layout>
