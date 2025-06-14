@props(['active'])

<aside x-data="{ open: false }" class="z-50">
    <!-- Overlay para mobile -->
    <div
        x-show="open"
        x-transition:enter="transition-opacity ease-linear duration-300"
        x-transition:enter-start="opacity-0"
        x-transition:enter-end="opacity-100"
        x-transition:leave="transition-opacity ease-linear duration-300"
        x-transition:leave-start="opacity-100"
        x-transition:leave-end="opacity-0"
        class="fixed inset-0 bg-gray-600 bg-opacity-75 sm:hidden"
        @click="open = false"
        style="display: none;"
    ></div>

    <!-- Sidebar fixa em desktop -->
    <div class="fixed inset-y-0 left-0 w-64 bg-white border-r border-gray-200 flex-col h-full hidden sm:flex">
        <!-- Logo -->
        <div class="flex items-center justify-center h-16 border-b border-gray-200">
            <a href="{{ route('dashboard') }}" class="flex items-center space-x-2">
                <x-application-logo class="block h-8 w-auto fill-current text-indigo-600" />
                <span class="text-lg font-semibold text-indigo-800">Jornada</span>
            </a>
        </div>

        <!-- Navigation Links -->
        <nav class="flex-1 px-4 py-2 space-y-1 overflow-y-auto">
            <x-sidebar-link
                href="{{ route('dashboard') }}"
                :active="request()->routeIs('dashboard')"
            >
                <x-slot name="icon">
                    <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 12l2-2m0 0l7-7 7 7M5 10v10a1 1 0 001 1h3m10-11l2 2m-2-2v10a1 1 0 01-1 1h-3m-6 0a1 1 0 001-1v-4a1 1 0 011-1h2a1 1 0 011 1v4a1 1 0 001 1m-6 0h6" />
                    </svg>
                </x-slot>
                {{ __('Painel') }}
            </x-sidebar-link>

            <x-sidebar-link
                href="{{ route('habits.index') }}"
                :active="request()->routeIs('habits.*')"
            >
                <x-slot name="icon">
                    <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5H7a2 2 0 00-2 2v12a2 2 0 002 2h10a2 2 0 002-2V7a2 2 0 00-2-2h-2M9 5a2 2 0 002 2h2a2 2 0 002-2M9 5a2 2 0 012-2h2a2 2 0 012 2m-3 7h3m-3 4h3m-6-4h.01M9 16h.01" />
                    </svg>
                </x-slot>
                {{ __('Hábitos') }}
            </x-sidebar-link>

            <x-sidebar-link
                href="{{ route('daily-logs.index') }}"
                :active="request()->routeIs('daily-logs.*')"
            >
                <x-slot name="icon">
                    <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12h6m-6 4h6m2 5H7a2 2 0 01-2-2V5a2 2 0 012-2h5.586a1 1 0 01.707.293l5.414 5.414a1 1 0 01.293.707V19a2 2 0 01-2 2z" />
                    </svg>
                </x-slot>
                {{ __('Diários') }}
            </x-sidebar-link>

            <x-sidebar-link
                href="{{ route('goals.index') }}"
                :active="request()->routeIs('goals.*')"
            >
                <x-slot name="icon">
                    <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12l2 2 4-4m6 2a9 9 0 11-18 0 9 9 0 0118 0z" />
                    </svg>
                </x-slot>
                {{ __('Metas') }}
            </x-sidebar-link>

            <x-sidebar-link
                href="{{ route('collections.index') }}"
                :active="request()->routeIs('collections.*')"
            >
                <x-slot name="icon">
                    <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 11H5m14 0a2 2 0 012 2v6a2 2 0 01-2 2H5a2 2 0 01-2-2v-6a2 2 0 012-2m14 0V9a2 2 0 00-2-2M5 11V9a2 2 0 012-2m0 0V5a2 2 0 012-2h6a2 2 0 012 2v2M7 7h10" />
                    </svg>
                </x-slot>
                {{ __('Coleções') }}
            </x-sidebar-link>

            <x-sidebar-link
                href="{{ route('life-events.index') }}"
                :active="request()->routeIs('life-events.*')"
            >
                <x-slot name="icon">
                    <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M8 7V3m8 4V3m-9 8h10M5 21h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v12a2 2 0 002 2z" />
                    </svg>
                </x-slot>
                {{ __('Linha do Tempo') }}
            </x-sidebar-link>

            <!-- Submenu Autocuidado -->
            <div x-data="{ open: {{ request()->routeIs('self-care.checkins.*') ? 'true' : 'false' }} }">
                <button @click="open = !open" class="flex items-center w-full px-2 py-2 text-left rounded-lg transition hover:bg-indigo-50 focus:outline-none focus:bg-indigo-100 {{ request()->routeIs('self-care.checkins.*') ? 'bg-indigo-50 text-indigo-700' : 'text-gray-700' }}">
                    <svg class="w-5 h-5 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4.318 6.318a4.5 4.5 0 000 6.364L12 20.364l7.682-7.682a4.5 4.5 0 00-6.364-6.364L12 7.636l-1.318-1.318a4.5 4.5 0 00-6.364 0z" />
                    </svg>
                    <span class="flex-1">Autocuidado</span>
                    <svg :class="{'rotate-90': open}" class="w-4 h-4 ml-auto transition-transform" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5l7 7-7 7" />
                    </svg>
                </button>
                <div x-show="open" x-transition class="ml-7 mt-1 space-y-1">
                    <x-sidebar-link
                        href="{{ route('self-care.checkins.create') }}"
                        :active="request()->routeIs('self-care.checkins.create')"
                    >
                        <x-slot name="icon">
                            <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 4v16m8-8H4" />
                            </svg>
                        </x-slot>
                        Novo Check-in
                    </x-sidebar-link>
                    <x-sidebar-link
                        href="{{ route('self-care.checkins.history') }}"
                        :active="request()->routeIs('self-care.checkins.history')"
                    >
                        <x-slot name="icon">
                            <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8v4l3 3m6-3a9 9 0 11-18 0 9 9 0 0118 0z" />
                            </svg>
                        </x-slot>
                        Histórico
                    </x-sidebar-link>
                </div>
            </div>

            <hr class="border-t border-gray-200 my-3">

            <x-sidebar-link
                href="{{ route('profile.edit') }}"
                :active="request()->routeIs('profile.edit')"
            >
                <x-slot name="icon">
                    <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5.121 17.804A13.937 13.937 0 0112 15c2.485 0 4.779.758 6.879 2.053M15 10a3 3 0 11-6 0 3 3 0 016 0z" />
                    </svg>
                </x-slot>
                {{ __('Perfil') }}
            </x-sidebar-link>
        </nav>
    </div>

    <!-- Sidebar mobile -->
    <div
        x-show="open"
        x-transition:enter="transition ease-out duration-300"
        x-transition:enter-start="-translate-x-full"
        x-transition:enter-end="translate-x-0"
        x-transition:leave="transition ease-in duration-300"
        x-transition:leave-start="translate-x-0"
        x-transition:leave-end="-translate-x-full"
        class="fixed inset-y-0 left-0 w-64 bg-white border-r border-gray-200 flex-col h-full sm:hidden"
        style="display: none;"
    >
        <!-- Logo -->
        <div class="flex items-center justify-between h-16 px-4 border-b border-gray-200">
            <a href="{{ route('dashboard') }}" class="flex items-center space-x-2">
                <x-application-logo class="block h-8 w-auto fill-current text-indigo-600" />
                <span class="text-lg font-semibold text-indigo-800">Jornada</span>
            </a>
            <button @click="open = false" class="p-2 rounded-md text-gray-400 hover:text-gray-500 hover:bg-gray-100 focus:outline-none focus:bg-gray-100 focus:text-gray-500">
                <svg class="h-6 w-6" stroke="currentColor" fill="none" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12" />
                </svg>
            </button>
        </div>

        <!-- Navigation Links -->
        <nav class="flex-1 px-4 py-2 space-y-1 overflow-y-auto">
            <x-sidebar-link
                href="{{ route('dashboard') }}"
                :active="request()->routeIs('dashboard')"
            >
                <x-slot name="icon">
                    <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 12l2-2m0 0l7-7 7 7M5 10v10a1 1 0 001 1h3m10-11l2 2m-2-2v10a1 1 0 01-1 1h-3m-6 0a1 1 0 001-1v-4a1 1 0 011-1h2a1 1 0 011 1v4a1 1 0 001 1m-6 0h6" />
                    </svg>
                </x-slot>
                {{ __('Painel') }}
            </x-sidebar-link>

            <x-sidebar-link
                href="{{ route('habits.index') }}"
                :active="request()->routeIs('habits.*')"
            >
                <x-slot name="icon">
                    <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5H7a2 2 0 00-2 2v12a2 2 0 002 2h10a2 2 0 002-2V7a2 2 0 00-2-2h-2M9 5a2 2 0 002 2h2a2 2 0 002-2M9 5a2 2 0 012-2h2a2 2 0 012 2m-3 7h3m-3 4h3m-6-4h.01M9 16h.01" />
                    </svg>
                </x-slot>
                {{ __('Hábitos') }}
            </x-sidebar-link>

            <x-sidebar-link
                href="{{ route('daily-logs.index') }}"
                :active="request()->routeIs('daily-logs.*')"
            >
                <x-slot name="icon">
                    <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12h6m-6 4h6m2 5H7a2 2 0 01-2-2V5a2 2 0 012-2h5.586a1 1 0 01.707.293l5.414 5.414a1 1 0 01.293.707V19a2 2 0 01-2 2z" />
                    </svg>
                </x-slot>
                {{ __('Diários') }}
            </x-sidebar-link>

            <x-sidebar-link
                href="{{ route('goals.index') }}"
                :active="request()->routeIs('goals.*')"
            >
                <x-slot name="icon">
                    <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12l2 2 4-4m6 2a9 9 0 11-18 0 9 9 0 0118 0z" />
                    </svg>
                </x-slot>
                {{ __('Metas') }}
            </x-sidebar-link>

            <x-sidebar-link
                href="{{ route('collections.index') }}"
                :active="request()->routeIs('collections.*')"
            >
                <x-slot name="icon">
                    <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 11H5m14 0a2 2 0 012 2v6a2 2 0 01-2 2H5a2 2 0 01-2-2v-6a2 2 0 012-2m14 0V9a2 2 0 00-2-2M5 11V9a2 2 0 012-2m0 0V5a2 2 0 012-2h6a2 2 0 012 2v2M7 7h10" />
                    </svg>
                </x-slot>
                {{ __('Coleções') }}
            </x-sidebar-link>

            <x-sidebar-link
                href="{{ route('life-events.index') }}"
                :active="request()->routeIs('life-events.*')"
            >
                <x-slot name="icon">
                    <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M8 7V3m8 4V3m-9 8h10M5 21h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v12a2 2 0 002 2z" />
                    </svg>
                </x-slot>
                {{ __('Linha do Tempo') }}
            </x-sidebar-link>

            <!-- Submenu Autocuidado -->
            <div x-data="{ open: {{ request()->routeIs('self-care.checkins.*') ? 'true' : 'false' }} }">
                <button @click="open = !open" class="flex items-center w-full px-2 py-2 text-left rounded-lg transition hover:bg-indigo-50 focus:outline-none focus:bg-indigo-100 {{ request()->routeIs('self-care.checkins.*') ? 'bg-indigo-50 text-indigo-700' : 'text-gray-700' }}">
                    <svg class="w-5 h-5 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4.318 6.318a4.5 4.5 0 000 6.364L12 20.364l7.682-7.682a4.5 4.5 0 00-6.364-6.364L12 7.636l-1.318-1.318a4.5 4.5 0 00-6.364 0z" />
                    </svg>
                    <span class="flex-1">Autocuidado</span>
                    <svg :class="{'rotate-90': open}" class="w-4 h-4 ml-auto transition-transform" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5l7 7-7 7" />
                    </svg>
                </button>
                <div x-show="open" x-transition class="ml-7 mt-1 space-y-1">
                    <x-sidebar-link
                        href="{{ route('self-care.checkins.create') }}"
                        :active="request()->routeIs('self-care.checkins.create')"
                    >
                        <x-slot name="icon">
                            <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 4v16m8-8H4" />
                            </svg>
                        </x-slot>
                        Novo Check-in
                    </x-sidebar-link>
                    <x-sidebar-link
                        href="{{ route('self-care.checkins.history') }}"
                        :active="request()->routeIs('self-care.checkins.history')"
                    >
                        <x-slot name="icon">
                            <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8v4l3 3m6-3a9 9 0 11-18 0 9 9 0 0118 0z" />
                            </svg>
                        </x-slot>
                        Histórico
                    </x-sidebar-link>
                </div>
            </div>

            <hr class="border-t border-gray-200 my-3">

            <x-sidebar-link
                href="{{ route('profile.edit') }}"
                :active="request()->routeIs('profile.edit')"
            >
                <x-slot name="icon">
                    <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5.121 17.804A13.937 13.937 0 0112 15c2.485 0 4.779.758 6.879 2.053M15 10a3 3 0 11-6 0 3 3 0 016 0z" />
                    </svg>
                </x-slot>
                {{ __('Perfil') }}
            </x-sidebar-link>
        </nav>
    </div>

    <!-- Botão mobile -->
    <div class="fixed top-4 left-4 z-50 sm:hidden">
        <button @click="open = !open" class="p-2 rounded-md text-gray-400 hover:text-gray-500 hover:bg-gray-100 focus:outline-none focus:bg-gray-100 focus:text-gray-500">
            <svg class="h-6 w-6" stroke="currentColor" fill="none" viewBox="0 0 24 24">
                <path :class="{'hidden': open, 'inline-flex': !open }" class="inline-flex" stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 6h16M4 12h16M4 18h16" />
                <path :class="{'hidden': !open, 'inline-flex': open }" class="hidden" stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12" />
            </svg>
        </button>
    </div>
</aside>
