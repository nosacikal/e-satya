@extends('layouts.admin')

@section('title', 'Dashboard')

@section('content')
<div class="space-y-6">

    {{-- Stat Cards --}}
    <div class="grid grid-cols-1 sm:grid-cols-2 xl:grid-cols-4 gap-5">
        @foreach([
            ['label'=>'Total Pengajuan','value'=>$totalSubmissions,'icon'=>'📋','from'=>'from-blue-500','to'=>'to-indigo-600'],
            ['label'=>'Sedang Diproses','value'=>$processing,'icon'=>'⚙️','from'=>'from-amber-500','to'=>'to-orange-600'],
            ['label'=>'Disetujui','value'=>$approved,'icon'=>'✅','from'=>'from-green-500','to'=>'to-emerald-600'],
            ['label'=>'Selesai','value'=>$completed,'icon'=>'🎖️','from'=>'from-purple-500','to'=>'to-indigo-600'],
        ] as $stat)
        <div class="bg-gradient-to-br {{ $stat['from'] }} {{ $stat['to'] }} rounded-2xl p-5 shadow-lg hover:shadow-xl hover:-translate-y-0.5 transition-all duration-300">
            <div class="flex items-center justify-between mb-3">
                <span class="text-white/80 text-sm font-medium">{{ $stat['label'] }}</span>
                <span class="text-2xl">{{ $stat['icon'] }}</span>
            </div>
            <div class="text-3xl font-bold text-white">{{ $stat['value'] }}</div>
        </div>
        @endforeach
    </div>

    {{-- Recent Submissions --}}
    <div class="bg-white rounded-2xl border border-slate-200 shadow-sm overflow-hidden">
        <div class="px-6 py-4 border-b border-slate-100 flex items-center justify-between">
            <h2 class="font-bold text-slate-800 text-base">Pengajuan Terbaru</h2>
            <a href="{{ route('admin.submissions') }}" class="text-sm text-indigo-600 font-medium hover:underline">Lihat semua →</a>
        </div>
        <div class="overflow-x-auto">
            <table class="w-full text-sm">
                <thead class="bg-slate-50">
                    <tr>
                        <th class="text-left px-5 py-3 text-slate-500 font-semibold">ASN</th>
                        <th class="text-left px-5 py-3 text-slate-500 font-semibold">OPD</th>
                        <th class="text-left px-5 py-3 text-slate-500 font-semibold">Jenis</th>
                        <th class="text-left px-5 py-3 text-slate-500 font-semibold">Status</th>
                        <th class="text-left px-5 py-3 text-slate-500 font-semibold">Tanggal</th>
                    </tr>
                </thead>
                <tbody class="divide-y divide-slate-100">
                    @forelse($recentSubmissions as $sub)
                    <tr class="hover:bg-slate-50 transition-colors">
                        <td class="px-5 py-3.5">
                            <div class="font-semibold text-slate-800">{{ $sub->name }}</div>
                            <div class="text-xs text-slate-400">{{ $sub->nip }}</div>
                        </td>
                        <td class="px-5 py-3.5 text-slate-600">{{ $sub->department_name }}</td>
                        <td class="px-5 py-3.5">
                            <span class="text-indigo-600 font-medium">{{ $sub->submission_type }}</span>
                        </td>
                        <td class="px-5 py-3.5">
                            @php
                                $statusBadge = [
                                    'submitted'    => 'bg-blue-100 text-blue-700',
                                    'verification' => 'bg-amber-100 text-amber-700',
                                    'processing'   => 'bg-orange-100 text-orange-700',
                                    'approved'     => 'bg-green-100 text-green-700',
                                    'completed'    => 'bg-emerald-100 text-emerald-700',
                                ];
                                $statusLabel = [
                                    'submitted' => 'Diterima', 'verification' => 'Verifikasi',
                                    'processing' => 'Diproses', 'approved' => 'Disetujui', 'completed' => 'Selesai'
                                ];
                            @endphp
                            <span class="inline-flex px-2.5 py-1 rounded-lg text-xs font-semibold {{ $statusBadge[$sub->status] ?? '' }}">
                                {{ $statusLabel[$sub->status] ?? $sub->status }}
                            </span>
                        </td>
                        <td class="px-5 py-3.5 text-slate-500 text-xs">{{ $sub->created_at->format('d M Y') }}</td>
                    </tr>
                    @empty
                    <tr><td colspan="5" class="px-5 py-10 text-center text-slate-400">Belum ada pengajuan.</td></tr>
                    @endforelse
                </tbody>
            </table>
        </div>
    </div>
</div>
@endsection
