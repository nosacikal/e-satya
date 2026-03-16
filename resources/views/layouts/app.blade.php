<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="description" content="e-Satya - Sistem Pengajuan Satyalancana Karya Satya BKPSDM Kabupaten Simalungun">
    <title>e-Satya - @yield('title', 'Sistem Pengajuan Satyalancana')</title>
    <meta name="csrf-token" content="{{ csrf_token() }}">
    @vite(['resources/css/app.css', 'resources/js/app.js'])
    <style>[x-cloak]{display:none!important}</style>
</head>
<body class="bg-slate-50 text-slate-900 min-h-screen">

    <!-- Navbar -->
    <nav class="sticky top-0 z-50 bg-white/90 backdrop-blur-md border-b border-slate-200 shadow-sm">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
            <div class="flex items-center justify-between h-16">
                <!-- Logo -->
                <a href="{{ route('home') }}" class="flex items-center gap-3 group">
                    <div class="w-10 h-10 bg-gradient-to-br from-indigo-500 to-indigo-700 rounded-xl flex items-center justify-center shadow-lg group-hover:shadow-indigo-200 transition-all duration-300">
                        <span class="text-white font-bold text-sm">eS</span>
                    </div>
                    <div>
                        <div class="font-bold text-lg text-indigo-700 leading-tight">e-Satya</div>
                        <div class="text-xs text-slate-500 leading-tight">BKPSDM Simalungun</div>
                    </div>
                </a>

                <!-- Desktop Nav -->
                <div class="hidden md:flex items-center gap-1">
                    <a href="{{ route('home') }}" class="px-3 py-2 rounded-lg text-[15px] font-medium transition-all duration-200 {{ request()->routeIs('home') ? 'bg-indigo-50 text-indigo-700' : 'text-slate-600 hover:bg-slate-100' }}">Home</a>
                    <a href="{{ route('submission') }}" class="px-3 py-2 rounded-lg text-[15px] font-medium transition-all duration-200 {{ request()->routeIs('submission*') ? 'bg-indigo-50 text-indigo-700' : 'text-slate-600 hover:bg-slate-100' }}">Pengajuan</a>
                    <a href="{{ route('tracking') }}" class="px-3 py-2 rounded-lg text-[15px] font-medium transition-all duration-200 {{ request()->routeIs('tracking*') ? 'bg-indigo-50 text-indigo-700' : 'text-slate-600 hover:bg-slate-100' }}">Tracking</a>
                 </div>

                <div class="flex items-center gap-3">
                    <!-- Mobile menu button -->
                    <div x-data="{ mobileOpen: false }" class="md:hidden">
                        <button @click="mobileOpen = !mobileOpen" class="p-2 rounded-lg text-slate-500 hover:bg-slate-100">
                            <svg class="w-5 h-5" fill="none" viewBox="0 0 24 24" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 6h16M4 12h16M4 18h16"/></svg>
                        </button>
                        <div x-show="mobileOpen" x-transition @click.outside="mobileOpen = false" class="absolute top-16 left-0 right-0 bg-white border-b border-slate-200 shadow-lg p-4 space-y-2">
                            <a href="{{ route('home') }}" class="block px-4 py-2 rounded-lg text-sm font-medium {{ request()->routeIs('home') ? 'bg-indigo-50 text-indigo-700' : 'text-slate-600' }}">Home</a>
                            <a href="{{ route('submission') }}" class="block px-4 py-2 rounded-lg text-sm font-medium {{ request()->routeIs('submission*') ? 'bg-indigo-50 text-indigo-700' : 'text-slate-600' }}">Pengajuan</a>
                            <a href="{{ route('tracking') }}" class="block px-4 py-2 rounded-lg text-sm font-medium {{ request()->routeIs('tracking*') ? 'bg-indigo-50 text-indigo-700' : 'text-slate-600' }}">Tracking</a>
                            <a href="{{ route('login') }}" class="block px-4 py-2 rounded-lg text-sm font-semibold bg-indigo-600 text-white">Login</a>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </nav>

    <!-- Flash Messages -->
    @if(session('success'))
    <div x-data="{ show: true }" x-show="show" x-init="setTimeout(() => show = false, 5000)" x-transition class="fixed top-20 right-4 z-50 bg-green-50 border border-green-200 text-green-800 px-5 py-3 rounded-xl shadow-lg flex items-center gap-3 max-w-sm">
        <svg class="w-5 h-5 text-green-500 flex-shrink-0" fill="currentColor" viewBox="0 0 20 20"><path fill-rule="evenodd" d="M10 18a8 8 0 100-16 8 8 0 000 16zm3.707-9.293a1 1 0 00-1.414-1.414L9 10.586 7.707 9.293a1 1 0 00-1.414 1.414l2 2a1 1 0 001.414 0l4-4z" clip-rule="evenodd"/></svg>
        <span class="text-sm font-medium">{{ session('success') }}</span>
        <button @click="show = false" class="ml-auto text-green-600 hover:text-green-800">
            <svg class="w-4 h-4" fill="none" viewBox="0 0 24 24" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12"/></svg>
        </button>
    </div>
    @endif

    <!-- Main Content -->
    <main>
        @yield('content')
    </main>

    <!-- Footer -->
    <footer class="bg-slate-900 dark:bg-slate-950 text-slate-400 py-10 mt-16">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 text-center">
            <div class="flex items-center justify-center gap-3 mb-3">
                <div class="w-8 h-8 bg-gradient-to-br from-indigo-500 to-indigo-700 rounded-lg flex items-center justify-center">
                    <span class="text-white font-bold text-xs">eS</span>
                </div>
                <span class="text-white font-semibold text-lg">e-Satya</span>
            </div>
            <p class="text-sm">Sistem Pengajuan Satyalancana Karya Satya</p>
            <p class="text-sm mt-1">BKPSDM Kabupaten Simalungun &copy; {{ date('Y') }}</p>
        </div>
    </footer>
</body>
</html>
