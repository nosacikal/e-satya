<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Login Admin | e-Satya</title>
    <meta name="csrf-token" content="{{ csrf_token() }}">
    @vite(['resources/css/app.css', 'resources/js/app.js'])
</head>
<body class="bg-gradient-to-br from-indigo-900 via-indigo-800 to-purple-900 min-h-screen flex items-center justify-center p-4">

    <div class="absolute inset-0 overflow-hidden pointer-events-none">
        <div class="absolute -top-40 -right-40 w-96 h-96 bg-indigo-500/20 rounded-full blur-3xl"></div>
        <div class="absolute -bottom-40 -left-40 w-96 h-96 bg-purple-500/20 rounded-full blur-3xl"></div>
    </div>

    <div class="relative w-full max-w-md">
        {{-- Logo --}}
        <div class="text-center mb-8">
            <div class="w-16 h-16 bg-gradient-to-br from-indigo-400 to-indigo-600 rounded-2xl flex items-center justify-center shadow-2xl mx-auto mb-4">
                <span class="text-white font-bold text-xl">eS</span>
            </div>
            <h1 class="text-2xl font-bold text-white">e-Satya Admin</h1>
            <p class="text-indigo-300 text-sm mt-1">BKPSDM Kabupaten Simalungun</p>
        </div>

        {{-- Login Card --}}
        <div class="bg-white dark:bg-slate-900 rounded-2xl shadow-2xl border border-white/10 p-8">
            <h2 class="text-xl font-bold text-slate-800 dark:text-white mb-1">Masuk ke Dashboard</h2>
            <p class="text-slate-500 dark:text-slate-400 text-sm mb-6">Silakan login untuk mengelola data pengajuan</p>

            @if($errors->any())
            <div class="mb-5 bg-red-50 dark:bg-red-900/20 border border-red-200 dark:border-red-800 rounded-xl p-3 flex items-center gap-2">
                <svg class="w-4 h-4 text-red-500 flex-shrink-0" fill="currentColor" viewBox="0 0 20 20"><path fill-rule="evenodd" d="M10 18a8 8 0 100-16 8 8 0 000 16zM8.707 7.293a1 1 0 00-1.414 1.414L8.586 10l-1.293 1.293a1 1 0 101.414 1.414L10 11.414l1.293 1.293a1 1 0 001.414-1.414L11.414 10l1.293-1.293a1 1 0 00-1.414-1.414L10 8.586 8.707 7.293z" clip-rule="evenodd"/></svg>
                <span class="text-sm text-red-600 dark:text-red-400">{{ $errors->first() }}</span>
            </div>
            @endif

            <form action="{{ route('login') }}" method="POST" class="space-y-4">
                @csrf
                <div>
                    <label class="block text-sm font-semibold text-slate-700 dark:text-slate-300 mb-2" for="email">Email</label>
                    <input type="email" name="email" id="email" value="{{ old('email') }}" autofocus required
                           placeholder="admin@esatya.com"
                           class="w-full px-4 py-3 rounded-xl border border-slate-200 dark:border-slate-700 bg-white dark:bg-slate-800 text-slate-800 dark:text-white text-base focus:outline-none focus:ring-2 focus:ring-indigo-300 dark:focus:ring-indigo-700 transition">
                </div>
                <div>
                    <label class="block text-sm font-semibold text-slate-700 dark:text-slate-300 mb-2" for="password">Password</label>
                    <input type="password" name="password" id="password" required
                           placeholder="••••••••"
                           class="w-full px-4 py-3 rounded-xl border border-slate-200 dark:border-slate-700 bg-white dark:bg-slate-800 text-slate-800 dark:text-white text-base focus:outline-none focus:ring-2 focus:ring-indigo-300 dark:focus:ring-indigo-700 transition">
                </div>
                <div class="flex items-center justify-between">
                    <label class="flex items-center gap-2 cursor-pointer">
                        <input type="checkbox" name="remember" class="w-4 h-4 rounded border-slate-300 text-indigo-600 focus:ring-indigo-500">
                        <span class="text-sm text-slate-600 dark:text-slate-400">Ingat saya</span>
                    </label>
                </div>
                <button type="submit" class="w-full bg-gradient-to-r from-indigo-600 to-purple-700 text-white font-bold py-3.5 px-6 rounded-xl text-base hover:from-indigo-700 hover:to-purple-800 transition-all duration-300 shadow-lg hover:shadow-indigo-500/30 hover:scale-[1.02]">
                    Masuk
                </button>
            </form>
        </div>

        <div class="text-center mt-6">
            <a href="{{ route('home') }}" class="text-indigo-300 hover:text-white text-sm font-medium transition-colors">← Kembali ke Beranda</a>
        </div>
    </div>
</body>
</html>
