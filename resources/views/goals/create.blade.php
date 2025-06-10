<x-app-layout>
    <div class="py-4">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white rounded-xl shadow-lg p-6 space-y-8">
                <!-- Header -->
                <div class="border-b border-gray-200 pb-6">
                    <div class="flex justify-between items-center">
                        <h2 class="font-semibold text-xl text-indigo-800 leading-tight">
                            Vamos definir uma nova meta?
                        </h2>

                    </div>
                </div>

                <form method="POST" action="{{ route('goals.store') }}" class="space-y-6">
                    @csrf

                    <div>
                        <label for="title" class="block text-sm font-medium">Qual é o título da sua meta?</label>
                        <div class="mt-1">
                            <input type="text" name="title" id="title" value="{{ old('title') }}" required
                                class="block w-full rounded-md shadow-sm focus:border-indigo-500 focus:ring-indigo-500"
                                placeholder="Ex: Aprender a tocar violão">
                        </div>
                        @error('title')
                            <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
                        @enderror
                    </div>

                    <div>
                        <label for="description" class="block text-sm font-medium">Conte-nos mais sobre esta meta</label>
                        <div class="mt-1">
                            <textarea name="description" id="description" rows="4"
                                class="block w-full rounded-md shadow-sm focus:border-indigo-500 focus:ring-indigo-500"
                                placeholder="Descreva sua meta em detalhes...">{{ old('description') }}</textarea>
                        </div>
                        @error('description')
                            <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
                        @enderror
                    </div>

                    <div>
                        <label for="target_date" class="block text-sm font-medium">Quando você pretende alcançar esta meta?</label>
                        <div class="mt-1">
                            <input type="date" name="target_date" id="target_date" value="{{ old('target_date') }}" required
                                class="block w-full rounded-md shadow-sm focus:border-indigo-500 focus:ring-indigo-500">
                        </div>
                        @error('target_date')
                            <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
                        @enderror
                    </div>

                    <div class="flex space-x-4">
                        <button type="submit" class="inline-flex items-center px-4 py-2 bg-indigo-600 border border-transparent rounded-md font-semibold text-xs text-white uppercase tracking-widest hover:bg-indigo-700">
                            <svg class="w-4 h-4 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7" />
                            </svg>
                            Definir Meta
                        </button>
                        <a href="{{ route('goals.index') }}" class="inline-flex items-center px-4 py-2 bg-indigo-50 border border-transparent rounded-md font-semibold text-xs text-indigo-700 uppercase tracking-widest hover:bg-indigo-100">
                            <svg class="w-4 h-4 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M10 19l-7-7m0 0l7-7m-7 7h18" />
                            </svg>
                            Voltar
                        </a>

                    </div>
                </form>
            </div>
        </div>
    </div>
</x-app-layout>
