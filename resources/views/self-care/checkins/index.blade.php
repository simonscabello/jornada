<x-app-layout>
    <div class="py-4">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white rounded-xl shadow-lg p-6 space-y-8">
                <!-- Header -->
                <div class="border-b border-gray-200 pb-6">
                    <div class="flex justify-between items-center">
                        <h2 class="font-semibold text-xl text-indigo-800 leading-tight">
                            {{ __('Histórico de Check-ins') }}
                        </h2>
                        <div class="flex items-center space-x-4">
                            <a href="{{ route('self-care.questions.index') }}" class="inline-flex items-center px-4 py-2 bg-indigo-600 border border-transparent rounded-md font-semibold text-xs text-white uppercase tracking-widest hover:bg-indigo-700">
                                <svg class="w-4 h-4 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M11 5H6a2 2 0 00-2 2v11a2 2 0 002 2h11a2 2 0 002-2v-5m-1.414-9.414a2 2 0 112.828 2.828L11.828 15H9v-2.828l8.586-8.586z" />
                                </svg>
                                {{ __('Gerenciar Perguntas') }}
                            </a>
                            <a href="{{ route('self-care.checkins.create') }}" class="inline-flex items-center px-4 py-2 bg-indigo-600 border border-transparent rounded-md font-semibold text-xs text-white uppercase tracking-widest hover:bg-indigo-700">
                                <svg class="w-4 h-4 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 4v16m8-8H4" />
                                </svg>
                                {{ __('Novo Check-in') }}
                            </a>
                        </div>
                    </div>
                </div>

                <div class="mb-6">
                    <h3 class="text-2xl font-bold text-indigo-700">Sua Jornada de Autocuidado 🌟</h3>
                    <p class="text-gray-600 mt-1">Aqui você pode acompanhar seu progresso diário. Cada check-in é um momento de reflexão e crescimento!</p>
                </div>

                @if($checkins->isEmpty())
                    <div class="text-center py-8">
                        <svg class="mx-auto h-12 w-12 text-gray-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5H7a2 2 0 00-2 2v12a2 2 0 002 2h10a2 2 0 002-2V7a2 2 0 00-2-2h-2M9 5a2 2 0 002 2h2a2 2 0 002-2M9 5a2 2 0 012-2h2a2 2 0 012 2" />
                        </svg>
                        <h3 class="mt-2 text-sm font-medium text-gray-900">Nenhum check-in encontrado</h3>
                        <p class="mt-1 text-sm text-gray-500">Comece sua jornada de autocuidado fazendo seu primeiro check-in.</p>
                        <div class="mt-6">
                            <a href="{{ route('self-care.checkins.create') }}" class="inline-flex items-center px-4 py-2 bg-indigo-600 border border-transparent rounded-md font-semibold text-xs text-white uppercase tracking-widest hover:bg-indigo-700">
                                <svg class="w-4 h-4 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 4v16m8-8H4" />
                                </svg>
                                {{ __('Fazer Meu Primeiro Check-in') }}
                            </a>
                        </div>
                    </div>
                @else
                    <div class="space-y-4">
                        @foreach($checkins as $checkin)
                            <div class="bg-gradient-to-br from-indigo-50 via-white to-green-50 border rounded-xl shadow-md p-6 transition-all duration-300 hover:shadow-lg hover:scale-105">
                                <a href="{{ route('self-care.checkins.show', $checkin) }}" class="block">
                                    <div class="flex justify-between items-center">
                                        <div>
                                            <h3 class="text-lg font-semibold text-indigo-800">
                                                {{ $checkin->date->format('d/m/Y') }}
                                            </h3>
                                            <p class="text-sm text-gray-600">
                                                {{ $checkin->answers->where('answer', true)->count() }} respostas positivas
                                            </p>
                                        </div>
                                        <svg class="w-5 h-5 text-indigo-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5l7 7-7 7" />
                                        </svg>
                                    </div>
                                </a>
                            </div>
                        @endforeach
                    </div>
                @endif
            </div>
        </div>
    </div>
</x-app-layout>
