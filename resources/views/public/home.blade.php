@extends('layouts.app')

@section('title', 'Beranda')

@section('content')

{{-- Hero Section --}}
<section class="relative min-h-screen flex items-center overflow-hidden bg-gradient-to-br from-indigo-900 via-indigo-800 to-purple-900">
    {{-- Background decoration --}}
    <div class="absolute inset-0 overflow-hidden pointer-events-none">
        <div class="absolute -top-40 -right-40 w-96 h-96 bg-indigo-500/20 rounded-full blur-3xl"></div>
        <div class="absolute -bottom-40 -left-40 w-96 h-96 bg-purple-500/20 rounded-full blur-3xl"></div>
        <div class="absolute top-1/2 left-1/2 -translate-x-1/2 -translate-y-1/2 w-[600px] h-[600px] bg-white/5 rounded-full blur-3xl"></div>
    </div>

    <div class="relative max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 py-20">
        <div class="grid lg:grid-cols-2 gap-16 items-center">
            {{-- Left Content --}}
            <div class="opacity-0 animate-fade-in-up" style="animation-fill-mode:forwards;">
                <div class="inline-flex items-center gap-2 bg-indigo-500/20 border border-indigo-400/30 rounded-full px-4 py-2 mb-6">
                    <div class="w-2 h-2 bg-green-400 rounded-full animate-pulse"></div>
                    <span class="text-indigo-200 text-sm font-medium">Sistem Resmi BKPSDM Simalungun</span>
                </div>
                <h1 class="text-4xl sm:text-5xl lg:text-5xl font-bold text-white leading-tight mb-6">
                    Sistem Pengajuan<br>
                    <span class="text-transparent bg-clip-text bg-gradient-to-r from-indigo-300 to-purple-300">Satyalancana</span><br>
                    Karya Satya
                </h1>
                <p class="text-indigo-200 text-lg sm:text-xl leading-relaxed mb-10 max-w-lg">
                    Platform digital untuk mempermudah ASN dalam pengajuan dan pelacakan Satyalancana Karya Satya secara online.
                </p>
                <div class="flex flex-col sm:flex-row gap-4">
                    <a href="{{ route('submission') }}" id="btn-ajukan" class="inline-flex items-center justify-center gap-2 bg-white text-indigo-700 font-semibold px-7 py-4 rounded-xl text-lg shadow-xl hover:shadow-indigo-900/40 hover:scale-105 transition-all duration-300">
                        <svg class="w-5 h-5" fill="none" viewBox="0 0 24 24" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 4v16m8-8H4"/></svg>
                        Ajukan Satyalancana
                    </a>
                    <a href="{{ route('tracking') }}" id="btn-lacak" class="inline-flex items-center justify-center gap-2 bg-indigo-500/20 border border-indigo-400/40 text-white font-semibold px-7 py-4 rounded-xl text-lg hover:bg-indigo-500/30 transition-all duration-300">
                        <svg class="w-5 h-5" fill="none" viewBox="0 0 24 24" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5H7a2 2 0 00-2 2v12a2 2 0 002 2h10a2 2 0 002-2V7a2 2 0 00-2-2h-2M9 5a2 2 0 002 2h2a2 2 0 002-2M9 5a2 2 0 012-2h2a2 2 0 012 2"/></svg>
                        Lacak Pengajuan
                    </a>
                </div>
            </div>

            {{-- Right Illustration --}}
            <div class="hidden lg:flex justify-center items-center animate-float">
                <div class="relative">
                    <div class="w-72 h-72 bg-gradient-to-br from-indigo-400/30 to-purple-400/30 rounded-3xl border border-white/10 backdrop-blur-sm flex items-center justify-center shadow-2xl">
                        <div class="text-center p-8">
                            <div class="text-8xl mb-4">🏅</div>
                            <div class="text-white font-bold text-xl mb-1">Satyalancana</div>
                            <div class="text-indigo-300 text-sm">Karya Satya</div>
                            <div class="mt-4 grid grid-cols-3 gap-2">
                                <div class="bg-indigo-500/30 rounded-lg p-2 text-center"><div class="text-yellow-300 font-bold text-sm">10</div><div class="text-indigo-300 text-xs">Tahun</div></div>
                                <div class="bg-indigo-500/30 rounded-lg p-2 text-center"><div class="text-yellow-300 font-bold text-sm">20</div><div class="text-indigo-300 text-xs">Tahun</div></div>
                                <div class="bg-indigo-500/30 rounded-lg p-2 text-center"><div class="text-yellow-300 font-bold text-sm">30</div><div class="text-indigo-300 text-xs">Tahun</div></div>
                            </div>
                        </div>
                    </div>
                    {{-- Floating badges --}}
                    <div class="absolute -top-4 -right-4 bg-green-400 text-green-900 text-xs font-bold px-3 py-1.5 rounded-full shadow-lg animate-bounce">Online ✓</div>
                    <div class="absolute -bottom-4 -left-4 bg-white text-indigo-700 text-xs font-bold px-3 py-1.5 rounded-full shadow-lg">Dokumen Digital 📄</div>
                </div>
            </div>
        </div>
    </div>
