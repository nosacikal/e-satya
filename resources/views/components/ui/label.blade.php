@props(['value'])

<label {{ $attributes->merge(['class' => 'text-sm font-medium leading-none peer-disabled:cursor-not-allowed peer-disabled:opacity-70 text-slate-700']) }}>
    {{ $value ?? $slot }}
</label>
