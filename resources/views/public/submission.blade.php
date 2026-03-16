@extends('layouts.app')

@section('title', 'Form Pengajuan Satyalancana')

@section('content')
<section class="py-16 bg-gradient-to-br from-indigo-900 via-indigo-800 to-purple-900 min-h-[28vh] flex items-center">
    <div class="max-w-3xl mx-auto px-4 sm:px-6 lg:px-8 text-center w-full">
        <div class="text-5xl mb-4">📝</div>
        <h1 class="text-3xl sm:text-4xl font-bold text-white mb-3">Form Pengajuan Satyalancana</h1>
        <p class="text-indigo-200 text-lg">Isi data dengan lengkap dan unggah dokumen yang diperlukan</p>
    </div>
</section>

<section class="py-12 bg-slate-50">
    <div class="max-w-2xl mx-auto px-4 sm:px-6 lg:px-8"
         x-data="{
            nip: '{{ old('nip') }}',
            yearsOfService: 0,
            allowedTypes: [],
            calcTenure() {
                const numericNip = this.nip.replace(/\D/g, '');
                if (numericNip.length !== 18) {
                    this.yearsOfService = 0;
                    this.allowedTypes = [];
                    this.$dispatch('update-options-submission_type', []);
                    return;
                }

                const cpnsYear = parseInt(numericNip.substring(8, 12));
                const currentYear = new Date().getFullYear();

                if (isNaN(cpnsYear) || cpnsYear < 1960 || cpnsYear > currentYear) {
                    this.yearsOfService = 0;
                    this.allowedTypes = [];
                    this.$dispatch('update-options-submission_type', []);
                    return;
                }

                let years = currentYear - cpnsYear;
                this.yearsOfService = years;
                this.allowedTypes = [];

                if (years >= 10) this.allowedTypes.push({value: '10 Tahun', label: 'Satyalancana 10 Tahun'});
                if (years >= 20) this.allowedTypes.push({value: '20 Tahun', label: 'Satyalancana 20 Tahun'});
                if (years >= 30) this.allowedTypes.push({value: '30 Tahun', label: 'Satyalancana 30 Tahun'});

                this.$dispatch('update-options-submission_type', this.allowedTypes);
            }
        }"
        x-init="calcTenure()">

        <div class="bg-white rounded-2xl shadow-xl border border-slate-100">
            <div class="bg-indigo-600 p-6">
                <h2 class="text-white font-bold text-xl">Data Pengajuan</h2>
                <p class="text-indigo-100 text-sm mt-1 text-opacity-80">Isi data di bawah ini untuk memulai proses pengajuan.</p>
            </div>
            <div class="p-6 sm:p-8">
                @if($errors->any())
                <div class="mb-6 bg-red-50 border border-red-200 rounded-xl p-4">
                    <ul class="list-disc list-inside text-sm text-red-600 space-y-1">
                        @foreach($errors->all() as $error)
                            <li>{{ $error }}</li>
                        @endforeach
                    </ul>
                </div>
                @endif

                <form action="{{ route('submission.store') }}" method="POST" enctype="multipart/form-data" class="space-y-6">
                    @csrf

                    {{-- NIP --}}
                    <div class="space-y-2">
                        <x-ui.label for="nip">Nomor Induk Pegawai (NIP)</x-ui.label>
                        <x-ui.input type="text" name="nip" id="nip" x-model="nip" @input="calcTenure()"
                               maxlength="18" inputmode="numeric" onkeypress="return /[0-9]/.test(event.key)"
                               placeholder="18 digit angka NIP..." required />

                        {{-- Masa Kerja Info --}}
                        <template x-if="nip.length === 18 && yearsOfService >= 10">
                            <div class="mt-3 p-3 bg-green-50 border border-green-100 rounded-lg text-sm text-green-700 flex items-center gap-2 animate-fade-in">
                                <svg class="w-4 h-4 flex-shrink-0" fill="currentColor" viewBox="0 0 20 20"><path fill-rule="evenodd" d="M10 18a8 8 0 100-16 8 8 0 000 16zm3.707-9.293a1 1 0 00-1.414-1.414L9 10.586 7.707 9.293a1 1 0 00-1.414-1.414l2 2a1 1 0 001.414 0l4-4z" clip-rule="evenodd"/></svg>
                                <span>CPNS: <strong x-text="nip.substring(8, 12)"></strong> • Masa Kerja: <strong x-text="yearsOfService"></strong> Thn</span>
                            </div>
                        </template>
                        <template x-if="nip.length === 18 && yearsOfService < 10 && yearsOfService > 0">
                            <div class="mt-3 p-3 bg-red-50 border border-red-100 rounded-lg text-sm text-red-600 flex items-center gap-2 animate-fade-in">
                                <svg class="w-4 h-4 flex-shrink-0" fill="currentColor" viewBox="0 0 20 20"><path fill-rule="evenodd" d="M10 18a8 8 0 100-16 8 8 0 000 16zM8.707 7.293a1 1 0 00-1.414 1.414L8.586 10l-1.293 1.293a1 1 0 101.414 1.414L10 11.414l1.293 1.293a1 1 0 001.414-1.414L11.414 10l1.293-1.293a1 1 0 00-1.414-1.414L10 8.586 8.707 7.293z" clip-rule="evenodd"/></svg>
                                <span>Syarat minimal (10 thn) belum terpenuhi.</span>
                            </div>
                        </template>
                    </div>

                    {{-- Nama Lengkap --}}
                    <div class="space-y-2">
                        <x-ui.label for="name">Nama Lengkap</x-ui.label>
                        <x-ui.input type="text" name="name" id="name" value="{{ old('name') }}"
                               placeholder="Masukkan nama lengkap sesuai SK..." required />
                    </div>

                    {{-- Nomor Telepon --}}
                    <div class="space-y-2">
                        <x-ui.label for="phone">Nomor Telepon/WhatsApp</x-ui.label>
                        <x-ui.input type="text" name="phone" id="phone" value="{{ old('phone') }}"
                                placeholder="Contoh: 081234567890" required />
                    </div>

                    {{-- Unit Kerja --}}
                    <div class="space-y-2">
                        <x-ui.label for="department_name">Unit Kerja (OPD)</x-ui.label>
                        <x-ui.select name="department_name" id="department_name"
                                    placeholder="-- Pilih Unit Kerja --"
                                    :options="$departments->map(fn($d) => ['value' => $d->name, 'label' => $d->name])->toArray()"
                                    :selected="old('department_name')" required />
                    </div>

                    {{-- Jenis Pengajuan --}}
                    <div class="space-y-2 relative z-30">
                        <x-ui.label for="submission_type">Jenis Pengajuan</x-ui.label>
                        <div x-show="allowedTypes.length > 0" class="animate-fade-in">
                            <x-ui.select name="submission_type" id="submission_type"
                                        placeholder="-- Pilih jenis pengajuan --"
                                        :selected="old('submission_type')" required />
                        </div>
                        <div x-show="allowedTypes.length === 0" class="h-10 px-3 py-2 rounded-md border border-dashed border-slate-200 bg-slate-50 text-slate-400 text-sm flex items-center">
                            Masukkan NIP valid terlebih dahulu
                        </div>
                        <p class="text-[10px] text-slate-400 italic">Pilihan divalidasi otomatis berdasarkan Masa Kerja (CPNS).</p>
                    </div>

                    {{-- Divider --}}
                    <div class="relative py-2 z-0">
                        <div class="absolute inset-0 flex items-center"><span class="w-full border-t border-slate-100"></span></div>
                        <div class="relative flex justify-center text-xs uppercase"><span class="bg-white px-2 text-slate-400 font-medium tracking-wider">Dokumen Lampiran</span></div>
                    </div>

                    {{-- File Uploads --}}
                    <div class="grid grid-cols-1 gap-4">
                        @foreach([
                            ['name'=>'file_drh','label'=>'Daftar Riwayat Hidup (DRH)','icon'=>'📋'],
                            ['name'=>'file_sk_cpns','label'=>'SK CPNS','icon'=>'📄'],
                            ['name'=>'file_sk_pns','label'=>'SK PNS','icon'=>'📄'],
                        ] as $file)
                        <div class="space-y-2">
                            <x-ui.label for="{{ $file['name'] }}">
                                <span class="mr-1">{{ $file['icon'] }}</span> {{ $file['label'] }}
                            </x-ui.label>
                            <input type="file" name="{{ $file['name'] }}" id="{{ $file['name'] }}" accept=".pdf"
                                   class="flex w-full rounded-md border border-slate-200 bg-white px-3 py-2 text-sm file:mr-3 file:py-0 file:px-2 file:rounded file:border-0 file:bg-indigo-50 file:text-indigo-600 file:font-semibold file:text-xs hover:file:bg-indigo-100 transition-colors">
                            @error($file['name'])
                            <p class="text-[11px] text-red-500 font-medium">{{ $message }}</p>
                            @enderror
                        </div>
                        @endforeach
                    </div>

                    {{-- Submit --}}
                    <x-ui.button type="submit" variant="gradient" size="xl" class="w-full mt-4" ::disabled="allowedTypes.length === 0">
                        Kirim Pengajuan
                    </x-ui.button>
                </form>
            </div>
        </div>
    </div>
</section>
@endsection
