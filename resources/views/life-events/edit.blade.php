<x-app-layout>
    <div class="py-4">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white rounded-xl shadow-lg p-6 space-y-8">
                <!-- Header -->
                <div class="border-b border-gray-200 pb-6">
                    <div class="flex justify-between items-center">
                        <h2 class="font-semibold text-xl text-indigo-800 leading-tight">
                            {{ __('Ajustando seu evento') }}
                        </h2>
                    </div>
                </div>

                <p class="text-gray-600">Ajustar os detalhes do seu evento é uma ótima maneira de manter suas memórias organizadas. Faça as alterações que achar necessárias.</p>

                <form method="POST" action="{{ route('life-events.update', $lifeEvent) }}" enctype="multipart/form-data" class="space-y-6">
                    @csrf
                    @method('PUT')

                    <div>
                        <x-input-label for="title" :value="__('Qual é o título do seu evento?')" />
                        <x-text-input id="title" name="title" type="text" class="mt-1 block w-full" :value="old('title', $lifeEvent->title)" required autofocus />
                        <x-input-error class="mt-2" :messages="$errors->get('title')" />
                    </div>

                    <div>
                        <x-input-label for="description" :value="__('Conte-nos mais sobre este evento')" />
                        <textarea
                            id="description"
                            name="description"
                            class="mt-1 block w-full border-gray-300 focus:border-indigo-500 focus:ring-indigo-500 rounded-md shadow-sm"
                            rows="3"
                            placeholder="Descreva os detalhes e memórias deste momento especial..."
                        >{{ old('description', $lifeEvent->description) }}</textarea>
                        <x-input-error class="mt-2" :messages="$errors->get('description')" />
                    </div>

                    <div>
                        <x-input-label for="event_date" :value="__('Quando este evento aconteceu?')" />
                        <x-text-input id="event_date" name="event_date" type="date" class="mt-1 block w-full" :value="old('event_date', $lifeEvent->event_date->format('Y-m-d'))" required />
                        <x-input-error class="mt-2" :messages="$errors->get('event_date')" />
                    </div>

                    <div>
                        <x-input-label for="location" :value="__('Onde este evento aconteceu?')" />
                        <x-text-input id="location" name="location" type="text" class="mt-1 block w-full" :value="old('location', $lifeEvent->location)" placeholder="Ex: Praia de Copacabana, Rio de Janeiro" />
                        <x-input-error class="mt-2" :messages="$errors->get('location')" />
                    </div>

                    <div>
                        <x-input-label for="type" :value="__('Qual o tipo deste evento?')" />
                        <select id="type" name="type" class="mt-1 block w-full border-gray-300 focus:border-indigo-500 focus:ring-indigo-500 rounded-md shadow-sm" required>
                            <option value="">Selecione...</option>
                            <option value="viagem" @selected(old('type', $lifeEvent->type) === 'viagem')>Viagem</option>
                            <option value="espiritual" @selected(old('type', $lifeEvent->type) === 'espiritual')>Espiritual</option>
                            <option value="profissional" @selected(old('type', $lifeEvent->type) === 'profissional')>Profissional</option>
                            <option value="pessoal" @selected(old('type', $lifeEvent->type) === 'pessoal')>Pessoal</option>
                            <option value="saude" @selected(old('type', $lifeEvent->type) === 'saude')>Saúde</option>
                        </select>
                        <x-input-error class="mt-2" :messages="$errors->get('type')" />
                    </div>

                    <div x-data="{ files: [], previews: [] }">
                        <x-input-label :value="__('Adicione fotos deste momento')" />
                        <div class="mt-1 flex justify-center px-6 pt-5 pb-6 border-2 border-gray-300 border-dashed rounded-md hover:border-indigo-500 transition-colors">
                            <div class="space-y-1 text-center">
                                <svg class="mx-auto h-12 w-12 text-gray-400" stroke="currentColor" fill="none" viewBox="0 0 48 48">
                                    <path d="M28 8H12a4 4 0 00-4 4v20m32-12v8m0 0v8a4 4 0 01-4 4H12a4 4 0 01-4-4v-4m32-4l-3.172-3.172a4 4 0 00-5.656 0L28 28M8 32l9.172-9.172a4 4 0 015.656 0L28 28m0 0l4 4m4-24h8m-4-4v8m-12 4h.02" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" />
                                </svg>
                                <div class="flex text-sm text-gray-600">
                                    <label for="images" class="relative cursor-pointer bg-white rounded-md font-medium text-indigo-600 hover:text-indigo-500 focus-within:outline-none focus-within:ring-2 focus-within:ring-offset-2 focus-within:ring-indigo-500">
                                        <span>Adicionar imagens</span>
                                        <input id="images" name="images[]" type="file" class="sr-only" multiple accept="image/*" @change="
                                            files = $event.target.files;
                                            previews = [];
                                            for (let i = 0; i < files.length; i++) {
                                                const reader = new FileReader();
                                                reader.onload = (e) => previews.push(e.target.result);
                                                reader.readAsDataURL(files[i]);
                                            }
                                        ">
                                    </label>
                                    <p class="pl-1">ou arraste e solte</p>
                                </div>
                                <p class="text-xs text-gray-500">PNG, JPG, GIF até 5MB</p>
                            </div>
                        </div>

                        <template x-if="previews.length > 0">
                            <div class="mt-4 grid grid-cols-2 gap-4 sm:grid-cols-3 md:grid-cols-4">
                                <template x-for="(preview, index) in previews" :key="index">
                                    <div class="relative">
                                        <img :src="preview" class="h-24 w-24 object-cover rounded-lg">
                                        <button type="button" @click="previews.splice(index, 1); files = Array.from(files).filter((_, i) => i !== index)" class="absolute -top-2 -right-2 bg-red-500 text-white rounded-full p-1 hover:bg-red-600 transition-colors">
                                            <svg class="h-4 w-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12" />
                                            </svg>
                                        </button>
                                    </div>
                                </template>
                            </div>
                        </template>

                        @if($lifeEvent->images->count() > 0)
                            <div class="mt-4">
                                <h4 class="text-sm font-medium text-gray-700">Imagens atuais</h4>
                                <div class="mt-2 grid grid-cols-2 gap-4 sm:grid-cols-3 md:grid-cols-4">
                                    @foreach($lifeEvent->images as $image)
                                        <div class="relative group">
                                            <img src="{{ $image->url }}" class="h-24 w-24 object-cover rounded-lg">
                                            <div class="absolute inset-0 flex items-center justify-center bg-black bg-opacity-50 opacity-0 group-hover:opacity-100 transition-opacity rounded-lg">
                                                <label class="cursor-pointer">
                                                    <input type="checkbox" name="remove_images[]" value="{{ $image->id }}" class="sr-only">
                                                    <svg class="h-8 w-8 text-white hover:text-red-500 transition-colors" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 7l-.867 12.142A2 2 0 0116.138 21H7.862a2 2 0 01-1.995-1.858L5 7m5 4v6m4-6v6m1-10V4a1 1 0 00-1-1h-4a1 1 0 00-1 1v3M4 7h16" />
                                                    </svg>
                                                </label>
                                            </div>
                                        </div>
                                    @endforeach
                                </div>
                            </div>
                        @endif

                        <x-input-error class="mt-2" :messages="$errors->get('images.*')" />
                    </div>

                    <div class="flex items-center gap-4">
                        <x-primary-button class="bg-indigo-600 hover:bg-indigo-700">{{ __('Salvar Alterações') }}</x-primary-button>
                        <a href="{{ route('life-events.show', $lifeEvent) }}" class="inline-flex items-center px-4 py-2 bg-indigo-50 border border-transparent rounded-md font-semibold text-xs text-indigo-700 uppercase tracking-widest hover:bg-indigo-100">
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
