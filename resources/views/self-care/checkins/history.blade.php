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
                        <div class="flex flex-col md:flex-row md:space-x-2 space-y-2 md:space-y-0 items-center">
                            <a href="{{ route('self-care.checkins.index') }}" class="w-full md:w-auto inline-flex items-center px-4 py-2 bg-indigo-50 border border-transparent rounded-md font-semibold text-xs text-indigo-700 uppercase tracking-widest hover:bg-indigo-100">
                                <svg class="w-4 h-4 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M10 19l-7-7m0 0l7-7m-7 7h18" />
                                </svg>
                                Voltar
                            </a>
                        </div>
                    </div>
                </div>

                @if (session('success'))
                    <div class="bg-green-100 border border-green-400 text-green-700 px-4 py-3 rounded relative" role="alert">
                        <span class="block sm:inline">{{ session('success') }}</span>
                    </div>
                @endif

                <div class="space-y-4">
                    @forelse ($checkins as $checkin)
                        <div x-data="{ open: false }" class="border border-gray-200 rounded-lg p-4 hover:bg-gray-50 transition-colors">
                            <div @click="open = !open" class="flex items-center justify-between cursor-pointer">
                                <div class="flex items-center space-x-4">
                                    <div class="text-lg font-medium text-indigo-800">
                                        {{ $checkin->date->format('d/m/Y') }}
                                    </div>
                                    <div class="text-sm text-indigo-600">
                                        {{ $checkin->answers->count() }} respostas
                                    </div>
                                </div>
                                <button class="text-indigo-600 hover:text-indigo-800">
                                    <svg x-show="!open" class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 9l-7 7-7-7" />
                                    </svg>
                                    <svg x-show="open" class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 15l7-7 7 7" />
                                    </svg>
                                </button>
                            </div>

                            <div x-show="open" x-transition class="mt-4 space-y-2">
                                @foreach ($checkin->answers as $answer)
                                    <div class="flex items-center rounded-lg px-4 py-2 {{ $answer->answer ? 'bg-green-50' : 'bg-red-50' }}">
                                        <span class="font-semibold flex-1 {{ $answer->answer ? 'text-green-800' : 'text-red-800' }}">
                                            {{ $answer->question->question }}
                                        </span>
                                        <span class="ml-2 font-semibold {{ $answer->answer ? 'text-green-700' : 'text-red-700' }}">
                                            &rarr; {{ $answer->answer ? 'Sim' : 'Não' }}
                                        </span>
                                    </div>
                                @endforeach
                            </div>
                        </div>
                    @empty
                        <div class="text-center text-indigo-600 bg-indigo-50 rounded-lg p-8">
                            Nenhum check-in encontrado.
                        </div>
                    @endforelse

                    <div class="mt-6">
                        {{ $checkins->links() }}
                    </div>
                </div>
            </div>
        </div>
    </div>
</x-app-layout>
