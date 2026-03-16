@extends('layouts.admin')
@section('title', 'Detail Pengajuan')
@section('content')
<div class="max-w-7xl space-y-6">
    <div class="flex items-center gap-4">
        <a href="{{ route('admin.submissions') }}" class="p-2 rounded-xl bg-white border border-slate-200 text-slate-500 hover:text-indigo-600 transition">
            <svg class="w-5 h-5" fill="none" viewBox="0 0 24 24" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M10 19l-7-7m0 0l7-7m-7 7h18"/></svg>
        </a>
        <div>
            <h2 class="font-bold text-slate-800 text-xl">Detail Pengajuan</h2>
            <p class="text-slate-400 text-sm">#{{ $submission->id }} — {{ $submission->name }}</p>
        </div>
    </div>

    <div class="grid sm:grid-cols-2 gap-6">
        {{-- Info ASN --}}
        <div class="bg-white rounded-2xl border border-slate-200 p-6 shadow-sm">
            <h3 class="font-bold text-slate-700 text-sm mb-4 uppercase tracking-wide">Data ASN</h3>
            <dl class="space-y-4">
                <div><dt class="text-xs text-slate-400">Nama</dt><dd class="font-semibold text-slate-800 mt-0.5">{{ $submission->name }}</dd></div>
                <div><dt class="text-xs text-slate-400">NIP</dt><dd class="font-semibold text-slate-800 mt-0.5">{{ $submission->nip }}</dd></div>
                <div><dt class="text-xs text-slate-400">Nomor Telepon</dt><dd class="font-semibold text-slate-800 mt-0.5">{{ $submission->phone ?? '-' }}</dd></div>
                <div><dt class="text-xs text-slate-400">OPD</dt><dd class="font-semibold text-slate-800 mt-0.5">{{ $submission->department_name }}</dd></div>
                @php
                    $cpnsYear = (int) substr($submission->nip, 8, 4);
                    $tenure = date('Y') - $cpnsYear;
                @endphp
                <div><dt class="text-xs text-slate-400">Estimasi Masa Kerja</dt><dd class="font-semibold text-slate-800 mt-0.5">{{ $tenure }} Tahun (CPNS {{ $cpnsYear }})</dd></div>
            </dl>
        </div>

        {{-- Info Pengajuan --}}
        <div class="bg-white rounded-2xl border border-slate-200 p-6 shadow-sm">
            <h3 class="font-bold text-slate-700 text-sm mb-4 uppercase tracking-wide">Data Pengajuan</h3>
            <dl class="space-y-4">
                <div><dt class="text-xs text-slate-400">Jenis Satyalancana</dt><dd class="font-semibold text-indigo-600 mt-0.5">{{ $submission->submission_type }}</dd></div>
                <div><dt class="text-xs text-slate-400">Tanggal Pengajuan</dt><dd class="font-semibold text-slate-800 mt-0.5">{{ $submission->created_at->format('d M Y, H:i') }}</dd></div>
                <div>
                    <dt class="text-xs text-slate-400 mb-1.5">Status Saat Ini</dt>
                    @php
                        $badge = [
                            'submitted'=>'bg-blue-100 text-blue-700',
                            'verification'=>'bg-amber-100 text-amber-700',
                            'processing'=>'bg-blue-100 text-blue-700',
                            'approved'=>'bg-lime-100 text-lime-700',
                            'completed'=>'bg-emerald-100 text-emerald-700',
                            'rejected'=>'bg-red-100 text-red-700'
                        ];
                        $lbl = [
                            'submitted'=>'Diterima',
                            'verification'=>'Verifikasi',
                            'processing'=>'Diproses',
                            'approved'=>'Disetujui',
                            'completed'=>'Selesai',
                            'rejected'=>'Ditolak'
                        ];
                    @endphp
                    <span class="inline-flex px-3 py-1.5 rounded-lg text-xs font-bold {{ $badge[$submission->status] ?? '' }}">{{ $lbl[$submission->status] ?? $submission->status }}</span>
                </div>
            </dl>
        </div>

        {{-- Rejection Reasoning --}}
        @if($submission->status === 'rejected')
        <div class="bg-red-50 rounded-2xl border border-red-100 p-6 shadow-sm">
            <h3 class="font-bold text-red-700 text-sm mb-4 uppercase tracking-wide flex items-center gap-2">
                <svg class="w-4 h-4" fill="none" viewBox="0 0 24 24" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 9v2m0 4h.01m-6.938 4h13.856c1.54 0 2.502-1.667 1.732-3L13.732 4c-.77-1.333-2.694-1.333-3.464 0L3.34 16c-.77 1.333.192 3 1.732 3z"/></svg>
                Alasan Penolakan
            </h3>
            <p class="text-sm text-red-600 leading-relaxed">{{ $submission->rejection_reason }}</p>
        </div>
        @endif
    </div>

    {{-- Dokumen --}}
    <div class="bg-white rounded-2xl border border-slate-200 p-6 shadow-sm">
        <h3 class="font-bold text-slate-700 text-sm mb-4 uppercase tracking-wide">Dokumen Upload</h3>
        <div class="grid grid-cols-1 sm:grid-cols-3 gap-4">
            @foreach([['label'=>'DRH','path'=>$submission->file_drh],['label'=>'SK CPNS','path'=>$submission->file_sk_cpns],['label'=>'SK PNS','path'=>$submission->file_sk_pns]] as $doc)
            <a href="{{ Storage::url($doc['path']) }}" target="_blank" class="flex items-center gap-3 p-4 rounded-xl border border-slate-200 hover:border-indigo-300 hover:bg-indigo-50 transition group">
                <div class="w-10 h-10 bg-slate-50 flex items-center justify-center rounded-xl group-hover:bg-white transition-all">📄</div>
                <div>
                    <div class="font-semibold text-slate-800 text-sm group-hover:text-indigo-600 transition">{{ $doc['label'] }}</div>
                    <div class="text-xs text-slate-400">Lihat PDF</div>
                </div>
                <svg class="w-4 h-4 ml-auto text-slate-400 group-hover:text-indigo-500" fill="none" viewBox="0 0 24 24" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M10 6H6a2 2 0 00-2 2v10a2 2 0 002 2h10a2 2 0 002-2v-4M14 4h6m0 0v6m0-6L10 14"/></svg>
            </a>
            @endforeach
        </div>
    </div>

    {{-- Update Status - Modern UI --}}
    <div class="bg-white rounded-2xl border border-slate-200 p-6 shadow-sm overflow-hidden" x-data="{ currentStatus: '{{ $submission->status }}' }">
        <h3 class="font-bold text-slate-700 text-sm mb-5 uppercase tracking-wide">Perbarui Status Pengajuan</h3>

        <form action="{{ route('admin.submissions.update-status', $submission) }}" method="POST" id="statusForm">
            @csrf @method('PATCH')

            <input type="hidden" name="status" :value="currentStatus">

            <div class="flex flex-wrap gap-3 mb-6">
                @php
                    $statuses = [
                        'submitted' => [
                            'label' => 'Diterima',
                            'active' => 'bg-indigo-600 text-white shadow-xl ring-2 ring-indigo-600 ring-offset-2 scale-105 z-10',
                            'inactive' => 'bg-white text-indigo-600 border border-indigo-200 hover:bg-indigo-50'
                        ],
                        'verification' => [
                            'label' => 'Verifikasi',
                            'active' => 'bg-amber-600 text-white shadow-xl ring-2 ring-amber-600 ring-offset-2 scale-105 z-10',
                            'inactive' => 'bg-white text-amber-600 border border-amber-200 hover:bg-amber-50'
                        ],
                        'processing' => [
                            'label' => 'Diproses',
                            'active' => 'bg-blue-600 text-white shadow-xl ring-2 ring-blue-600 ring-offset-2 scale-105 z-10',
                            'inactive' => 'bg-white text-blue-600 border border-blue-200 hover:bg-blue-50'
                        ],
                        'approved' => [
                            'label' => 'Setujui',
                            'active' => 'bg-lime-600 text-white shadow-xl ring-2 ring-lime-600 ring-offset-2 scale-105 z-10',
                            'inactive' => 'bg-white text-lime-600 border border-lime-200 hover:bg-lime-50'
                        ],
                        'completed' => [
                            'label' => 'Selesai',
                            'active' => 'bg-emerald-600 text-white shadow-xl ring-2 ring-emerald-600 ring-offset-2 scale-105 z-10',
                            'inactive' => 'bg-white text-emerald-600 border border-emerald-200 hover:bg-emerald-50'
                        ],
                        'rejected' => [
                            'label' => 'Tolak',
                            'active' => 'bg-red-600 text-white shadow-xl ring-2 ring-red-600 ring-offset-2 scale-105 z-10',
                            'inactive' => 'bg-white text-red-600 border border-red-200 hover:bg-red-50'
                        ]
                    ];
                @endphp
                @foreach($statuses as $val => $info)
                <button type="button"
                        @click="currentStatus = '{{ $val }}'"
                        :class="currentStatus === '{{ $val }}' ? '{{ $info['active'] }}' : '{{ $info['inactive'] }}'"
                        class="px-6 py-3 rounded-xl text-sm font-bold transition-all duration-200">
                    {{ $info['label'] }}
                </button>
                @endforeach
            </div>

            <div x-show="currentStatus === 'rejected'" class="mb-6 space-y-2" x-transition>
                <label class="block text-sm font-semibold text-slate-700">Alasan Penolakan <span class="text-red-500">*</span></label>
                <textarea name="rejection_reason" rows="3"
                          class="w-full px-4 py-3 rounded-xl border border-slate-200 focus:ring-2 focus:ring-red-300 outline-none transition"
                          placeholder="Jelaskan mengapa pengajuan ditolak agar user dapat memperbaikinya...">{{ $submission->rejection_reason }}</textarea>
            </div>

            <div class="flex justify-end">
                <button type="submit" class="bg-slate-900 text-white font-bold px-8 py-3 rounded-xl hover:bg-indigo-600 transition shadow-lg shadow-indigo-900/20 active:scale-[0.98]">
                    Simpan Perubahan Status
                </button>
            </div>
        </form>
    </div>
</div>
@endsection
