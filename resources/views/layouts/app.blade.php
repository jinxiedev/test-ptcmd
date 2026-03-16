<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Sistem Pengajuan Capella</title>
    <!-- Alpine JS -->
    <script defer src="https://cdn.jsdelivr.net/npm/alpinejs@3.x.x/dist/cdn.min.js"></script>
    <!-- Tailwind CSS -->
    <script src="https://cdn.tailwindcss.com"></script>
    <style>
        [x-cloak] { display: none !important; }
        body { background-color: #fafbfb; } /* Soft warm white background */
        html { scroll-behavior: smooth; }
    </style>
</head>
<body class="font-sans antialiased text-gray-800 relative min-h-screen">
    
    <!-- Abstract Background Decor -->
    <div class="fixed inset-0 pointer-events-none -z-10 overflow-hidden">
        <div class="absolute -top-[10%] -left-[10%] w-[40%] h-[40%] bg-yellow-300 rounded-full mix-blend-multiply filter blur-[120px] opacity-20"></div>
        <div class="absolute top-[20%] right-[5%] w-[30%] h-[30%] bg-yellow-100 rounded-full mix-blend-multiply filter blur-[100px] opacity-40"></div>
    </div>

    <!-- Floating Glassmorphism Navbar -->
    <div class="fixed top-0 inset-x-0 z-50 p-4 sm:p-6 transition-all" x-data="{ atTop: true }" @scroll.window="atTop = (window.pageYOffset > 50 ? false : true)">
        <nav class="max-w-6xl mx-auto bg-white/70 backdrop-blur-xl border border-white/60 shadow-[0_8px_30px_rgb(0,0,0,0.04)] rounded-full px-6 py-3 flex justify-between items-center transition-all duration-300">
            <a href="{{ route('landing') }}" class="flex items-center gap-3 relative z-50">
                <div class="w-10 h-10 rounded-full bg-gradient-to-br from-yellow-300 to-yellow-500 shadow-md flex items-center justify-center text-white font-black text-xl">C</div>
                <span class="text-slate-800 text-xl font-extrabold tracking-tight">Capella<span class="text-yellow-500">.</span></span>
            </a>
            <div class="flex gap-6 items-center relative z-50">
                <!-- Anchor links so user goes directly to form/table instead of full index refresh -->
                @if(request()->routeIs('landing'))
                    <a href="{{ route('pengajuan.index') }}" class="hidden sm:block text-sm font-semibold text-slate-500 hover:text-slate-800 transition">Dashboard Pengajuan</a>
                    <a href="{{ route('pengajuan.index') }}" class="bg-yellow-400 hover:bg-yellow-500 text-slate-900 text-sm font-bold py-2.5 px-6 rounded-full shadow-lg shadow-yellow-400/30 transition transform hover:-translate-y-0.5">
                        Internal App &rarr;
                    </a>
                @elseif(request()->routeIs('pengajuan.index'))
                    <a href="#tabel-pengajuan" class="hidden sm:block text-sm font-semibold text-slate-500 hover:text-slate-800 transition">Lihat Data</a>
                    <a href="#form-pengajuan" class="bg-yellow-400 hover:bg-yellow-500 text-slate-900 text-sm font-bold py-2.5 px-6 rounded-full shadow-lg shadow-yellow-400/30 transition transform hover:-translate-y-0.5">
                        + Buat Pengajuan Baru
                    </a>
                @else
                    <a href="{{ route('pengajuan.index') }}" class="hidden sm:block text-sm font-semibold text-slate-500 hover:text-slate-800 transition">Kembali ke Dashboard</a>
                @endif
            </div>
        </nav>
    </div>

    <!-- Main Content Area -->
    <main class="max-w-6xl mx-auto pt-32 pb-12 px-4 sm:px-6 lg:px-8 relative z-10">
        @yield('content')
    </main>
</body>
</html>
