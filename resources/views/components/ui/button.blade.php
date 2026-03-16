@props([
    'variant' => 'default',
    'size' => 'default',
])

@php
    $variants = [
        'default' => 'bg-indigo-600 text-white hover:bg-indigo-700 shadow-sm',
        'destructive' => 'bg-red-500 text-white hover:bg-red-600 shadow-sm',
        'outline' => 'border border-slate-200 bg-white hover:bg-slate-100 text-slate-900',
        'secondary' => 'bg-slate-100 text-slate-900 hover:bg-slate-200',
        'ghost' => 'hover:bg-slate-100 text-slate-700',
        'link' => 'text-indigo-600 underline-offset-4 hover:underline',
        'gradient' => 'bg-gradient-to-r from-indigo-600 to-purple-700 text-white hover:from-indigo-700 hover:to-purple-800 shadow-lg hover:shadow-indigo-300/50',
    ];

    $sizes = [
        'default' => 'h-10 px-4 py-2',
        'sm' => 'h-9 rounded-md px-3',
        'lg' => 'h-11 rounded-md px-8',
        'xl' => 'h-14 rounded-xl px-10 text-base',
        'icon' => 'h-10 w-10',
    ];

    $classes = $variants[$variant] . ' ' . $sizes[$size];
@endphp

<button {{ $attributes->merge(['class' => "inline-flex items-center justify-center rounded-md text-sm font-medium ring-offset-white transition-all focus-visible:outline-none focus-visible:ring-2 focus-visible:ring-indigo-500 focus-visible:ring-offset-2 disabled:pointer-events-none disabled:opacity-50 active:scale-[0.98] " . $classes]) }}>
    {{ $slot }}
</button>
