@extends('layouts.admin')
@section('title', 'Data Pengajuan')
@section('content')
<div class="space-y-6">
    <form action="{{ route('admin.submissions') }}" method="GET" class="space-y-4">
        <div class="flex flex-col sm:flex-row sm:items-center justify-between gap-4">
            <div>
                <h2 class="font-bold text-slate-800 text-xl">Manajemen Pengajuan</h2>
                <p class="text-slate-500 text-sm mt-0.5">Kelola semua pengajuan Satyalancana ASN</p>
            </div>

            <div class="relative group w-full sm:w-auto">
                <input type="text" name="search" value="{{ request('search') }}"
                       placeholder="Cari Nama / NIP..."
                       class="w-full sm:w-64 pl-10 pr-4 py-2.5 bg-white border border-slate-200 rounded-xl text-sm focus:outline-none focus:ring-2 focus:ring-indigo-300 transition-all group-hover:border-indigo-300">
                <div class="absolute left-3.5 top-3 text-slate-400 group-hover:text-indigo-500 transition-colors">
                    <svg class="w-4 h-4" fill="none" viewBox="0 0 24 24" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M21 21l-6-6m2-5a7 7 0 11-14 0 7 7 0 0114 0z"/></svg>
                </div>
            </div>
        </div>

        <div class="bg-white p-4 rounded-2xl border border-slate-200 shadow-sm flex flex-wrap items-center gap-4">
            <div class="flex-1 min-w-[200px]">
                <label class="block text-[10px] font-bold text-slate-400 uppercase tracking-wider mb-1 px-1">OPD / Instansi</label>
                <select name="department" id="opd-filter" class="w-full bg-slate-50 border-none rounded-lg text-sm focus:ring-2 focus:ring-indigo-300 py-2 px-3">
                    <option value="">Semua OPD</option>
                    @foreach($departments as $dept)
                        <option value="{{ $dept->name }}" {{ request('department') == $dept->name ? 'selected' : '' }}>{{ $dept->name }}</option>
                    @endforeach
                </select>
            </div>

            <div class="w-full sm:w-48">
                <label class="block text-[10px] font-bold text-slate-400 uppercase tracking-wider mb-1 px-1">Jenis Pengajuan</label>
                <select name="type" onchange="this.form.submit()" class="w-full bg-slate-50 border-none rounded-lg text-sm focus:ring-2 focus:ring-indigo-300 py-2 px-3">
                    <option value="">Semua Jenis</option>
                    @foreach(['10 Tahun', '20 Tahun', '30 Tahun'] as $t)
                        <option value="{{ $t }}" {{ request('type') == $t ? 'selected' : '' }}>{{ $t }}</option>
                    @endforeach
                </select>
            </div>

            <div class="w-full sm:w-48">
                <label class="block text-[10px] font-bold text-slate-400 uppercase tracking-wider mb-1 px-1">Status</label>
                <select name="status" onchange="this.form.submit()" class="w-full bg-slate-50 border-none rounded-lg text-sm focus:ring-2 focus:ring-indigo-300 py-2 px-3">
                    <option value="">Semua Status</option>
                    @foreach([
                        'submitted' => 'Diterima',
                        'verification' => 'Verifikasi',
                        'processing' => 'Diproses',
                        'approved' => 'Disetujui',
                        'completed' => 'Selesai',
                        'rejected' => 'Ditolak'
                    ] as $val => $lbl)
                        <option value="{{ $val }}" {{ request('status') == $val ? 'selected' : '' }}>{{ $lbl }}</option>
                    @endforeach
                </select>
            </div>

            @if(request()->anyFilled(['search', 'department', 'type', 'status']))
            <div class="pt-5">
                <a href="{{ route('admin.submissions') }}" class="text-xs text-red-500 hover:text-red-700 font-bold flex items-center gap-1">
                    <svg class="w-3.5 h-3.5" fill="none" viewBox="0 0 24 24" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12"/></svg>
                    Reset
                </a>
            </div>
            @endif
        </div>
    </form>

    <div class="bg-white rounded-2xl border border-slate-200 shadow-sm overflow-hidden">
        <div class="overflow-x-auto">
            <table class="w-full text-sm">
                <thead class="bg-slate-50">
                    <tr>
                        <th class="text-left px-5 py-3 text-slate-500 font-semibold">ASN</th>
                        <th class="text-left px-5 py-3 text-slate-500 font-semibold">OPD</th>
                        <th class="text-left px-5 py-3 text-slate-500 font-semibold">Jenis</th>
                        <th class="text-left px-5 py-3 text-slate-500 font-semibold">Status</th>
                        <th class="text-left px-5 py-3 text-slate-500 font-semibold">Tanggal</th>
                        <th class="text-right px-5 py-3 text-slate-500 font-semibold">Aksi</th>
                    </tr>
                </thead>
                <tbody class="divide-y divide-slate-100">
                    @forelse($submissions as $sub)
                    @php
                        $badge = ['submitted'=>'bg-blue-100 text-blue-700','verification'=>'bg-amber-100 text-amber-700','processing'=>'bg-blue-100 text-blue-700','approved'=>'bg-lime-100 text-lime-700','completed'=>'bg-emerald-100 text-emerald-700','rejected'=>'bg-red-100 text-red-700'];
                        $label = ['submitted'=>'Diterima','verification'=>'Verifikasi','processing'=>'Diproses','approved'=>'Disetujui','completed'=>'Selesai','rejected'=>'Ditolak'];
                    @endphp
                    <tr class="hover:bg-slate-50 transition-colors">
                        <td class="px-5 py-3.5">
                            <div class="font-semibold text-slate-800">{{ $sub->name }}</div>
                            <div class="text-xs text-slate-400">{{ $sub->nip }}</div>
                        </td>
                        <td class="px-5 py-3.5 text-slate-600 text-sm">{{ $sub->department_name }}</td>
                        <td class="px-5 py-3.5 text-indigo-600 font-medium">{{ $sub->submission_type }}</td>
                        <td class="px-5 py-3.5">
                            <span class="inline-flex px-2.5 py-1 rounded-lg text-xs font-semibold {{ $badge[$sub->status] ?? '' }}">
                                {{ $label[$sub->status] ?? $sub->status }}
                            </span>
                        </td>
                        <td class="px-5 py-3.5 text-slate-400 text-xs">{{ $sub->created_at->format('d M Y') }}</td>
                        <td class="px-5 py-3.5 text-right">
                            <a href="{{ route('admin.submissions.show', $sub) }}" class="px-3 py-1.5 text-xs font-semibold rounded-lg bg-indigo-50 text-indigo-600 hover:bg-indigo-100 transition">Detail</a>
                        </td>
                    </tr>
                    @empty
                    <tr><td colspan="6" class="px-5 py-12 text-center text-slate-400">Belum ada pengajuan.</td></tr>
                    @endforelse
                </tbody>
            </table>
        </div>
        @if($submissions->hasPages())
        <div class="px-5 py-4 border-t border-slate-100">{{ $submissions->appends(request()->query())->links() }}</div>
        @endif
    </div>
</div>

<script>
    document.addEventListener('DOMContentLoaded', function() {
        if (typeof TomSelect !== 'undefined') {
            new TomSelect('#opd-filter', {
                create: false,
                sortField: {
                    field: "text",
                    direction: "asc"
                },
                placeholder: 'Cari OPD...',
                onChange: function() {
                    this.wrapper.closest('form').submit();
                }
            });
        }
    });
</script>
@endsection
