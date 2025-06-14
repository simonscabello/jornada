<x-app-layout>
    <div class="py-4">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white rounded-xl shadow-lg p-6 space-y-8">
                <!-- Header -->
                <div class="flex justify-between items-center border-b border-gray-200 pb-6">
                    <h2 class="font-semibold text-xl text-indigo-800 leading-tight">
                        {{ __('Check-in de Autocuidado') }}
                    </h2>
                    <div class="flex items-center space-x-4">
                        <a href="{{ route('self-care.questions.index') }}" class="inline-flex items-center px-4 py-2 bg-indigo-600 border border-transparent rounded-md font-semibold text-xs text-white uppercase tracking-widest hover:bg-indigo-700">
                            <svg class="w-4 h-4 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M11 5H6a2 2 0 00-2 2v11a2 2 0 002 2h11a2 2 0 002-2v-5m-1.414-9.414a2 2 0 112.828 2.828L11.828 15H9v-2.828l8.586-8.586z" />
                            </svg>
                            {{ __('Gerenciar Perguntas') }}
                        </a>
                    </div>
                </div>

                <div class="mb-6">
                    <h3 class="text-2xl font-bold text-indigo-700">Olá! 🌟</h3>
                    <p class="text-gray-600 mt-1">Vamos fazer um momento de reflexão sobre seu dia? Cada resposta é um passo importante no seu caminho de autocuidado.</p>
                </div>

                <form method="POST" action="{{ route('self-care.checkins.store') }}">
                    @csrf

                    <div class="space-y-6">
                        @foreach($questions as $question)
                            <div class="bg-gradient-to-br from-indigo-50 via-white to-green-50 border rounded-xl shadow-md p-6 transition-all duration-300 hover:shadow-lg">
                                <div class="flex items-center justify-between">
                                    <x-input-label :value="$question->question" class="text-lg text-indigo-800" />
                                    <div class="flex items-center space-x-4">
                                        <label class="inline-flex items-center">
                                            <input type="radio" name="answers[{{ $question->id }}]" value="1" class="form-radio text-indigo-600" required>
                                            <span class="ml-2 text-indigo-800">Sim</span>
                                        </label>
                                        <label class="inline-flex items-center">
                                            <input type="radio" name="answers[{{ $question->id }}]" value="0" class="form-radio text-indigo-600" required>
                                            <span class="ml-2 text-indigo-800">Não</span>
                                        </label>
                                    </div>
                                </div>
                            </div>
                        @endforeach
                    </div>

                    <div class="flex items-center justify-end">
                        <x-primary-button class="bg-indigo-600 hover:bg-indigo-700 text-white mt-4">
                            <svg class="w-4 h-4 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7" />
                            </svg>
                            {{ __('Salvar Check-in') }}
                        </x-primary-button>
                    </div>
                </form>
            </div>
        </div>
    </div>
</x-app-layout>
