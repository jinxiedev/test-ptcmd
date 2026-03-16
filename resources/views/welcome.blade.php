@extends('layouts.app')

@section('content')
<div class="min-h-[70vh] flex flex-col justify-center items-center text-center relative mt-10">

    <div class="relative z-10 max-w-4xl px-4">
        <!-- Badge -->
        <div class="inline-flex items-center gap-2 px-4 py-2 rounded-full bg-white/60 backdrop-blur-md border border-white shadow-sm mb-8">
            <span class="w-2 h-2 rounded-full bg-yellow-400 animate-pulse"></span>
            <span class="text-xs font-bold text-slate-600 tracking-wider uppercase">Internal System &bull; v1.0</span>
        </div>

        <h1 class="text-5xl md:text-7xl font-extrabold text-slate-800 tracking-tight mb-8 leading-tight">
            Sistem Pengajuan <br> 
            <span class="text-transparent bg-clip-text bg-gradient-to-r from-yellow-400 to-yellow-600">Kredit Pintar</span>
        </h1>
        
        <p class="text-lg md:text-xl text-slate-500 mb-10 max-w-2xl mx-auto leading-relaxed">
            Kelola data pengajuan kredit nasabah dengan clean interface. Kalkulasi instan, tanpa dokumen berantakan. Dirancang secara eksklusif untuk staf <b class="text-slate-700">PT Capella Multidana</b>.
        </p>

        <div x-data="{ 
            openSimulasi: false, 
            nominal: 15000000, 
            tenor: 12, 
            get tagihan() { 
                return this.tenor > 0 ? (this.nominal / this.tenor) : 0; 
            },
            formatRupiah(number) {
                return new Intl.NumberFormat('id-ID', { style: 'currency', currency: 'IDR', minimumFractionDigits: 0, maximumFractionDigits: 0 }).format(number);
            }
        }" class="flex flex-col sm:flex-row gap-4 justify-center items-center">
            <a href="{{ route('pengajuan.index') }}" class="w-full sm:w-auto bg-slate-900 hover:bg-slate-800 text-white font-semibold py-4 px-10 rounded-full shadow-xl shadow-slate-900/20 transition transform hover:-translate-y-1 flex items-center justify-center gap-2">
                Masuk Dashboard
            </a>
            <button @click="openSimulasi = true" class="w-full sm:w-auto bg-white hover:bg-slate-50 text-slate-800 font-semibold py-4 px-10 rounded-full shadow-lg shadow-black/5 border border-slate-100 transition transform hover:-translate-y-1 flex items-center justify-center gap-2">
                Lihat Simulasi Kredit <span class="text-yellow-500 font-bold">&rarr;</span>
            </button>

            <!-- Kalkulator Modal -->
            <template x-teleport="body">
                <div x-show="openSimulasi" x-cloak class="fixed inset-0 z-[100] flex items-center justify-center p-4">
                    <div class="fixed inset-0 bg-slate-900/40 backdrop-blur-sm transition-opacity" @click="openSimulasi = false"></div>
                    <div class="relative bg-white/90 backdrop-blur-xl border border-white rounded-[2rem] max-w-lg w-full p-8 text-left shadow-2xl transform transition-all overflow-hidden" @click.stop>
                        <div class="absolute top-0 right-0 w-48 h-48 bg-yellow-200 rounded-full mix-blend-multiply filter blur-3xl opacity-50 translate-x-1/2 -translate-y-1/2 pointer-events-none"></div>

                        <div class="flex justify-between items-center mb-6 relative z-10">
                            <h3 class="text-2xl font-bold text-slate-800 flex items-center gap-3">
                                <span class="p-2.5 bg-yellow-100 text-yellow-600 rounded-2xl">
                                    <svg class="w-6 h-6" fill="none" viewBox="0 0 24 24" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 7h6m0 10v-3m-3 3h.01M9 17h.01M9 14h.01M12 14h.01M15 11h.01M12 11h.01M9 11h.01M7 21h10a2 2 0 002-2V5a2 2 0 00-2-2H7a2 2 0 00-2 2v14a2 2 0 002 2z" /></svg>
                                </span>
                                Kalkulator Kredit
                            </h3>
                            <button @click="openSimulasi = false" class="text-slate-400 hover:text-red-500 transition-colors p-2 bg-slate-100 hover:bg-red-50 rounded-full">
                                <svg class="w-5 h-5" fill="none" viewBox="0 0 24 24" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12" /></svg>
                            </button>
                        </div>
                        
                        <div class="space-y-6 relative z-10">
                            <!-- Input Nominal -->
                            <div class="space-y-2">
                                <label class="block text-sm font-semibold text-slate-600">Nominal Pinjaman</label>
                                <div class="relative group">
                                    <div class="absolute inset-y-0 left-0 pl-4 flex items-center pointer-events-none z-10">
                                        <span class="text-slate-600 font-bold group-focus-within:text-yellow-600 transition-colors">Rp</span>
                                    </div>
                                    <input type="number" x-model.number="nominal" max="200000000" min="0" step="500000"
                                           class="w-full pl-12 bg-white/70 backdrop-blur-sm rounded-2xl border border-slate-200 shadow-sm p-4 focus:ring-2 focus:ring-yellow-400 focus:border-transparent outline-none transition-all placeholder:text-slate-300 relative z-0 text-lg font-semibold">
                                </div>
                                <div class="flex justify-between text-xs text-slate-400 font-medium px-1">
                                    <span>Maks: 200 Juta</span>
                                    <span x-text="formatRupiah(nominal)"></span>
                                </div>
                            </div>

                            <!-- Input Tenor -->
                            <div class="space-y-2">
                                <label class="block text-sm font-semibold text-slate-600">Tenor (Durasi)</label>
                                <div class="flex items-center gap-4">
                                    <input type="range" x-model.number="tenor" min="1" max="24" step="1" class="w-full h-2 bg-slate-200 rounded-lg appearance-none cursor-pointer accent-yellow-500">
                                    <div class="bg-yellow-50 text-yellow-700 font-bold px-4 py-2 rounded-xl border border-yellow-200 min-w-[5rem] text-center">
                                        <span x-text="tenor"></span> Bln
                                    </div>
                                </div>
                            </div>

                            <!-- Hasil Kalkulasi -->
                            <div class="mt-8 bg-gradient-to-br from-slate-800 to-slate-900 rounded-3xl p-6 text-white shadow-xl shadow-slate-900/20 relative overflow-hidden border border-slate-700">
                                <div class="absolute top-0 right-0 w-32 h-32 bg-yellow-500 rounded-full mix-blend-screen filter blur-[40px] opacity-30 pointer-events-none translate-x-1/2 -translate-y-1/2"></div>
                                
                                <p class="text-slate-400 text-sm font-medium mb-1 relative z-10">Estimasi Tagihan / Bulan</p>
                                <div class="text-3xl font-extrabold text-white tracking-tight relative z-10">
                                    <span x-text="formatRupiah(tagihan)"></span>
                                </div>
                                <p class="text-xs text-slate-400 mt-3 relative z-10">* Hanya ilustrasi, tidak mengikat</p>
                            </div>

                            <button @click="openSimulasi = false; setTimeout(() => window.location.href='{{ route('pengajuan.index') }}', 200)" class="w-full mt-4 bg-yellow-400 hover:bg-yellow-500 text-slate-900 font-bold py-3.5 px-8 rounded-2xl shadow-lg shadow-yellow-200 transition transform hover:-translate-y-0.5 mt-2">
                                Buat Pengajuan Sekarang
                            </button>
                        </div>
                    </div>
                </div>
            </template>
        </div>
    </div>
    
    <!-- Decorative Glass Preview Card -->
    <div class="mt-20 relative w-full max-w-3xl mx-auto animate-fade-in-up">
        <!-- Floating shapes behind card -->
        <div class="absolute -top-10 -right-10 w-24 h-24 bg-yellow-400 rounded-full mix-blend-multiply filter blur-xl opacity-60"></div>
        <div class="absolute -bottom-10 -left-10 w-32 h-32 bg-yellow-200 rounded-full mix-blend-multiply filter blur-xl opacity-60"></div>
        
        <div class="relative bg-white/60 backdrop-blur-2xl border border-white shadow-[0_20px_50px_rgb(0,0,0,0.05)] rounded-[2.5rem] p-4 sm:p-6 overflow-hidden">
            <div class="absolute top-0 left-0 w-full h-1 bg-gradient-to-r from-yellow-300 via-yellow-400 to-yellow-500"></div>
            <div class="bg-white/80 rounded-[2rem] p-6 lg:p-8 border border-white flex flex-col gap-5">
                <div class="flex justify-between items-center pb-5 border-b border-slate-100 mb-2">
                    <div class="w-1/3 h-5 bg-slate-200 rounded-full"></div>
                    <div class="w-20 h-8 bg-yellow-100/80 rounded-full"></div>
                </div>
                <div class="w-full h-14 bg-slate-50 rounded-2xl flex items-center px-5"> 
                    <div class="w-1/4 h-3 bg-slate-200 rounded-full"></div> 
                </div>
                <div class="w-full h-14 bg-slate-50 rounded-2xl flex items-center px-5"> 
                    <div class="w-1/2 h-3 bg-slate-200 rounded-full"></div> 
                </div>
                <div class="w-2/3 h-14 bg-yellow-50 rounded-2xl flex items-center px-5 border border-yellow-100"> 
                    <div class="w-1/3 h-3 bg-yellow-400 rounded-full"></div> 
                </div>
            </div>
        </div>
    </div>
</div>

<style>
    @keyframes fadeInUp {
        from { opacity: 0; transform: translateY(20px); }
        to { opacity: 1; transform: translateY(0); }
    }
    .animate-fade-in-up {
        animation: fadeInUp 0.8s ease-out forwards;
    }
</style>
@endsection
