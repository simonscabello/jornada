<x-app-layout>
    <div class="py-4">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white rounded-xl shadow-lg p-6 space-y-8">
                <!-- Header -->
                <div class="border-b border-gray-200 pb-6">
                    <div class="flex justify-between items-center">
                        <div class="flex items-center">
                            @if($collection->icon)
                                <i class="{{ $collection->icon }} text-2xl text-indigo-400 mr-3"></i>
                            @endif
                            <h2 class="font-semibold text-xl text-indigo-800 leading-tight">
                                {{ $collection->title }}
                            </h2>
                        </div>
                        <div class="flex flex-col md:flex-row md:space-x-4 space-y-2 md:space-y-0 items-center">
                            <a href="{{ route('collections.index') }}" class="w-full md:w-auto inline-flex items-center px-4 py-2 bg-indigo-50 border border-transparent rounded-md font-semibold text-xs text-indigo-700 uppercase tracking-widest hover:bg-indigo-100">
                                <svg class="w-4 h-4 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M10 19l-7-7m0 0l7-7m-7 7h18" />
                                </svg>
                                Voltar
                            </a>
                            <a href="{{ route('collections.edit', $collection) }}" class="w-full md:w-auto inline-flex items-center px-4 py-2 bg-indigo-600 border border-transparent rounded-md font-semibold text-xs text-white uppercase tracking-widest hover:bg-indigo-700">
                                <svg class="w-4 h-4 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M11 5H6a2 2 0 00-2 2v11a2 2 0 002 2h11a2 2 0 002-2v-5m-1.414-9.414a2 2 0 112.828 2.828L11.828 15H9v-2.828l8.586-8.586z"/>
                                </svg>
                                Ajustar
                            </a>
                            <form action="{{ route('collections.destroy', $collection) }}" method="POST" class="w-full md:w-auto inline">
                                @csrf
                                @method('DELETE')
                                <button type="submit" class="w-full md:w-auto inline-flex items-center px-4 py-2 bg-red-600 border border-transparent rounded-md font-semibold text-xs text-white uppercase tracking-widest hover:bg-red-700" onclick="return confirm('Tem certeza que deseja excluir esta coleção?')">
                                    <svg class="w-4 h-4 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 7l-.867 12.142A2 2 0 0116.138 21H7.862a2 2 0 01-1.995-1.858L5 7m5 4v6m4-6v6m1-10V4a1 1 0 00-1-1h-4a1 1 0 00-1 1v3M4 7h16" />
                                    </svg>
                                    Excluir
                                </button>
                            </form>
                        </div>
                    </div>
                </div>

                @if (session('success'))
                    <div class="bg-green-100 border border-green-400 text-green-700 px-4 py-3 rounded relative" role="alert">
                        <span class="block sm:inline">{{ session('success') }}</span>
                    </div>
                @endif

                <div>
                    <h3 class="text-2xl font-bold text-indigo-700">Bem-vindo à sua coleção! 📚</h3>
                    <p class="text-gray-600 mt-1">Adicione itens, organize-os e acompanhe seu progresso.</p>
                </div>

                <!-- Formulário para adicionar novo item -->
                <form method="POST" action="{{ route('collection-items.store', $collection) }}" class="bg-gradient-to-br from-indigo-50 via-white to-green-50 p-6 rounded-xl">
                    @csrf
                    <div class="flex flex-col md:flex-row gap-4">
                        <div class="flex-1">
                            <x-input-label for="content" :value="__('Novo Item')" />
                            <x-text-input id="content" name="content" type="text" class="mt-1 block w-full" :value="old('content')" required placeholder="Digite o conteúdo do item que deseja adicionar..." />
                            <x-input-error class="mt-2" :messages="$errors->get('content')" />
                        </div>
                        <div class="flex-1">
                            <x-input-label for="notes" :value="__('Notas (opcional)')" />
                            <x-text-input id="notes" name="notes" type="text" class="mt-1 block w-full" :value="old('notes')" placeholder="Adicione observações ou detalhes sobre o item..." />
                            <x-input-error class="mt-2" :messages="$errors->get('notes')" />
                        </div>
                        <div class="flex items-end">
                            <x-primary-button class="w-full md:w-auto bg-indigo-600 hover:bg-indigo-700">
                                {{ __('Adicionar') }}
                            </x-primary-button>
                        </div>
                    </div>
                </form>

                <!-- Lista de itens -->
                <div class="space-y-2">
                    @if($items->isEmpty())
                        <div class="text-center py-8">
                            <svg class="mx-auto h-12 w-12 text-gray-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 11H5m14 0a2 2 0 012 2v6a2 2 0 01-2 2H5a2 2 0 01-2-2v-6a2 2 0 012-2m14 0V9a2 2 0 00-2-2M5 11V9a2 2 0 012-2m0 0V5a2 2 0 012-2h6a2 2 0 012 2v2M7 7h10" />
                            </svg>
                            <h3 class="mt-2 text-sm font-medium text-gray-900">Nenhum item adicionado</h3>
                            <p class="mt-1 text-sm text-gray-500">Comece adicionando seu primeiro item usando o formulário acima.</p>
                        </div>
                    @else
                        <div class="space-y-2" id="sortable-items">
                            @foreach($items as $item)
                                <div class="flex items-center gap-4 p-4 bg-gradient-to-br from-indigo-50 via-white to-green-50 border rounded-xl shadow-sm hover:shadow-md transition-all duration-300" data-id="{{ $item->id }}">
                                    <div class="flex-shrink-0 cursor-move handle">
                                        <svg class="w-6 h-6 text-indigo-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 8h16M4 16h16" />
                                        </svg>
                                    </div>
                                    <div class="flex-1">
                                        <form method="POST" action="{{ route('collection-items.update', [$collection, $item]) }}" class="flex items-center gap-4" x-data="{ done: {{ $item->done ? 'true' : 'false' }} }">
                                            @csrf
                                            @method('PUT')
                                            <input type="hidden" name="content" value="{{ $item->content }}">
                                            <input type="hidden" name="notes" value="{{ $item->notes }}">
                                            <input type="hidden" name="done" :value="done ? 1 : 0">
                                            <input type="checkbox" class="rounded border-gray-300 text-indigo-600 shadow-sm focus:ring-indigo-500"
                                                x-model="done"
                                                @change="
                                                    $event.target.form.submit();
                                                    $event.target.form.querySelector('p').classList.toggle('line-through');
                                                    $event.target.form.querySelector('p').classList.toggle('text-gray-500');
                                                ">
                                            <div class="flex-1">
                                                <p class="text-gray-900 {{ $item->done ? 'line-through text-gray-500' : '' }}">
                                                    {{ $item->content }}
                                                </p>
                                                @if($item->notes)
                                                    <p class="text-sm text-gray-500 mt-1">{{ $item->notes }}</p>
                                                @endif
                                            </div>
                                        </form>
                                    </div>
                                    <div class="flex flex-col md:flex-row items-center space-y-2 md:space-y-0 md:space-x-2">
                                        <a href="{{ route('collection-items.edit', [$collection, $item]) }}" class="w-full md:w-auto inline-flex items-center px-3 py-2 bg-indigo-600 border border-transparent rounded-md font-semibold text-xs text-white uppercase tracking-widest hover:bg-indigo-700">
                                            <svg class="w-4 h-4 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M11 5H6a2 2 0 00-2 2v11a2 2 0 002 2h11a2 2 0 002-2v-5m-1.414-9.414a2 2 0 112.828 2.828L11.828 15H9v-2.828l8.586-8.586z"/>
                                            </svg>
                                            Ajustar
                                        </a>
                                        <form action="{{ route('collection-items.destroy', [$collection, $item]) }}" method="POST" class="w-full md:w-auto inline">
                                            @csrf
                                            @method('DELETE')
                                            <button type="submit" class="w-full md:w-auto inline-flex items-center px-3 py-2 bg-red-600 border border-transparent rounded-md font-semibold text-xs text-white uppercase tracking-widest hover:bg-red-700" onclick="return confirm('Tem certeza que deseja excluir este item?')">
                                                <svg class="w-4 h-4 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 7l-.867 12.142A2 2 0 0116.138 21H7.862a2 2 0 01-1.995-1.858L5 7m5 4v6m4-6v6m1-10V4a1 1 0 00-1-1h-4a1 1 0 00-1 1v3M4 7h16" />
                                                </svg>
                                                Excluir
                                            </button>
                                        </form>
                                    </div>
                                </div>
                            @endforeach
                        </div>
                    @endif
                </div>
            </div>
        </div>
    </div>

    @push('scripts')
    <script src="https://cdn.jsdelivr.net/npm/sortablejs@1.15.0/Sortable.min.js"></script>
    <script>
        document.addEventListener('DOMContentLoaded', () => {
            const sortableList = document.getElementById('sortable-items');
            if (sortableList) {
                new Sortable(sortableList, {
                    handle: '.handle',
                    animation: 150,
                    ghostClass: 'opacity-50',
                    dragClass: 'shadow-lg',
                    onEnd: function(evt) {
                        const items = Array.from(sortableList.children).map((el, index) => ({
                            id: el.dataset.id,
                            position: index
                        }));

                        fetch(`{{ route('collection-items.reorder', $collection) }}`, {
                            method: 'POST',
                            headers: {
                                'Content-Type': 'application/json',
                                'X-CSRF-TOKEN': document.querySelector('meta[name=\'csrf-token\']').content
                            },
                            body: JSON.stringify({ items })
                        }).then(response => {
                            if (!response.ok) {
                                throw new Error('Erro ao reordenar itens');
                            }
                            return response.json();
                        }).then(data => {
                            // Toast de sucesso
                            const toast = document.createElement('div');
                            toast.className = 'fixed bottom-4 right-4 bg-green-500 text-white px-6 py-3 rounded-lg shadow-lg transform transition-all duration-500 translate-y-0 opacity-100';
                            toast.textContent = 'Itens reordenados com sucesso!';
                            document.body.appendChild(toast);
                            setTimeout(() => {
                                toast.classList.add('translate-y-2', 'opacity-0');
                                setTimeout(() => toast.remove(), 500);
                            }, 2000);
                        }).catch(error => {
                            // Toast de erro
                            const toast = document.createElement('div');
                            toast.className = 'fixed bottom-4 right-4 bg-red-500 text-white px-6 py-3 rounded-lg shadow-lg transform transition-all duration-500 translate-y-0 opacity-100';
                            toast.textContent = 'Erro ao reordenar itens. Tente novamente.';
                            document.body.appendChild(toast);
                            setTimeout(() => {
                                toast.classList.add('translate-y-2', 'opacity-0');
                                setTimeout(() => toast.remove(), 500);
                            }, 2000);
                        });
                    }
                });
            }
        });
    </script>
    @endpush
</x-app-layout>
