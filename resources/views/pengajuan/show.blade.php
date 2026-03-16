@extends('layouts.app')

@section('content')
<div class="max-w-4xl mx-auto animate-fade-in pb-10">
    
    <div class="mb-8 flex justify-between items-center bg-white/60 backdrop-blur-xl border border-white/80 p-4 rounded-full shadow-[0_4px_20px_rgb(0,0,0,0.03)]">
        <h1 class="text-xl font-bold text-slate-800 ml-4 flex items-center gap-2">
            <div class="w-8 h-8 rounded-full bg-yellow-400 text-white flex items-center justify-center">
                <svg class="w-4 h-4" fill="none" viewBox="0 0 24 24" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M13 16h-1v-4h-1m1-4h.01M21 12a9 9 0 11-18 0 9 9 0 0118 0z" /></svg>
            </div>
            Detail Pengajuan
        </h1>
        <div class="flex items-center gap-2">
            <a href="{{ route('pengajuan.edit', $pengajuan->id) }}" class="text-yellow-600 hover:text-yellow-700 bg-yellow-50 border border-yellow-200 hover:bg-yellow-100 font-semibold px-4 py-2 rounded-full transition shadow-sm flex items-center gap-2">
                <svg class="w-4 h-4 hidden sm:block" fill="none" viewBox="0 0 24 24" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M11 5H6a2 2 0 00-2 2v11a2 2 0 002 2h11a2 2 0 002-2v-5m-1.414-9.414a2 2 0 112.828 2.828L11.828 15H9v-2.828l8.586-8.586z" /></svg>
                <span class="hidden sm:block">Edit</span>
                <span class="sm:hidden">✏️</span>
            </a>
            
            <form action="{{ route('pengajuan.destroy', $pengajuan->id) }}" method="POST" class="inline m-0" onsubmit="return confirm('Apakah Anda yakin ingin menghapus data pengajuan ini secara permanen?');">
                @csrf @method('DELETE')
                <button type="submit" class="text-red-600 hover:text-red-700 bg-red-50 border border-red-200 hover:bg-red-100 font-semibold px-4 py-2 rounded-full transition shadow-sm flex items-center gap-2">
                    <svg class="w-4 h-4 hidden sm:block" fill="none" viewBox="0 0 24 24" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 7l-.867 12.142A2 2 0 0116.138 21H7.862a2 2 0 01-1.995-1.858L5 7m5 4v6m4-6v6m1-10V4a1 1 0 00-1-1h-4a1 1 0 00-1 1v3M4 7h16" /></svg>
                    <span class="hidden sm:block">Hapus</span>
                    <span class="sm:hidden">🗑️</span>
                </button>
            </form>

            <a href="{{ route('pengajuan.index') }}" class="text-slate-600 hover:text-slate-900 bg-white border border-slate-200 hover:bg-slate-50 font-semibold px-5 py-2 rounded-full transition shadow-sm flex items-center gap-2">
                <svg class="w-4 h-4 hidden sm:block" fill="none" viewBox="0 0 24 24" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M10 19l-7-7m0 0l7-7m-7 7h18" /></svg>
                <span class="hidden sm:block">Kembali</span>
                <span class="sm:hidden">🔙</span>
            </a>
        </div>
    </div>

    @if(session('success'))
        <div class="bg-green-50 backdrop-blur-md border border-green-200 text-green-700 font-medium p-4 rounded-2xl shadow-sm flex items-center gap-3 mb-8" role="alert">
            <svg class="w-5 h-5 text-green-500" fill="none" viewBox="0 0 24 24" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12l2 2 4-4m6 2a9 9 0 11-18 0 9 9 0 0118 0z" /></svg>
            {{ session('success') }}
        </div>
    @endif

    <!-- Informasi Detail -->
    <div class="bg-white/80 backdrop-blur-2xl rounded-[2rem] shadow-[0_10px_40px_rgb(0,0,0,0.04)] border border-white overflow-hidden relative">
        <div class="absolute top-0 right-0 w-64 h-64 bg-yellow-200 rounded-full mix-blend-multiply filter blur-3xl opacity-30 translate-x-1/3 -translate-y-1/3 z-0"></div>

        <div class="p-8 border-b border-slate-100/50 bg-white/40 flex flex-col sm:flex-row justify-between items-start sm:items-center gap-4 relative z-10">
            <div>
                <p class="text-sm font-semibold text-slate-400 mb-1 flex items-center gap-2">
                    <svg class="w-4 h-4" fill="none" viewBox="0 0 24 24" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M8 7V3m8 4V3m-9 8h10M5 21h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v12a2 2 0 002 2z" /></svg>
                    Tgl. Pengajuan: {{ \Carbon\Carbon::parse($pengajuan->created_at)->translatedFormat('d F Y') }}
                </p>
                <h2 class="text-3xl font-extrabold text-slate-800 tracking-tight">{{ $pengajuan->nama_nasabah }}</h2>
            </div>
            <div>
                <span class="px-5 py-2 rounded-full text-sm font-bold inline-flex items-center gap-2 border shadow-sm
                    @if($pengajuan->status == 'Pending') bg-yellow-50 text-yellow-600 border-yellow-200
                    @elseif($pengajuan->status == 'Disetujui') bg-green-50 text-green-600 border-green-200
                    @else bg-red-50 text-red-600 border-red-200 @endif
                ">
                    @if($pengajuan->status == 'Pending')
                        <svg class="w-4 h-4 animate-spin" fill="none" viewBox="0 0 24 24" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 4v5h.582m15.356 2A8.001 8.001 0 004.582 9m0 0H9m11 11v-5h-.581m0 0a8.003 8.003 0 01-15.357-2m15.357 2H15" /></svg>
                    @elseif($pengajuan->status == 'Disetujui')
                        <svg class="w-4 h-4" fill="none" viewBox="0 0 24 24" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7" /></svg>
                    @else
                        <svg class="w-4 h-4" fill="none" viewBox="0 0 24 24" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12" /></svg>
                    @endif
                    Status: {{ $pengajuan->status }}
                </span>
            </div>
        </div>

        <div class="p-8 relative z-10">
            <h3 class="text-lg font-bold text-slate-800 border-b border-slate-100 pb-3 mb-6">Informasi Data Kredit</h3>
            
            <dl class="grid grid-cols-1 md:grid-cols-2 gap-x-8 gap-y-8">
                
                <div class="sm:col-span-1 bg-slate-50/50 p-4 rounded-2xl border border-slate-100">
                    <dt class="text-sm font-bold text-slate-400 uppercase tracking-wider mb-1">Tipe Pengajuan</dt>
                    <dd class="text-lg font-semibold text-slate-800">{{ $pengajuan->tipe_pengajuan }}</dd>
                </div>
                
                <div class="sm:col-span-1 bg-slate-50/50 p-4 rounded-2xl border border-slate-100">
                    <dt class="text-sm font-bold text-slate-400 uppercase tracking-wider mb-1">Pendapatan Bulanan</dt>
                    <dd class="text-lg font-semibold text-slate-800">Rp {{ number_format($pengajuan->pendapatan_bulanan, 0, ',', '.') }}</dd>
                </div>
                
                <div class="sm:col-span-1 bg-slate-50/50 p-4 rounded-2xl border border-slate-100">
                    <dt class="text-sm font-bold text-slate-400 uppercase tracking-wider mb-1">Nominal Pengajuan</dt>
                    <dd class="text-lg font-semibold text-slate-800">Rp {{ number_format($pengajuan->nominal_pengajuan, 0, ',', '.') }}</dd>
                </div>
                
                <div class="sm:col-span-1 bg-slate-50/50 p-4 rounded-2xl border border-slate-100">
                    <dt class="text-sm font-bold text-slate-400 uppercase tracking-wider mb-1">Tenor Kredit</dt>
                    <dd class="text-lg font-semibold text-slate-800">{{ $pengajuan->tenor }} Bulan</dd>
                </div>

                <div class="sm:col-span-2 bg-slate-50/50 p-4 rounded-2xl border border-slate-100">
                    <dt class="text-sm font-bold text-slate-400 uppercase tracking-wider mb-2">Catatan dari Nasabah</dt>
                    <dd class="text-base text-slate-700 bg-white p-4 rounded-xl border border-slate-200 shadow-sm italic">
                        {{ $pengajuan->catatan ?: 'Tidak ada catatan tambahan.' }}
                    </dd>
                </div>
            </dl>
        </div>

        <!-- Section Kalkulasi Pembayaran Tagihan -->
        <div class="p-8 bg-gradient-to-br from-yellow-50 to-yellow-100/50 border-t border-yellow-200/50 relative z-10">
            <h3 class="text-xl font-bold text-slate-800 mb-6 flex items-center gap-3">
                <span class="p-2 bg-yellow-400 text-white rounded-xl shadow-sm">
                    <svg class="w-5 h-5" fill="none" viewBox="0 0 24 24" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2.5" d="M9 7h6m0 10v-3m-3 3h.01M9 17h.01M9 14h.01M12 14h.01M15 11h.01M12 11h.01M9 11h.01M7 21h10a2 2 0 002-2V5a2 2 0 00-2-2H7a2 2 0 00-2 2v14a2 2 0 002 2z" /></svg>
                </span> 
                Simulasi Tagihan
            </h3>
            
            <div class="flex flex-col md:flex-row gap-4 items-stretch relative">
                <!-- Connector Line for Desktop -->
                <div class="hidden md:block absolute top-1/2 left-0 w-full h-0.5 bg-yellow-200 -z-10 -translate-y-1/2"></div>
                
                <div class="flex-1 w-full bg-white/80 backdrop-blur-sm p-6 rounded-3xl shadow-sm border border-yellow-200/50 text-center relative">
                    <div class="text-sm font-bold text-slate-400 uppercase tracking-wider mb-2">Pokok Pinjaman</div>
                    <div class="text-2xl font-black text-slate-800">Rp {{ number_format($pengajuan->nominal_pengajuan, 0, ',', '.') }}</div>
                </div>

                <div class="flex items-center justify-center -my-2 md:my-0 relative z-10">
                    <div class="w-10 h-10 rounded-full bg-yellow-100 border-4 border-yellow-50 text-yellow-600 font-black flex items-center justify-center text-xl shadow-sm">&divide;</div>
                </div>

                <div class="flex-1 w-full bg-white/80 backdrop-blur-sm p-6 rounded-3xl shadow-sm border border-yellow-200/50 text-center relative">
                    <div class="text-sm font-bold text-slate-400 uppercase tracking-wider mb-2">Lama Tenor</div>
                    <div class="text-2xl font-black text-slate-800">{{ $pengajuan->tenor }} Bulan</div>
                </div>
                
                <div class="flex items-center justify-center -my-2 md:my-0 relative z-10">
                    <div class="w-10 h-10 rounded-full bg-yellow-400 border-4 border-yellow-50 text-white font-black flex items-center justify-center text-xl shadow-sm">=</div>
                </div>

                <div class="flex-1 w-full bg-slate-900 p-6 rounded-3xl shadow-xl shadow-slate-900/10 text-center relative transform md:scale-105">
                    <div class="absolute -top-3 -right-3 w-8 h-8 bg-yellow-400 rounded-full animate-ping opacity-20"></div>
                    <div class="text-sm font-bold text-slate-300 uppercase tracking-wider mb-2">Tagihan / Bulan</div>
                    <div class="text-2xl font-black text-yellow-400">Rp {{ number_format($pengajuan->tagihan_per_bulan, 0, ',', '.') }}</div>
                </div>
            </div>
            
            <div class="mt-8 flex items-start gap-3 bg-white/60 p-4 rounded-xl border border-yellow-200">
                <svg class="w-5 h-5 text-yellow-600 flex-shrink-0 mt-0.5" fill="none" viewBox="0 0 24 24" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M13 16h-1v-4h-1m1-4h.01M21 12a9 9 0 11-18 0 9 9 0 0118 0z" /></svg>
                <p class="text-sm font-medium text-slate-600 leading-relaxed">
                    Kalkulasi di atas merupakan simulasi dari pembagian rata nominal pokok dengan panjang tenor. Dalam pengerjaan aplikasi fungsional (<b class="font-bold text-slate-800">Production</b>), penghitungan ini akan ditambahkan dengan persentase bunga flat/efektif.
                </p>
            </div>
        </div>

    </div>
</div>

<style>
    @keyframes fadeIn {
        from { opacity: 0; transform: translateY(10px); }
        to { opacity: 1; transform: translateY(0); }
    }
    .animate-fade-in {
        animation: fadeIn 0.6s ease-out forwards;
    }
</style>
@endsection
