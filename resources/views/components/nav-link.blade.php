@props(['active'])

@php
$classes = ($active ?? false)
    ? 'inline-flex items-center px-3 py-2 border-b-2 border-primary text-sm font-semibold text-secondary focus:outline-none focus:border-primary transition duration-150 ease-in-out'
    : 'inline-flex items-center px-3 py-2 border-b-2 border-transparent text-sm font-semibold text-gray-500 hover:text-secondary hover:border-primary focus:outline-none focus:text-secondary focus:border-primary transition duration-150 ease-in-out';
@endphp

<a {{ $attributes->merge(['class' => $classes]) }}>
    {{ $slot }}
</a>
