@props([
    'name',
    'id' => null,
    'placeholder' => 'Pilih opsi...',
    'options' => [],
    'selected' => null,
    'disabled' => false,
])

<div x-data="{
    open: false,
    value: '{{ $selected }}',
    label: '',
    options: {{ json_encode($options) }},
    init() {
        this.updateLabel();
        this.$watch('value', () => this.updateLabel());
        this.$watch('options', () => this.updateLabel());
    },
    updateLabel() {
        if (this.value) {
            const found = this.options.find(o => o.value == this.value);
            this.label = found ? found.label : '';
            if (!found) this.value = '';
        } else {
            this.label = '';
        }
    },
    select(option) {
        this.value = option.value;
        this.label = option.label;
        this.open = false;
        $dispatch('input', this.value);
        $dispatch('change', this.value);
    }
}"
@update-options-{{ $id ?? $name }}.window="options = $event.detail; updateLabel()"
class="relative w-full"
:class="open ? 'z-50' : 'z-auto'"
@click.outside="open = false"
{{ $attributes->whereDoesntStartWith('options') }}>
    <!-- Hidden input for form submission -->
    <input type="hidden" name="{{ $name }}" :value="value" :disabled="{{ $disabled ? 'true' : 'false' }}">

    <!-- Trigger -->
    <button type="button"
        @click="open = !open"
        :disabled="{{ $disabled ? 'true' : 'false' }}"
        class="flex h-10 w-full items-center justify-between rounded-md border border-slate-200 bg-white px-3 py-2 text-sm ring-offset-white placeholder:text-slate-500 focus:outline-none focus:ring-2 focus:ring-indigo-500 focus:ring-offset-2 disabled:cursor-not-allowed disabled:opacity-50 transition-all duration-200 shadow-sm text-left">
        <span x-text="label || '{{ $placeholder }}'" :class="!label && 'text-slate-500'"></span>
        <svg class="h-4 w-4 opacity-50" fill="none" viewBox="0 0 24 24" stroke="currentColor">
            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 9l-7 7-7-7" />
        </svg>
    </button>

    <!-- Dropdown -->
    <div x-show="open"
        x-transition:enter="transition ease-out duration-100"
        x-transition:enter-start="opacity-0 scale-95"
        x-transition:enter-end="opacity-100 scale-100"
        x-transition:leave="transition ease-in duration-75"
        x-transition:leave-start="opacity-100 scale-100"
        x-transition:leave-end="opacity-0 scale-95"
        class="absolute z-50 mt-2 w-full min-w-[8rem] overflow-hidden rounded-md border border-slate-200 bg-white text-slate-950 shadow-md outline-none">
        <div class="max-h-60 overflow-auto p-1">
            <template x-if="options.length === 0">
                <div class="py-2 px-2 text-sm text-slate-500 text-center">Tidak ada pilihan</div>
            </template>
            <template x-for="option in options" :key="option.value">
                <button type="button"
                    @click="select(option)"
                    class="relative flex w-full cursor-default select-none items-center rounded-sm py-1.5 pl-2 pr-8 text-sm outline-none hover:bg-slate-100 focus:bg-slate-100 data-[disabled]:pointer-events-none data-[disabled]:opacity-50 transition-colors"
                    :class="value === option.value ? 'bg-slate-100' : ''">
                    <span x-text="option.label" class="block truncate"></span>
                    <span x-show="value === option.value" class="absolute right-2 flex h-3.5 w-3.5 items-center justify-center text-indigo-600">
                        <svg class="h-4 w-4" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7" />
                        </svg>
                    </span>
                </button>
            </template>
        </div>
    </div>
</div>
