@props(['href', 'active' => false])

<a href="{{ $href }}" {{ $attributes->merge([
    'class' => 'flex items-center px-4 py-2 text-base font-medium rounded-lg transition-colors duration-150 ' .
    ($active ? 'bg-indigo-50 text-indigo-600' : 'text-gray-700 hover:bg-gray-50')
]) }}>
    <span class="w-5 h-5 mr-3 flex items-center justify-center">
        {{ $icon ?? '' }}
    </span>
    {{ $slot }}
</a>