</section>

{{-- Alur Pengajuan --}}
<section class="py-20 bg-white dark:bg-slate-900">
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
        <div class="text-center mb-14">
            <h2 class="text-3xl sm:text-4xl font-bold text-slate-900 dark:text-white mb-4">Alur Pengajuan</h2>
            <p class="text-slate-500 dark:text-slate-400 text-lg max-w-xl mx-auto">Proses pengajuan Satyalancana Karya Satya dilakukan dalam 5 tahap sederhana</p>
        </div>

        <div class="relative">
            <div class="hidden md:block absolute top-8 left-1/2 -translate-x-1/2 w-4/5 h-0.5 bg-gradient-to-r from-transparent via-indigo-300 to-transparent dark:via-indigo-800"></div>
            <div class="grid grid-cols-1 md:grid-cols-5 gap-6">
                @foreach([
                    ['no'=>1,'icon'=>'📝','title'=>'Isi Form','desc'=>'Lengkapi form pengajuan dengan data ASN'],
                    ['no'=>2,'icon'=>'📁','title'=>'Upload Dokumen','desc'=>'Unggah DRH, SK CPNS, dan SK PNS'],
                    ['no'=>3,'icon'=>'🔍','title'=>'Verifikasi BKPSDM','desc'=>'Dokumen diverifikasi oleh petugas'],
                    ['no'=>4,'icon'=>'⚙️','title'=>'Proses Usulan','desc'=>'Usulan diproses ke instansi terkait'],
                    ['no'=>5,'icon'=>'🎖️','title'=>'Selesai','desc'=>'Satyalancana siap diserahkan'],
                ] as $i => $step)
                <div class="flex flex-col items-center text-center group opacity-0 animate-fade-in-up" style="animation-delay:{{ $i * 0.1 }}s; animation-fill-mode:forwards;">
                    <div class="relative z-10 w-16 h-16 bg-gradient-to-br from-indigo-500 to-indigo-700 rounded-2xl flex items-center justify-center text-2xl shadow-lg group-hover:scale-110 transition-transform duration-300 mb-4">
                        {{ $step['icon'] }}
                        <div class="absolute -top-2 -right-2 w-6 h-6 bg-indigo-900 dark:bg-indigo-200 text-white dark:text-indigo-900 text-xs font-bold rounded-full flex items-center justify-center shadow">{{ $step['no'] }}</div>
                    </div>
                    <h3 class="font-bold text-slate-800 dark:text-white text-base mb-1">{{ $step['title'] }}</h3>
                    <p class="text-slate-500 dark:text-slate-400 text-sm leading-snug">{{ $step['desc'] }}</p>
                </div>
                @endforeach
            </div>
        </div>
    </div>
</section>

{{-- Fitur --}}
<section class="py-20 bg-slate-50 dark:bg-slate-800">
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
        <div class="text-center mb-14">
            <h2 class="text-3xl sm:text-4xl font-bold text-slate-900 dark:text-white mb-4">Fitur Utama</h2>
            <p class="text-slate-500 dark:text-slate-400 text-lg">Solusi digital lengkap untuk pengajuan Satyalancana</p>
        </div>
        <div class="grid md:grid-cols-3 gap-8">
            @foreach([
                ['icon'=>'🖥️','color'=>'from-blue-500 to-indigo-600','title'=>'Pengajuan Online','desc'=>'Ajukan Satyalancana kapan saja dan di mana saja tanpa harus datang ke kantor. Cukup isi formulir secara digital.'],
                ['icon'=>'📊','color'=>'from-indigo-500 to-purple-600','title'=>'Tracking Pengajuan','desc'=>'Pantau status pengajuan Anda secara real-time dengan memasukkan NIP. Transparansi penuh untuk setiap ASN.'],
                ['icon'=>'📄','color'=>'from-purple-500 to-pink-600','title'=>'Dokumen Digital','desc'=>'Unggah dokumen persyaratan secara digital. Tidak perlu fotokopi berlembar-lembar. Aman dan tersimpan dalam sistem.'],
            ] as $i => $feature)
            <div class="bg-white dark:bg-slate-900 rounded-2xl p-7 shadow-md hover:shadow-xl transition-all duration-300 hover:-translate-y-1 border border-slate-100 dark:border-slate-800 group opacity-0 animate-fade-in-up" style="animation-delay:{{ $i * 0.15 }}s; animation-fill-mode:forwards;">
                <div class="w-14 h-14 bg-gradient-to-br {{ $feature['color'] }} rounded-2xl flex items-center justify-center text-2xl mb-5 shadow-lg group-hover:scale-110 transition-transform duration-300">{{ $feature['icon'] }}</div>
                <h3 class="text-xl font-bold text-slate-900 dark:text-white mb-3">{{ $feature['title'] }}</h3>
                <p class="text-slate-500 dark:text-slate-400 text-base leading-relaxed">{{ $feature['desc'] }}</p>
            </div>
            @endforeach
        </div>
    </div>
