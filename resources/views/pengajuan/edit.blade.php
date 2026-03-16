@extends('layouts.app')

@section('content')
<div class="max-w-4xl mx-auto space-y-10 animate-fade-in pb-10">
    
    <div class="mb-4 flex justify-between items-center bg-white/60 backdrop-blur-xl border border-white/80 p-4 rounded-full shadow-[0_4px_20px_rgb(0,0,0,0.03)]">
        <h1 class="text-xl font-bold text-slate-800 ml-4 flex items-center gap-2">
            <div class="w-8 h-8 rounded-full bg-yellow-400 text-white flex items-center justify-center">
                <svg class="w-4 h-4 hidden sm:block" fill="none" viewBox="0 0 24 24" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M11 5H6a2 2 0 00-2 2v11a2 2 0 002 2h11a2 2 0 002-2v-5m-1.414-9.414a2 2 0 112.828 2.828L11.828 15H9v-2.828l8.586-8.586z" /></svg>
            </div>
            Edit Pengajuan
        </h1>
        <a href="{{ route('pengajuan.show', $pengajuan->id) }}" class="text-slate-600 hover:text-slate-900 bg-white border border-slate-200 hover:bg-slate-50 font-semibold px-5 py-2 rounded-full transition shadow-sm flex items-center gap-2">
            <svg class="w-4 h-4" fill="none" viewBox="0 0 24 24" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M10 19l-7-7m0 0l7-7m-7 7h18" /></svg>
            Batal
        </a>
    </div>

    @if(session('error'))
        <div class="bg-red-50 backdrop-blur-md border border-red-200 text-red-700 font-medium p-4 rounded-2xl shadow-sm flex items-center gap-3" role="alert">
            <svg class="w-5 h-5 text-red-500" fill="none" viewBox="0 0 24 24" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8v4m0 4h.01M21 12a9 9 0 11-18 0 9 9 0 0118 0z" /></svg>
            {{ session('error') }}
        </div>
    @endif
    @if($errors->any())
        <div class="bg-red-50 backdrop-blur-md border border-red-200 text-red-700 font-medium p-6 rounded-2xl shadow-sm" role="alert">
            <div class="flex items-center gap-2 mb-2">
                <svg class="w-5 h-5 text-red-500" fill="none" viewBox="0 0 24 24" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 9v2m0 4h.01m-6.938 4h13.856c1.54 0 2.502-1.667 1.732-3L13.732 4c-.77-1.333-2.694-1.333-3.464 0L3.34 16c-.77 1.333.192 3 1.732 3z" /></svg>
                <span class="font-bold">Periksa kembali isian Anda:</span>
            </div>
            <ul class="list-disc pl-8 text-sm space-y-1">
                @foreach ($errors->all() as $error)
                    <li>{{ $error }}</li>
                @endforeach
            </ul>
        </div>
    @endif

    <div class="bg-white/80 backdrop-blur-xl rounded-[2rem] shadow-[0_8px_30px_rgb(0,0,0,0.04)] p-8 border border-white relative overflow-hidden">
        <div class="absolute top-0 right-0 w-64 h-64 bg-yellow-100 rounded-full mix-blend-multiply filter blur-3xl opacity-50 translate-x-1/2 -translate-y-1/2 pointer-events-none"></div>
        
        <form action="{{ route('pengajuan.update', $pengajuan->id) }}" method="POST" class="relative z-10">
            @csrf
            @method('PUT')
            <div class="grid grid-cols-1 md:grid-cols-2 gap-x-8 gap-y-6">
                <!-- Nama -->
                <div class="space-y-1.5 focus-within:relative focus-within:z-20">
                    <label class="block text-sm font-semibold text-slate-600">Nama Lengkap Nasabah</label>
                    <input type="text" name="nama_nasabah" value="{{ old('nama_nasabah', $pengajuan->nama_nasabah) }}" required 
                           class="w-full bg-white/70 backdrop-blur-sm rounded-2xl border border-slate-200 shadow-sm p-3.5 focus:ring-2 focus:ring-yellow-400 focus:border-transparent outline-none transition-all placeholder:text-slate-300">
                </div>
                
                <!-- Tipe Pengajuan -->
                <div class="space-y-1.5 focus-within:relative focus-within:z-20">
                    <label class="block text-sm font-semibold text-slate-600">Tipe Pengajuan</label>
                    <select name="tipe_pengajuan" required class="w-full bg-white/70 backdrop-blur-sm rounded-2xl border border-slate-200 shadow-sm p-3.5 focus:ring-2 focus:ring-yellow-400 focus:border-transparent outline-none transition-all">
                        <option value="">Pilih Tipe</option>
                        <option value="Sepeda Motor" {{ old('tipe_pengajuan', $pengajuan->tipe_pengajuan) == 'Sepeda Motor' ? 'selected' : '' }}>Sepeda Motor</option>
                        <option value="Mobil" {{ old('tipe_pengajuan', $pengajuan->tipe_pengajuan) == 'Mobil' ? 'selected' : '' }}>Mobil</option>
                        <option value="Multiguna" {{ old('tipe_pengajuan', $pengajuan->tipe_pengajuan) == 'Multiguna' ? 'selected' : '' }}>Multiguna</option>
                    </select>
                </div>
                
                <!-- Nominal Pengajuan -->
                <div class="space-y-1.5 focus-within:relative focus-within:z-20">
                    <label class="block text-sm font-semibold text-slate-600">Nominal Pengajuan <span class="text-xs font-medium text-slate-400 ml-1">(Max Rp 200 Juta)</span></label>
                    <div class="relative group">
                        <div class="absolute inset-y-0 left-0 pl-4 flex items-center pointer-events-none z-10">
                            <span class="text-slate-600 font-bold group-focus-within:text-yellow-600 transition-colors">Rp</span>
                        </div>
                        <input type="number" name="nominal_pengajuan" value="{{ old('nominal_pengajuan', $pengajuan->nominal_pengajuan) }}" max="200000000" required 
                               class="w-full pl-12 bg-white/70 backdrop-blur-sm rounded-2xl border border-slate-200 shadow-sm p-3.5 focus:ring-2 focus:ring-yellow-400 focus:border-transparent outline-none transition-all relative z-0">
                    </div>
                </div>
                
                <!-- Tenor -->
                <div class="space-y-1.5 focus-within:relative focus-within:z-20">
                    <label class="block text-sm font-semibold text-slate-600">Tenor Pinjaman <span class="text-xs font-medium text-slate-400 ml-1">(Max 24 Bulan)</span></label>
                    <div class="relative group">
                        <input type="number" name="tenor" value="{{ old('tenor', $pengajuan->tenor) }}" min="1" max="24" required 
                               class="w-full pr-16 bg-white/70 backdrop-blur-sm rounded-2xl border border-slate-200 shadow-sm p-3.5 focus:ring-2 focus:ring-yellow-400 focus:border-transparent outline-none transition-all relative z-0">
                        <div class="absolute inset-y-0 right-0 pr-4 flex items-center pointer-events-none z-10">
                            <span class="text-slate-500 text-sm font-bold group-focus-within:text-yellow-600 transition-colors">Bulan</span>
                        </div>
                    </div>
                </div>
                
                <!-- Pendapatan Bulanan -->
                <div class="space-y-1.5 focus-within:relative focus-within:z-20">
                    <label class="block text-sm font-semibold text-slate-600">Pendapatan Bulanan</label>
                    <div class="relative group">
                        <div class="absolute inset-y-0 left-0 pl-4 flex items-center pointer-events-none z-10">
                            <span class="text-slate-600 font-bold group-focus-within:text-yellow-600 transition-colors">Rp</span>
                        </div>
                        <input type="number" name="pendapatan_bulanan" value="{{ old('pendapatan_bulanan', $pengajuan->pendapatan_bulanan) }}" required min="0" placeholder="Min. 1.000.000"
                               class="w-full pl-12 bg-white/70 backdrop-blur-sm rounded-2xl border border-slate-200 shadow-sm p-3.5 focus:ring-2 focus:ring-yellow-400 focus:border-transparent outline-none transition-all placeholder:text-slate-400 relative z-0">
                    </div>
                </div>
                
                <!-- Catatan -->
                <div class="md:col-span-2 space-y-1.5 focus-within:relative focus-within:z-20">
                    <label class="block text-sm font-semibold text-slate-600">Catatan <span class="text-xs font-medium text-slate-400 ml-1">(Opsional)</span></label>
                    <textarea name="catatan" rows="3" class="w-full bg-white/70 backdrop-blur-sm rounded-2xl border border-slate-200 shadow-sm p-3.5 focus:ring-2 focus:ring-yellow-400 focus:border-transparent outline-none transition-all">{{ old('catatan', $pengajuan->catatan) }}</textarea>
                </div>
            </div>
            
            <div class="mt-8 flex justify-end">
                <button type="submit" class="bg-yellow-400 hover:bg-yellow-500 text-slate-900 font-bold py-3 px-8 rounded-full shadow-lg shadow-yellow-200 transition transform hover:-translate-y-0.5 flex items-center gap-2">
                    <svg class="w-5 h-5" fill="none" viewBox="0 0 24 24" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7" /></svg>
                    Perbarui Pengajuan
                </button>
            </div>
        </form>
    </div>
</div>
@endsection
