@extends('layouts.app')

@section('content')
<div class="space-y-10 animate-fade-in">
    
    <!-- Flash Messages -->
    @if(session('success'))
        <div class="bg-green-50 backdrop-blur-md border border-green-200 text-green-700 font-medium p-4 rounded-2xl shadow-sm flex items-center gap-3" role="alert">
            <svg class="w-5 h-5 text-green-500" fill="none" viewBox="0 0 24 24" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12l2 2 4-4m6 2a9 9 0 11-18 0 9 9 0 0118 0z" /></svg>
            {{ session('success') }}
        </div>
    @endif
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

    <!-- Section Form Tambah Pengajuan -->
    <div id="form-pengajuan" class="bg-white/80 backdrop-blur-xl rounded-[2rem] shadow-[0_8px_30px_rgb(0,0,0,0.04)] p-8 border border-white relative overflow-hidden">
        <div class="absolute top-0 right-0 w-64 h-64 bg-yellow-100 rounded-full mix-blend-multiply filter blur-3xl opacity-50 translate-x-1/2 -translate-y-1/2 pointer-events-none"></div>
        
        <h2 class="text-2xl font-bold text-slate-800 mb-8 flex items-center gap-3 relative z-10">
            <span class="p-2.5 bg-yellow-100 text-yellow-600 rounded-2xl">
                <svg class="w-6 h-6" fill="none" viewBox="0 0 24 24" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2.5" d="M12 4v16m8-8H4" /></svg>
            </span>
            Catat Pengajuan Kredit
        </h2>
        
        <form action="{{ route('pengajuan.store') }}" method="POST" class="relative z-10">
            @csrf
            <div class="grid grid-cols-1 md:grid-cols-2 gap-x-8 gap-y-6">
                <!-- Nama -->
                <div class="space-y-1.5 focus-within:relative focus-within:z-20">
                    <label class="block text-sm font-semibold text-slate-600">Nama Lengkap Nasabah</label>
                    <input type="text" name="nama_nasabah" value="{{ old('nama_nasabah') }}" required 
                           class="w-full bg-white/70 backdrop-blur-sm rounded-2xl border border-slate-200 shadow-sm p-3.5 focus:ring-2 focus:ring-yellow-400 focus:border-transparent outline-none transition-all placeholder:text-slate-300">
                </div>
                
                <!-- Tipe Pengajuan -->
                <div class="space-y-1.5 focus-within:relative focus-within:z-20">
                    <label class="block text-sm font-semibold text-slate-600">Tipe Pengajuan</label>
                    <select name="tipe_pengajuan" required class="w-full bg-white/70 backdrop-blur-sm rounded-2xl border border-slate-200 shadow-sm p-3.5 focus:ring-2 focus:ring-yellow-400 focus:border-transparent outline-none transition-all">
                        <option value="">Pilih Tipe</option>
                        <option value="Sepeda Motor" {{ old('tipe_pengajuan') == 'Sepeda Motor' ? 'selected' : '' }}>Sepeda Motor</option>
                        <option value="Mobil" {{ old('tipe_pengajuan') == 'Mobil' ? 'selected' : '' }}>Mobil</option>
                        <option value="Multiguna" {{ old('tipe_pengajuan') == 'Multiguna' ? 'selected' : '' }}>Multiguna</option>
                    </select>
                </div>
                
                <!-- Nominal Pengajuan -->
                <div class="space-y-1.5 focus-within:relative focus-within:z-20">
                    <label class="block text-sm font-semibold text-slate-600">Nominal Pengajuan <span class="text-xs font-medium text-slate-400 ml-1">(Max Rp 200 Juta)</span></label>
                    <div class="relative group">
                        <div class="absolute inset-y-0 left-0 pl-4 flex items-center pointer-events-none z-10">
                            <span class="text-slate-600 font-bold group-focus-within:text-yellow-600 transition-colors">Rp</span>
                        </div>
                        <input type="number" name="nominal_pengajuan" value="{{ old('nominal_pengajuan') }}" max="200000000" required 
                               class="w-full pl-12 bg-white/70 backdrop-blur-sm rounded-2xl border border-slate-200 shadow-sm p-3.5 focus:ring-2 focus:ring-yellow-400 focus:border-transparent outline-none transition-all relative z-0">
                    </div>
                </div>
                
                <!-- Tenor -->
                <div class="space-y-1.5 focus-within:relative focus-within:z-20">
                    <label class="block text-sm font-semibold text-slate-600">Tenor Pinjaman <span class="text-xs font-medium text-slate-400 ml-1">(Max 24 Bulan)</span></label>
                    <div class="relative group">
                        <input type="number" name="tenor" value="{{ old('tenor') }}" min="1" max="24" required 
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
                        <input type="number" name="pendapatan_bulanan" value="{{ old('pendapatan_bulanan') }}" required min="0" placeholder="Min. 1.000.000"
                               class="w-full pl-12 bg-white/70 backdrop-blur-sm rounded-2xl border border-slate-200 shadow-sm p-3.5 focus:ring-2 focus:ring-yellow-400 focus:border-transparent outline-none transition-all placeholder:text-slate-400 relative z-0">
                    </div>
                </div>
                
                <!-- Catatan -->
                <div class="md:col-span-2 space-y-1.5 focus-within:relative focus-within:z-20">
                    <label class="block text-sm font-semibold text-slate-600">Catatan <span class="text-xs font-medium text-slate-400 ml-1">(Opsional)</span></label>
                    <textarea name="catatan" rows="3" class="w-full bg-white/70 backdrop-blur-sm rounded-2xl border border-slate-200 shadow-sm p-3.5 focus:ring-2 focus:ring-yellow-400 focus:border-transparent outline-none transition-all">{{ old('catatan') }}</textarea>
                </div>
            </div>
            
            <div class="mt-8 flex justify-end">
                <button type="submit" class="bg-yellow-400 hover:bg-yellow-500 text-slate-900 font-bold py-3 px-8 rounded-full shadow-lg shadow-yellow-200 transition transform hover:-translate-y-0.5 flex items-center gap-2">
                    <svg class="w-5 h-5" fill="none" viewBox="0 0 24 24" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7" /></svg>
                    Simpan Pengajuan
                </button>
            </div>
        </form>
    </div>

    <!-- Section Tabel -->
    <div id="tabel-pengajuan" class="bg-white/80 backdrop-blur-xl rounded-[2rem] shadow-[0_8px_30px_rgb(0,0,0,0.04)] border border-white overflow-hidden relative z-10">
        <div class="p-8 border-b border-slate-100/50 flex justify-between items-center bg-white/60">
            <h2 class="text-2xl font-bold text-slate-800 flex items-center gap-3">
                <span class="p-2.5 bg-white text-slate-600 rounded-2xl shadow-sm border border-slate-100 relative z-10">
                    <svg class="w-6 h-6" fill="none" viewBox="0 0 24 24" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 11H5m14 0a2 2 0 012 2v6a2 2 0 01-2 2H5a2 2 0 01-2-2v-6a2 2 0 012-2m14 0V9a2 2 0 00-2-2M5 11V9a2 2 0 002-2m0 0V5a2 2 0 012-2h6a2 2 0 012 2v2M7 7h10" /></svg>
                </span>
                Daftar Pengajuan
            </h2>
        </div>
        
        <div class="overflow-x-auto p-4 sm:p-8 pt-4">
            <table class="w-full text-left border-collapse">
                <thead>
                    <tr class="text-xs font-extrabold text-slate-400 uppercase tracking-wider border-b border-slate-100">
                        <th class="pb-4 px-4 font-semibold text-slate-500">Tgl / Nama</th>
                        <th class="pb-4 px-4 font-semibold text-slate-500">Tipe</th>
                        <th class="pb-4 px-4 font-semibold text-slate-500">Nominal & Tenor</th>
                        <th class="pb-4 px-4 font-semibold text-slate-500">Tagihan /bln</th>
                        <th class="pb-4 px-4 font-semibold text-slate-500">Status</th>
                        <th class="pb-4 px-4 font-semibold text-slate-500 text-center">Aksi</th>
                    </tr>
                </thead>
                <tbody class="divide-y divide-slate-50/80">
                    @forelse($pengajuans as $item)
                        <tr class="hover:bg-slate-50/80 transition-colors group relative z-10">
                            <td class="py-5 px-4 whitespace-nowrap">
                                <div class="text-slate-400 text-xs font-medium mb-0.5">{{ \Carbon\Carbon::parse($item->created_at)->translatedFormat('d F Y') }}</div>
                                <div class="font-bold text-slate-800">{{ $item->nama_nasabah }}</div>
                            </td>
                            <td class="py-5 px-4 whitespace-nowrap">
                                <div class="inline-flex items-center px-3 py-1.5 rounded-xl bg-slate-100/70 text-slate-600 text-sm font-semibold border border-slate-200/50">
                                    {{ $item->tipe_pengajuan }}
                                </div>
                            </td>
                            <td class="py-5 px-4 whitespace-nowrap">
                                <div class="text-slate-800 font-bold mb-0.5">Rp {{ number_format($item->nominal_pengajuan, 0, ',', '.') }}</div>
                                <div class="text-xs font-semibold text-slate-400">{{ $item->tenor }} Bulan</div>
                            </td>
                            <td class="py-5 px-4 whitespace-nowrap">
                                <div class="px-3 py-1.5 rounded-xl bg-yellow-50 text-yellow-700 font-bold inline-block border border-yellow-100">
                                    Rp {{ number_format($item->tagihan_per_bulan, 0, ',', '.') }}
                                </div>
                            </td>
                            <td class="py-5 px-4 whitespace-nowrap">
                                <span class="px-3 py-1.5 inline-flex text-xs font-bold rounded-full border
                                    @if($item->status == 'Pending') bg-yellow-50 text-yellow-600 border-yellow-200
                                    @elseif($item->status == 'Disetujui') bg-green-50 text-green-600 border-green-200
                                    @else bg-red-50 text-red-600 border-red-200 @endif">
                                    <span class="mr-1.5 flex h-2 w-2 relative self-center">
                                      <span class="animate-ping absolute inline-flex h-full w-full rounded-full opacity-75 
                                      @if($item->status == 'Pending') bg-yellow-400 @elseif($item->status == 'Disetujui') bg-green-400 @else bg-red-400 @endif"></span>
                                      <span class="relative inline-flex rounded-full h-2 w-2 
                                      @if($item->status == 'Pending') bg-yellow-500 @elseif($item->status == 'Disetujui') bg-green-500 @else bg-red-500 @endif"></span>
                                    </span>
                                    {{ $item->status }}
                                </span>
                            </td>
                            <td class="py-5 px-4 whitespace-nowrap text-center flex justify-center gap-2 relative z-20">
                                <a href="{{ route('pengajuan.show', $item->id) }}" class="text-slate-600 font-semibold hover:text-slate-900 bg-white border border-slate-200 px-4 py-2 rounded-xl shadow-sm transition hover:bg-slate-50">Detail</a>
                                
                                @if($item->status == 'Pending')
                                    <div x-data="{ open: false }" class="inline-block">
                                        <button @click="open = true" class="text-green-700 font-semibold hover:text-green-900 bg-green-50 border border-green-200 px-4 py-2 rounded-xl shadow-sm transition hover:bg-green-100">Setujui</button>
                                        
                                        <template x-teleport="body">
                                            <div x-show="open" x-cloak class="fixed inset-0 z-[100] flex items-center justify-center p-4">
                                                <div class="fixed inset-0 bg-slate-900/40 backdrop-blur-sm transition-opacity" @click="open = false"></div>
                                                <div class="relative bg-white/90 backdrop-blur-xl border border-white rounded-3xl max-w-sm w-full p-8 text-left shadow-2xl transform transition-all" @click.stop>
                                                    <div class="w-12 h-12 rounded-full bg-green-100 flex items-center justify-center mb-5 relative z-10">
                                                        <svg class="w-6 h-6 text-green-600" fill="none" viewBox="0 0 24 24" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7" /></svg>
                                                    </div>
                                                    <h3 class="text-xl font-bold text-slate-800 mb-2">Konfirmasi Setuju</h3>
                                                    <p class="text-slate-500 mb-6 leading-relaxed">Anda akan menyetujui pengajuan kredit <br>atas nama <b class="text-slate-700">{{ $item->nama_nasabah }}</b>. Lanjutkan?</p>
                                                    <div class="flex justify-end gap-3 relative z-10">
                                                        <button @click="open = false" class="px-5 py-2.5 font-semibold text-slate-600 bg-slate-100 hover:bg-slate-200 rounded-xl transition">Batal</button>
                                                        <form action="{{ route('pengajuan.updateStatus', $item->id) }}" method="POST">
                                                            @csrf @method('PUT')
                                                            <input type="hidden" name="status" value="Disetujui">
                                                            <button type="submit" class="px-5 py-2.5 font-bold text-white bg-green-500 hover:bg-green-600 rounded-xl transition shadow-lg shadow-green-200">Ya, Setujui</button>
                                                        </form>
                                                    </div>
                                                </div>
                                            </div>
                                        </template>
                                    </div>

                                    <div x-data="{ open: false }" class="inline-block">
                                        <button @click="open = true" class="text-red-700 font-semibold hover:text-red-900 bg-red-50 border border-red-200 px-4 py-2 rounded-xl shadow-sm transition hover:bg-red-100">Tolak</button>

                                        <template x-teleport="body">
                                            <div x-show="open" x-cloak class="fixed inset-0 z-[100] flex items-center justify-center p-4">
                                                <div class="fixed inset-0 bg-slate-900/40 backdrop-blur-sm transition-opacity" @click="open = false"></div>
                                                <div class="relative bg-white/90 backdrop-blur-xl border border-white rounded-3xl max-w-sm w-full p-8 text-left shadow-2xl transform transition-all" @click.stop>
                                                    <div class="w-12 h-12 rounded-full bg-red-100 flex items-center justify-center mb-5 relative z-10">
                                                        <svg class="w-6 h-6 text-red-600" fill="none" viewBox="0 0 24 24" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12" /></svg>
                                                    </div>
                                                    <h3 class="text-xl font-bold text-slate-800 mb-2">Konfirmasi Tolak</h3>
                                                    <p class="text-slate-500 mb-6 leading-relaxed">Anda akan menolak pengajuan kredit <br>atas nama <b class="text-slate-700">{{ $item->nama_nasabah }}</b>. Yakin?</p>
                                                    <div class="flex justify-end gap-3 relative z-10">
                                                        <button @click="open = false" class="px-5 py-2.5 font-semibold text-slate-600 bg-slate-100 hover:bg-slate-200 rounded-xl transition">Batal</button>
                                                        <form action="{{ route('pengajuan.updateStatus', $item->id) }}" method="POST">
                                                            @csrf @method('PUT')
                                                            <input type="hidden" name="status" value="Ditolak">
                                                            <button type="submit" class="px-5 py-2.5 font-bold text-white bg-red-500 hover:bg-red-600 rounded-xl transition shadow-lg shadow-red-200">Ya, Tolak</button>
                                                        </form>
                                                    </div>
                                                </div>
                                            </div>
                                        </template>
                                    </div>
                                @endif
                            </td>
                        </tr>
                    @empty
                        <tr>
                            <td colspan="6" class="px-6 py-16 text-center">
                                <div class="flex flex-col items-center justify-center text-slate-400">
                                    <svg class="w-16 h-16 mb-4 text-slate-200" fill="none" viewBox="0 0 24 24" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5" d="M9 12h6m-6 4h6m2 5H7a2 2 0 01-2-2V5a2 2 0 012-2h5.586a1 1 0 01.707.293l5.414 5.414a1 1 0 01.293.707V19a2 2 0 01-2 2z" /></svg>
                                    <p class="text-lg font-medium text-slate-500">Belum ada pengajuan</p>
                                    <p class="text-sm">Silakan catat pengajuan baru melalui form di atas.</p>
                                </div>
                            </td>
                        </tr>
                    @endforelse
                </tbody>
            </table>
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