</section>

{{-- FAQ --}}
<section class="py-20 bg-white dark:bg-slate-900" id="faq">
    <div class="max-w-3xl mx-auto px-4 sm:px-6 lg:px-8">
        <div class="text-center mb-14">
            <h2 class="text-3xl sm:text-4xl font-bold text-slate-900 dark:text-white mb-4">Pertanyaan Umum</h2>
            <p class="text-slate-500 dark:text-slate-400 text-lg">Informasi yang sering ditanyakan seputar pengajuan Satyalancana</p>
        </div>
        <div class="space-y-3" x-data="{ active: null }">
            @foreach([
                ['q'=>'Apa itu Satyalancana Karya Satya?','a'=>'Satyalancana Karya Satya adalah tanda penghargaan yang diberikan kepada Pegawai Negeri Sipil yang telah menunjukkan kesetiaan, pengabdian, kecakapan, kejujuran, dan kedisiplinan dalam tugasnya selama 10, 20, atau 30 tahun.'],
                ['q'=>'Siapa yang berhak mengajukan?','a'=>'ASN yang telah mengabdi selama minimal 10 tahun sebagai PNS aktif dapat mengajukan Satyalancana 10 Tahun. Untuk 20 tahun dan 30 tahun, disesuaikan dengan masa pengabdian yang sudah dicapai.'],
                ['q'=>'Dokumen apa saja yang dibutuhkan?','a'=>'Dokumen yang diperlukan adalah: (1) Daftar Riwayat Hidup (DRH), (2) SK CPNS, dan (3) SK PNS. Semua dokumen diunggah dalam format PDF dengan ukuran maksimal 1MB per file.'],
                ['q'=>'Berapa lama proses pengajuan?','a'=>'Proses pengajuan berlangsung sesuai dengan jadwal yang ditetapkan oleh BKPSDM. Anda dapat memantau perkembangan pengajuan secara real-time melalui halaman Tracking dengan menggunakan NIP Anda.'],
                ['q'=>'Bagaimana cara melacak status pengajuan?','a'=>'Kunjungi halaman Tracking, masukkan NIP Anda, dan sistem akan menampilkan status terkini pengajuan beserta tahapan yang sudah dilalui.'],
            ] as $i => $faq)
            <div x-data="{ open: false }" class="border border-slate-200 dark:border-slate-700 rounded-xl overflow-hidden">
                <button @click="open = !open" class="w-full flex items-center justify-between px-5 py-4 text-left bg-white dark:bg-slate-900 hover:bg-slate-50 dark:hover:bg-slate-800 transition-colors duration-200">
                    <span class="font-semibold text-slate-800 dark:text-white text-base pr-4">{{ $faq['q'] }}</span>
                    <svg :class="{'rotate-180': open}" class="w-5 h-5 text-indigo-500 flex-shrink-0 transition-transform duration-300" fill="none" viewBox="0 0 24 24" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 9l-7 7-7-7"/></svg>
                </button>
                <div x-show="open" x-collapse class="px-5 pb-4 bg-slate-50 dark:bg-slate-800/50">
                    <p class="text-slate-600 dark:text-slate-400 text-base leading-relaxed pt-2">{{ $faq['a'] }}</p>
                </div>
            </div>
            @endforeach
        </div>
    </div>
</section>

{{-- CTA --}}
<section class="py-16 bg-gradient-to-r from-indigo-600 to-purple-700">
    <div class="max-w-4xl mx-auto px-4 sm:px-6 lg:px-8 text-center">
        <h2 class="text-3xl sm:text-4xl font-bold text-white mb-4">Siap Mengajukan Satyalancana?</h2>
        <p class="text-indigo-200 text-lg mb-8">Proses mudah, cepat, dan transparan. Ajukan sekarang!</p>
        <div class="flex flex-col sm:flex-row gap-4 justify-center">
            <a href="{{ route('submission') }}" class="inline-flex items-center justify-center gap-2 bg-white text-indigo-700 font-bold px-8 py-4 rounded-xl text-lg shadow-xl hover:shadow-indigo-900/40 hover:scale-105 transition-all duration-300">
                Ajukan Sekarang
            </a>
            <a href="{{ route('tracking') }}" class="inline-flex items-center justify-center gap-2 border-2 border-white/40 text-white font-semibold px-8 py-4 rounded-xl text-lg hover:bg-white/10 transition-all duration-300">
                Lacak Pengajuan
            </a>
        </div>
    </div>
</section>

@endsection
