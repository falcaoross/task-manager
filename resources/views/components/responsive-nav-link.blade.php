@props(['active'])

@php
$classes = ($active ?? false)
            ? 'block w-full rounded-2xl border border-indigo-200 bg-indigo-50/80 px-4 py-2 text-start text-base font-semibold text-indigo-700 transition duration-150 ease-in-out'
            : 'block w-full rounded-2xl border border-transparent px-4 py-2 text-start text-base font-semibold text-slate-600 hover:bg-white/80 hover:text-slate-900 transition duration-150 ease-in-out';
@endphp

<a {{ $attributes->merge(['class' => $classes]) }}>
    {{ $slot }}
</a>
