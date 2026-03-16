@extends('layouts.admin')
@section('title', 'Data OPD')
@section('content')
<div class="space-y-6" x-data="{ modalOpen: false, editId: null, editName: '' }">

    {{-- Header & Search --}}
    <div class="flex flex-col sm:flex-row sm:items-center justify-between gap-4">
        <div>
            <h2 class="font-bold text-slate-800 text-xl">Manajemen OPD</h2>
            <p class="text-slate-500 text-sm mt-0.5">Kelola data Organisasi Perangkat Daerah</p>
        </div>

        <div class="flex flex-col sm:flex-row items-center gap-3 w-full sm:w-auto">
            <form action="{{ route('admin.departments') }}" method="GET" class="w-full sm:w-auto">
                <div class="relative group">
                    <input type="text" name="search" value="{{ request('search') }}"
                           placeholder="Cari OPD..."
                           class="w-full sm:w-64 pl-10 pr-4 py-2 bg-white border border-slate-200 rounded-xl text-sm focus:outline-none focus:ring-2 focus:ring-indigo-300 transition-all group-hover:border-indigo-300">
                    <div class="absolute left-3.5 top-2.5 text-slate-400 group-hover:text-indigo-500 transition-colors">
                        <svg class="w-4 h-4" fill="none" viewBox="0 0 24 24" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M21 21l-6-6m2-5a7 7 0 11-14 0 7 7 0 0114 0z"/></svg>
                    </div>
                </div>
            </form>

            <button @click="modalOpen = true; editId = null; editName = ''"
                    class="w-full sm:w-auto flex items-center justify-center gap-2 bg-indigo-600 hover:bg-indigo-700 text-white font-semibold px-5 py-2 rounded-xl text-sm transition-all shadow-lg hover:shadow-indigo-300/40">
                <svg class="w-4 h-4" fill="none" viewBox="0 0 24 24" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 4v16m8-8H4"/></svg>
                Tambah
            </button>
        </div>
    </div>

    {{-- Table --}}
    <div class="bg-white rounded-2xl border border-slate-200 shadow-sm overflow-hidden">
        <div class="overflow-x-auto">
            <table class="w-full text-sm">
                <thead class="bg-slate-50">
                    <tr>
                        <th class="text-left px-5 py-3 text-slate-500 font-semibold w-12">#</th>
                        <th class="text-left px-5 py-3 text-slate-500 font-semibold">Nama OPD</th>
                        <th class="text-right px-5 py-3 text-slate-500 font-semibold">Aksi</th>
                    </tr>
                </thead>
                <tbody class="divide-y divide-slate-100">
                    @forelse($departments as $dept)
                    <tr class="hover:bg-slate-50 transition-colors">
                        <td class="px-5 py-4 text-slate-500">
                            {{ ($departments->currentPage() - 1) * $departments->perPage() + $loop->iteration }}
                        </td>
                        <td class="px-5 py-4 font-semibold text-slate-800">{{ $dept->name }}</td>
                        <td class="px-5 py-4">
                            <div class="flex items-center justify-end gap-2">
                                <button @click="modalOpen = true; editId = {{ $dept->id }}; editName = '{{ addslashes($dept->name) }}'"
                                        class="px-3 py-1.5 text-xs font-semibold rounded-lg bg-amber-50 text-amber-600 hover:bg-amber-100 transition">Edit</button>
                                <form action="{{ route('admin.departments.destroy', $dept) }}" method="POST"
                                      onsubmit="return confirm('Yakin ingin menghapus OPD ini?')">
                                    @csrf @method('DELETE')
                                    <button type="submit" class="px-3 py-1.5 text-xs font-semibold rounded-lg bg-red-50 text-red-600 hover:bg-red-100 transition">Hapus</button>
                                </form>
                            </div>
                        </td>
                    </tr>
                    @empty
                    <tr><td colspan="3" class="px-5 py-12 text-center text-slate-400">Belum ada data OPD yang sesuai.</td></tr>
                    @endforelse
                </tbody>
            </table>
        </div>
        @if($departments->hasPages())
        <div class="px-5 py-4 border-t border-slate-100">{{ $departments->appends(request()->query())->links() }}</div>
        @endif
    </div>

    {{-- Modal --}}
    <div x-show="modalOpen" x-transition.opacity class="fixed inset-0 z-50 flex items-center justify-center bg-black/50 p-4">
        <div @click.outside="modalOpen = false" x-transition class="bg-white rounded-2xl shadow-2xl w-full max-w-md border border-slate-200">
            <div class="p-6">
                <h3 class="font-bold text-lg text-slate-800 mb-4" x-text="editId ? 'Edit OPD' : 'Tambah OPD'"></h3>

                {{-- Add --}}
                <template x-if="!editId">
                    <form action="{{ route('admin.departments.store') }}" method="POST">
                        @csrf
                        <input type="text" name="name" placeholder="Nama OPD..." autofocus required
                               class="w-full px-4 py-3 rounded-xl border border-slate-200 bg-white text-slate-800 text-base focus:outline-none focus:ring-2 focus:ring-indigo-300 transition mb-4">
                        <div class="flex gap-3">
                            <button type="submit" class="flex-1 bg-indigo-600 text-white font-semibold py-3 rounded-xl hover:bg-indigo-700 transition">Simpan</button>
                            <button type="button" @click="modalOpen = false" class="flex-1 bg-slate-100 text-slate-700 font-semibold py-3 rounded-xl hover:bg-slate-200 transition">Batal</button>
                        </div>
                    </form>
                </template>

                {{-- Edit --}}
                <template x-if="editId">
                    <form :action="`/admin/departments/${editId}`" method="POST">
                        @csrf @method('PATCH')
                        <input type="text" name="name" x-model="editName" required
                               class="w-full px-4 py-3 rounded-xl border border-slate-200 bg-white text-slate-800 text-base focus:outline-none focus:ring-2 focus:ring-indigo-300 transition mb-4">
                        <div class="flex gap-3">
                            <button type="submit" class="flex-1 bg-amber-500 text-white font-semibold py-3 rounded-xl hover:bg-amber-600 transition">Update</button>
                            <button type="button" @click="modalOpen = false" class="flex-1 bg-slate-100 text-slate-700 font-semibold py-3 rounded-xl hover:bg-slate-200 transition">Batal</button>
                        </div>
                    </form>
                </template>
            </div>
        </div>
    </div>
</div>
@endsection
