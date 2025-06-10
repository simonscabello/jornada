<x-app-layout>
    <div class="py-4">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white rounded-xl shadow-lg p-6 space-y-8">
                <!-- Header -->
                <div class="border-b border-gray-200 pb-6">
                    <div class="flex justify-between items-center">
                        <h2 class="font-semibold text-xl text-indigo-800 leading-tight">
                            {{ __('Minha Linha do Tempo') }}
                        </h2>
                        <a href="{{ route('life-events.create') }}" class="inline-flex items-center px-4 py-2 bg-indigo-600 border border-transparent rounded-md font-semibold text-xs text-white uppercase tracking-widest hover:bg-indigo-700">
                            <svg class="w-4 h-4 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 4v16m8-8H4" />
                            </svg>
                            Novo Evento
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
                    <p class="text-gray-600 mt-1">Reviva seus momentos especiais através desta linha do tempo.</p>
                </div>

                @if($lifeEvents->isEmpty())
                    <div class="text-center py-8">
                        <svg class="mx-auto h-12 w-12 text-gray-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M8 7V3m8 4V3m-9 8h10M5 21h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v12a2 2 0 002 2z" />
                        </svg>
                        <h3 class="mt-2 text-sm font-medium text-gray-900">Nenhum evento cadastrado</h3>
                        <p class="mt-1 text-sm text-gray-500">Comece registrando seu primeiro evento especial.</p>
                        <div class="mt-6">
                            <a href="{{ route('life-events.create') }}" class="inline-flex items-center px-4 py-2 bg-indigo-600 border border-transparent rounded-md font-semibold text-xs text-white uppercase tracking-widest hover:bg-indigo-700">
                                <svg class="w-4 h-4 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 4v16m8-8H4" />
                                </svg>
                                Criar Meu Primeiro Evento
                            </a>
                        </div>
                    </div>
                @else
                    <div class="relative">
                        <!-- Linha do Tempo Central -->
                        <div class="absolute left-1/2 transform -translate-x-1/2 h-full w-0.5 bg-indigo-200 hidden md:block"></div>

                        <!-- Eventos -->
                        <div class="space-y-6 md:space-y-8">
                            @php
                                $currentYear = null;
                            @endphp

                            @foreach($lifeEvents as $event)
                                @if($currentYear !== $event->event_date->year)
                                    @php
                                        $currentYear = $event->event_date->year;
                                    @endphp
                                    <div class="relative flex justify-center">
                                        <div class="bg-indigo-100 text-indigo-800 px-4 py-2 rounded-full text-sm font-semibold">
                                            {{ $currentYear }}
                                        </div>
                                    </div>
                                @endif

                                <div class="relative flex items-center group" x-data="{ expanded: false }">
                                    <!-- Nó da Timeline -->
                                    <div class="absolute left-1/2 transform -translate-x-1/2 w-4 h-4 bg-indigo-600 rounded-full border-4 border-white shadow-lg hidden md:block"></div>

                                    <!-- Card do Evento -->
                                    <div class="w-full md:w-5/12 {{ $loop->iteration % 2 === 0 ? 'md:ml-auto' : 'md:mr-auto' }} transform transition-all duration-300 hover:scale-105">
                                        <div class="bg-white rounded-xl shadow-md overflow-hidden border border-gray-100">
                                            <!-- Imagens em Grid -->
                                            @if($event->images->isNotEmpty())
                                                <div class="grid grid-cols-2 gap-1 p-1 bg-gray-50">
                                                    @foreach($event->images->take(4) as $image)
                                                        <div class="aspect-w-1 aspect-h-1">
                                                            <img src="{{ $image->url }}" alt="{{ $event->title }}"
                                                                class="w-full h-24 object-cover rounded-lg"
                                                                loading="lazy">
                                                        </div>
                                                    @endforeach
                                                </div>
                                            @endif

                                            <div class="p-4">
                                                <div class="flex items-center justify-between mb-2">
                                                    <h3 class="text-lg font-semibold text-indigo-800">{{ $event->title }}</h3>
                                                    <span class="inline-flex items-center px-2.5 py-0.5 rounded-full text-xs font-medium {{ $event->type === 'viagem' ? 'bg-blue-100 text-blue-800' : ($event->type === 'espiritual' ? 'bg-purple-100 text-purple-800' : ($event->type === 'profissional' ? 'bg-green-100 text-green-800' : ($event->type === 'pessoal' ? 'bg-yellow-100 text-yellow-800' : 'bg-red-100 text-red-800'))) }}">
                                                        {{ ucfirst($event->type) }}
                                                    </span>
                                                </div>

                                                <p class="text-sm text-gray-500 mb-2">
                                                    {{ $event->event_date_human }}
                                                </p>

                                                @if($event->location)
                                                    <div class="flex items-center text-sm text-gray-500 mb-2">
                                                        <svg class="flex-shrink-0 mr-1.5 h-4 w-4 text-gray-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17.657 16.657L13.414 20.9a1.998 1.998 0 01-2.827 0l-4.244-4.243a8 8 0 1111.314 0z" />
                                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 11a3 3 0 11-6 0 3 3 0 016 0z" />
                                                        </svg>
                                                        {{ $event->location }}
                                                    </div>
                                                @endif

                                                @if($event->description)
                                                    <div class="mt-2" x-show="expanded" x-transition>
                                                        <p class="text-gray-600 text-sm">{{ $event->description }}</p>
                                                    </div>
                                                    <button @click="expanded = !expanded" class="mt-2 text-sm text-indigo-600 hover:text-indigo-800">
                                                        <span x-text="expanded ? 'Mostrar menos' : 'Ler mais'"></span>
                                                    </button>
                                                @endif

                                                <!-- Ações -->
                                                <div class="mt-4 flex justify-end space-x-2 opacity-0 group-hover:opacity-100 transition-opacity duration-200">
                                                    <a href="{{ route('life-events.show', $event) }}" class="text-indigo-600 hover:text-indigo-800">
                                                        <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 12a3 3 0 11-6 0 3 3 0 016 0z" />
                                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M2.458 12C3.732 7.943 7.523 5 12 5c4.478 0 8.268 2.943 9.542 7-1.274 4.057-5.064 7-9.542 7-4.477 0-8.268-2.943-9.542-7z" />
                                                        </svg>
                                                    </a>
                                                    <a href="{{ route('life-events.edit', $event) }}" class="text-indigo-600 hover:text-indigo-800">
                                                        <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M11 5H6a2 2 0 00-2 2v11a2 2 0 002 2h11a2 2 0 002-2v-5m-1.414-9.414a2 2 0 112.828 2.828L11.828 15H9v-2.828l8.586-8.586z" />
                                                        </svg>
                                                    </a>
                                                    <form method="POST" action="{{ route('life-events.destroy', $event) }}" class="inline">
                                                        @csrf
                                                        @method('DELETE')
                                                        <button type="submit" class="text-red-600 hover:text-red-800" onclick="return confirm('Tem certeza que deseja excluir este evento?')">
                                                            <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 7l-.867 12.142A2 2 0 0116.138 21H7.862a2 2 0 01-1.995-1.858L5 7m5 4v6m4-6v6m1-10V4a1 1 0 00-1-1h-4a1 1 0 00-1 1v3M4 7h16" />
                                                            </svg>
                                                        </button>
                                                    </form>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            @endforeach
                        </div>
                    </div>
                @endif
            </div>
        </div>
    </div>
</x-app-layout>
