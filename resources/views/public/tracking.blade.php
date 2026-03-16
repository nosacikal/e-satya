@extends('layouts.app')

@section('title', 'Lacak Pengajuan')

@section('content')
<section class="py-16 bg-gradient-to-br from-indigo-900 via-indigo-800 to-purple-900 min-h-[30vh] flex items-center">
    <div class="max-w-3xl mx-auto px-4 sm:px-6 lg:px-8 text-center w-full">
        <div class="text-5xl mb-4">🔍</div>
        <h1 class="text-3xl sm:text-4xl font-bold text-white mb-3">Lacak Pengajuan</h1>
        <p class="text-indigo-200 text-lg">Masukkan NIP Anda untuk melihat status pengajuan Satyalancana</p>
    </div>
</section>

<section class="py-16 bg-slate-50">
    <div class="max-w-2xl mx-auto px-4 sm:px-6 lg:px-8">

        {{-- Search Form --}}
        <div class="bg-white rounded-2xl shadow-xl border border-slate-100 overflow-hidden mb-8">
            <div class="bg-gradient-to-r from-indigo-600 to-purple-700 p-6">
                <h2 class="text-white font-bold text-xl">Cek Status Pengajuan</h2>
                <p class="text-indigo-200 text-sm mt-1">Gunakan NIP untuk melacak status terkini</p>
            </div>
            <div class="p-6">
                <form action="{{ route('tracking.search') }}" method="POST">
                    @csrf
                    <div class="mb-4">
                        <label class="block text-sm font-semibold text-slate-700 mb-2" for="track_nip">Nomor Induk Pegawai (NIP)</label>
                        <input type="text" name="nip" id="track_nip" value="{{ old('nip', $submission->nip ?? '') }}"
                               placeholder="Masukkan NIP Anda..."
                               class="w-full px-4 py-3 rounded-xl border text-base {{ $errors->has('nip') ? 'border-red-400 focus:ring-red-300' : 'border-slate-200' }} bg-white text-slate-800 focus:outline-none focus:ring-2 focus:ring-indigo-300 transition">
                        @error('nip')
                        <p class="mt-2 text-sm text-red-500 flex items-center gap-1">
                            <svg class="w-4 h-4" fill="currentColor" viewBox="0 0 20 20"><path fill-rule="evenodd" d="M18 10a8 8 0 11-16 0 8 8 0 0116 0zm-7 4a1 1 0 11-2 0 1 1 0 012 0zm-1-9a1 1 0 00-1 1v4a1 1 0 102 0V6a1 1 0 00-1-1z" clip-rule="evenodd"/></svg>
                            {{ $message }}
                        </p>
                        @enderror
                    </div>

                    <div class="mb-6">
                        <label class="block text-sm font-semibold text-slate-700 mb-2" for="submission_type">Jenis Pengajuan</label>
                        <select name="submission_type" id="submission_type"
                                class="w-full px-4 py-3 rounded-xl border border-slate-200 bg-white text-slate-800 focus:outline-none focus:ring-2 focus:ring-indigo-300 transition">
                            <option value="">-- Pilih Jenis Pengajuan --</option>
                            @foreach(['10 Tahun', '20 Tahun', '30 Tahun'] as $type)
                                <option value="{{ $type }}" {{ old('submission_type', $submission->submission_type ?? '') == $type ? 'selected' : '' }}>
                                    Satyalancana {{ $type }}
                                </option>
                            @endforeach
                        </select>
                        @error('submission_type')
                        <p class="mt-2 text-sm text-red-500">{{ $message }}</p>
                        @enderror
                    </div>
                    <button type="submit" class="w-full bg-gradient-to-r from-indigo-600 to-purple-700 text-white font-bold py-3 px-6 rounded-xl text-base hover:from-indigo-700 hover:to-purple-800 transition-all duration-300 shadow-lg hover:shadow-indigo-300/40 hover:scale-[1.02]">
                        Cek Status Pengajuan
                    </button>
                </form>
            </div>
        </div>

        {{-- Result --}}
        @isset($submission)
        @if($submission->status === 'rejected')
            {{-- Rejected Status with Re-upload form --}}
            <div class="bg-white rounded-2xl shadow-xl border border-red-200 overflow-hidden animate-fade-in-up">
                <div class="bg-red-600 p-6 flex items-center gap-4">
                    <div class="w-12 h-12 bg-white/20 rounded-xl flex items-center justify-center text-white text-2xl">⚠️</div>
                    <div>
                        <h3 class="text-white font-bold text-lg">Pengajuan Ditolak</h3>
                        <p class="text-red-100 text-sm">Mohon perbaiki dokumen sesuai catatan di bawah</p>
                    </div>
                </div>
                <div class="p-6 border-b border-red-50 bg-red-50/30">
                    <h4 class="text-xs uppercase tracking-wider font-bold text-red-700 mb-2">Alasan Penolakan:</h4>
                    <p class="text-slate-700 font-medium leading-relaxed">{{ $submission->rejection_reason }}</p>
                </div>
                <div class="p-6">
                    <h4 class="font-bold text-slate-800 mb-4 flex items-center gap-2">
                        <span class="w-6 h-6 bg-indigo-100 text-indigo-600 rounded-lg flex items-center justify-center text-xs">!</span>
                        Upload Ulang Dokumen
                    </h4>

                    <form action="{{ route('submission.reupload', $submission) }}" method="POST" enctype="multipart/form-data" class="space-y-4">
                        @csrf @method('PUT')
                        @foreach([
                            ['name'=>'file_drh','label'=>'Daftar Riwayat Hidup (DRH)','icon'=>'📋'],
                            ['name'=>'file_sk_cpns','label'=>'SK CPNS','icon'=>'📄'],
                            ['name'=>'file_sk_pns','label'=>'SK PNS','icon'=>'📄'],
                        ] as $file)
                        <div class="relative">
                            <label class="block text-xs font-bold text-slate-500 mb-1 uppercase tracking-wide">{{ $file['label'] }}</label>
                            <input type="file" name="{{ $file['name'] }}" accept=".pdf"
                                   class="w-full px-4 py-2.5 rounded-xl border border-slate-200 bg-white text-slate-700 text-sm focus:outline-none focus:ring-2 focus:ring-indigo-300 transition file:mr-3 file:py-1 file:px-3 file:rounded-lg file:border-0 file:bg-indigo-50 file:text-indigo-600 file:font-medium file:text-xs">
                        </div>
                        @endforeach

                        <button type="submit" class="w-full bg-slate-900 text-white font-bold py-3.5 rounded-xl hover:bg-indigo-600 transition shadow-lg shadow-indigo-900/20 active:scale-[0.98] mt-2">
                            Kirim Perbaikan Dokumen
                        </button>
                    </form>
                </div>
            </div>
        @else
            {{-- Standard Progress Tracking --}}
            @php
                $steps = [
                    'submitted'    => ['label' => 'Pengajuan Diterima',  'icon' => '📥'],
                    'verification' => ['label' => 'Verifikasi Dokumen',  'icon' => '🔍'],
                    'processing'   => ['label' => 'Proses Usulan',       'icon' => '⚙️'],
                    'approved'     => ['label' => 'Disetujui',           'icon' => '✅'],
                    'completed'    => ['label' => 'Selesai',             'icon' => '🎖️'],
                ];
                $statusOrder = array_keys($steps);
                $currentIndex = array_search($submission->status, $statusOrder);
            @endphp
            <div class="bg-white rounded-2xl shadow-xl border border-slate-100 overflow-hidden animate-fade-in">
                <div class="px-6 py-5 border-b border-slate-100">
                    <h3 class="font-bold text-slate-800 text-lg">Hasil Tracking</h3>
                    <p class="text-slate-500 text-sm mt-0.5">{{ $submission->name }} — NIP: {{ $submission->nip }}</p>
                </div>
                <div class="p-6">
                    <div class="flex items-center justify-between mb-2 text-sm">
                        <span class="text-slate-500">Jenis Pengajuan</span>
                        <span class="font-bold text-indigo-700">Satyalancana {{ $submission->submission_type }}</span>
                    </div>
                    <div class="flex items-center justify-between mb-8 text-sm">
                        <span class="text-slate-500">Tanggal Pengajuan</span>
                        <span class="font-semibold text-slate-700">{{ $submission->created_at->format('d M Y') }}</span>
                    </div>

                    {{-- Progress Steps --}}
                    <div class="space-y-2">
                        @foreach($steps as $key => $step)
                        @php
                            $stepIndex = array_search($key, $statusOrder);
                            $isDone = $stepIndex <= $currentIndex;
                            $isCurrent = $stepIndex === $currentIndex;
                        @endphp
                        <div class="relative flex items-center gap-4 p-4 rounded-xl {{ $isCurrent ? 'bg-indigo-50 border border-indigo-100' : ($isDone ? 'bg-slate-50' : 'opacity-60') }}">
                            <div class="w-10 h-10 flex-shrink-0 rounded-full flex items-center justify-center text-lg {{ $isDone ? 'bg-indigo-600 text-white shadow-md' : 'bg-slate-200 text-slate-400' }}">
                                @if($isDone){{ $step['icon'] }}@else<span class="text-xs font-bold">{{ $stepIndex + 1 }}</span>@endif
                            </div>
                            <div class="flex-1">
                                <div class="font-bold text-sm {{ $isDone ? 'text-slate-800' : 'text-slate-400' }}">{{ $step['label'] }}</div>
                                @if($isCurrent) <div class="text-[10px] text-indigo-600 font-bold uppercase tracking-widest mt-0.5">Sedang Berlangsung</div> @endif
                            </div>
                            @if($isDone && !$isCurrent)
                                <svg class="w-5 h-5 text-indigo-600" fill="currentColor" viewBox="0 0 20 20"><path fill-rule="evenodd" d="M10 18a8 8 0 100-16 8 8 0 000 16zm3.707-9.293a1 1 0 00-1.414-1.414L9 10.586 7.707 9.293a1 1 0 00-1.414 1.414l2 2a1 1 0 001.414 0l4-4z" clip-rule="evenodd"/></svg>
                            @endif
                        </div>
                        @endforeach
                    </div>
                </div>
            </div>
        @endif
        @endisset

    </div>
</section>
@endsection
