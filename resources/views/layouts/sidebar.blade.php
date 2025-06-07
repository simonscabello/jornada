@props(['active'])

<aside x-data="{ open: false }" class="z-50">
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
                href="{{ route('self-care.checkins.create') }}"
                :active="request()->routeIs('self-care.*')"
            >
                <x-slot name="icon">
                    <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4.318 6.318a4.5 4.5 0 000 6.364L12 20.364l7.682-7.682a4.5 4.5 0 00-6.364-6.364L12 7.636l-1.318-1.318a4.5 4.5 0 00-6.364 0z" />
                    </svg>
                </x-slot>
                {{ __('Autocuidado') }}
            </x-sidebar-link>
        </nav>
    </div>

    <!-- Sidebar mobile -->
    <div
        class="fixed inset-y-0 left-0 w-64 bg-white border-r border-gray-200 flex-col h-full transition-transform duration-200 ease-in-out sm:hidden"
        :class="{ '-translate-x-full': !open, 'translate-x-0': open }"
    >
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
                icon="<path stroke-linecap='round' stroke-linejoin='round' stroke-width='2' d='M3 12l2-2m0 0l7-7 7 7M5 10v10a1 1 0 001 1h3m10-11l2 2m-2-2v10a1 1 0 01-1 1h-3m-6 0a1 1 0 001-1v-4a1 1 0 011-1h2a1 1 0 011 1v4a1 1 0 001 1m-6 0h6' />"
            >
                {{ __('Painel') }}
            </x-sidebar-link>

            <x-sidebar-link
                href="{{ route('habits.index') }}"
                :active="request()->routeIs('habits.*')"
                icon="<path stroke-linecap='round' stroke-linejoin='round' stroke-width='2' d='M9 5H7a2 2 0 00-2 2v12a2 2 0 002 2h10a2 2 0 002-2V7a2 2 0 00-2-2h-2M9 5a2 2 0 002 2h2a2 2 0 002-2M9 5a2 2 0 012-2h2a2 2 0 012 2m-3 7h3m-3 4h3m-6-4h.01M9 16h.01' />"
            >
                {{ __('Hábitos') }}
            </x-sidebar-link>

            <x-sidebar-link
                href="{{ route('daily-logs.index') }}"
                :active="request()->routeIs('daily-logs.*')"
                icon="<path stroke-linecap='round' stroke-linejoin='round' stroke-width='2' d='M9 12h6m-6 4h6m2 5H7a2 2 0 01-2-2V5a2 2 0 012-2h5.586a1 1 0 01.707.293l5.414 5.414a1 1 0 01.293.707V19a2 2 0 01-2 2z' />"
            >
                {{ __('Diários') }}
            </x-sidebar-link>

            <x-sidebar-link
                href="{{ route('goals.index') }}"
                :active="request()->routeIs('goals.*')"
                icon="<path stroke-linecap='round' stroke-linejoin='round' stroke-width='2' d='M9 12l2 2 4-4m6 2a9 9 0 11-18 0 9 9 0 0118 0z' />"
            >
                {{ __('Metas') }}
            </x-sidebar-link>

            <x-sidebar-link
                href="{{ route('collections.index') }}"
                :active="request()->routeIs('collections.*')"
                icon="<path stroke-linecap='round' stroke-linejoin='round' stroke-width='2' d='M19 11H5m14 0a2 2 0 012 2v6a2 2 0 01-2 2H5a2 2 0 01-2-2v-6a2 2 0 012-2m14 0V9a2 2 0 00-2-2M5 11V9a2 2 0 012-2m0 0V5a2 2 0 012-2h6a2 2 0 012 2v2M7 7h10' />"
            >
                {{ __('Coleções') }}
            </x-sidebar-link>

            <x-sidebar-link
                href="{{ route('self-care.checkins.create') }}"
                :active="request()->routeIs('self-care.*')"
                icon="<path stroke-linecap='round' stroke-linejoin='round' stroke-width='2' d='M4.318 6.318a4.5 4.5 0 000 6.364L12 20.364l7.682-7.682a4.5 4.5 0 00-6.364-6.364L12 7.636l-1.318-1.318a4.5 4.5 0 00-6.364 0z' />"
            >
                {{ __('Autocuidado') }}
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
