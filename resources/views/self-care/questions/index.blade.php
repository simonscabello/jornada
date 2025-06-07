<x-app-layout>
    <div class="py-4">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white rounded-xl shadow-lg p-6 space-y-8">
                <!-- Header -->
                <div class="border-b border-gray-200 pb-6">
                    <div class="flex justify-between items-center">
                        <h2 class="font-semibold text-xl text-indigo-800 leading-tight">
                            {{ __('Perguntas de Autocuidado') }}
                        </h2>
                        <a href="{{ route('self-care.questions.create') }}" class="inline-flex items-center px-4 py-2 bg-indigo-600 border border-transparent rounded-md font-semibold text-xs text-white uppercase tracking-widest hover:bg-indigo-700">
                            <svg class="w-4 h-4 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 4v16m8-8H4" />
                            </svg>
                            {{ __('Nova Pergunta') }}
                        </a>
                    </div>
                </div>

                <div class="mb-6">
                    <h3 class="text-2xl font-bold text-indigo-700">Personalize seu Autocuidado 🌟</h3>
                    <p class="text-gray-600 mt-1">Crie perguntas que façam sentido para sua jornada. Cada pergunta é uma oportunidade de reflexão e crescimento!</p>
                </div>

                @if($questions->isEmpty())
                    <div class="text-center py-8">
                        <svg class="mx-auto h-12 w-12 text-gray-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5H7a2 2 0 00-2 2v12a2 2 0 002 2h10a2 2 0 002-2V7a2 2 0 00-2-2h-2M9 5a2 2 0 002 2h2a2 2 0 002-2M9 5a2 2 0 012-2h2a2 2 0 012 2" />
                        </svg>
                        <h3 class="mt-2 text-sm font-medium text-gray-900">Nenhuma pergunta encontrada</h3>
                        <p class="mt-1 text-sm text-gray-500">Comece personalizando seu check-in com suas próprias perguntas.</p>
                        <div class="mt-6">
                            <a href="{{ route('self-care.questions.create') }}" class="inline-flex items-center px-4 py-2 bg-indigo-600 border border-transparent rounded-md font-semibold text-xs text-white uppercase tracking-widest hover:bg-indigo-700">
                                <svg class="w-4 h-4 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 4v16m8-8H4" />
                                </svg>
                                {{ __('Criar Minha Primeira Pergunta') }}
                            </a>
                        </div>
                    </div>
                @else
                    <div class="space-y-4">
                        @foreach($questions as $question)
                            <div class="bg-gradient-to-br from-indigo-50 via-white to-green-50 border rounded-xl shadow-md p-6 transition-all duration-300 hover:shadow-lg">
                                <div class="flex justify-between items-center">
                                    <div>
                                        <h3 class="text-lg font-semibold text-indigo-800">
                                            {{ $question->question }}
                                        </h3>
                                        @if($question->is_default)
                                            <span class="text-sm text-indigo-600">
                                                {{ __('Pergunta padrão do sistema') }}
                                            </span>
                                        @endif
                                    </div>
                                    @if(!$question->is_default && $question->user_id === auth()->id())
                                        <div class="flex items-center space-x-2">
                                            <a href="{{ route('self-care.questions.edit', $question) }}" class="inline-flex items-center px-4 py-2 bg-indigo-600 border border-transparent rounded-md font-semibold text-xs text-white uppercase tracking-widest hover:bg-indigo-700">
                                                <svg class="w-4 h-4 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M11 5H6a2 2 0 00-2 2v11a2 2 0 002 2h11a2 2 0 002-2v-5m-1.414-9.414a2 2 0 112.828 2.828L11.828 15H9v-2.828l8.586-8.586z" />
                                                </svg>
                                                {{ __('Editar') }}
                                            </a>
                                            <form method="POST" action="{{ route('self-care.questions.destroy', $question) }}" class="inline">
                                                @csrf
                                                @method('DELETE')
                                                <x-danger-button onclick="return confirm('{{ __('Tem certeza que deseja excluir esta pergunta?') }}')" class="bg-red-600 hover:bg-red-700 text-white">
                                                    <svg class="w-4 h-4 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 7l-.867 12.142A2 2 0 0116.138 21H7.862a2 2 0 01-1.995-1.858L5 7m5 4v6m4-6v6m1-10V4a1 1 0 00-1-1h-4a1 1 0 00-1 1v3M4 7h16" />
                                                    </svg>
                                                    {{ __('Excluir') }}
                                                </x-danger-button>
                                            </form>
                                        </div>
                                    @endif
                                </div>
                            </div>
                        @endforeach
                    </div>
                @endif
            </div>
        </div>
    </div>
</x-app-layout>
