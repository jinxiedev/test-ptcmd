<?php

namespace App\Http\Controllers;

use App\Models\Pengajuan;
use Illuminate\Http\Request;

class PengajuanController extends Controller
{
    public function index()
    {
        $pengajuans = Pengajuan::orderBy('created_at', 'desc')->get();
        return view('pengajuan.index', compact('pengajuans'));
    }

    public function store(Request $request)
    {
        // Validation
        $request->validate([
            'nama_nasabah' => 'required|string|max:255',
            'tipe_pengajuan' => 'required|in:Sepeda Motor,Mobil,Multiguna',
            'nominal_pengajuan' => 'required|numeric|max:200000000',
            'tenor' => 'required|integer|min:1|max:24',
            'pendapatan_bulanan' => 'required|numeric',
            'catatan' => 'nullable|string'
        ]);

        // Behaviour 1: Income < 1 million
        if ($request->pendapatan_bulanan < 1000000) {
            return back()->withErrors(['pendapatan_bulanan' => 'Nasabah belum dapat mengajukan pinjaman'])->withInput();
        }

        // Behaviour 4: Max 3 applications
        $applicationCount = Pengajuan::where('nama_nasabah', $request->nama_nasabah)->count();
        if ($applicationCount >= 3) {
            return back()->with('error', 'Maksimal pengajuan nasabah adalah sebanyak 3 kali.')->withInput();
        }

        Pengajuan::create($request->all());

        return redirect()->route('pengajuan.index')->with('success', 'Pengajuan berhasil ditambahkan.');
    }

    public function show($id)
    {
        $pengajuan = Pengajuan::findOrFail($id);
        return view('pengajuan.show', compact('pengajuan'));
    }

    public function updateStatus(Request $request, $id)
    {
        $pengajuan = Pengajuan::findOrFail($id);
        
        $request->validate([
            'status' => 'required|in:Disetujui,Ditolak'
        ]);

        $pengajuan->update(['status' => $request->status]);

        return redirect()->route('pengajuan.index')->with('success', 'Status pengajuan berhasil diubah.');
    }

    public function edit($id)
    {
        $pengajuan = Pengajuan::findOrFail($id);
        return view('pengajuan.edit', compact('pengajuan'));
    }

    public function update(Request $request, $id)
    {
        $pengajuan = Pengajuan::findOrFail($id);

        $request->validate([
            'nama_nasabah' => 'required|string|max:255',
            'tipe_pengajuan' => 'required|in:Sepeda Motor,Mobil,Multiguna',
            'nominal_pengajuan' => 'required|numeric|max:200000000',
            'tenor' => 'required|integer|min:1|max:24',
            'pendapatan_bulanan' => 'required|numeric',
            'catatan' => 'nullable|string'
        ]);

        if ($request->pendapatan_bulanan < 1000000) {
            return back()->withErrors(['pendapatan_bulanan' => 'Nasabah belum dapat mengajukan pinjaman'])->withInput();
        }

        // Check if name is changed and exceeds limit
        if ($pengajuan->nama_nasabah !== $request->nama_nasabah) {
            $applicationCount = Pengajuan::where('nama_nasabah', $request->nama_nasabah)->count();
            if ($applicationCount >= 3) {
                return back()->with('error', 'Maksimal pengajuan nasabah adalah sebanyak 3 kali.')->withInput();
            }
        }

        $pengajuan->update($request->all());

        return redirect()->route('pengajuan.show', $id)->with('success', 'Data pengajuan berhasil diperbarui.');
    }

    public function destroy($id)
    {
        $pengajuan = Pengajuan::findOrFail($id);
        $pengajuan->delete();

        return redirect()->route('pengajuan.index')->with('success', 'Data pengajuan berhasil dihapus.');
    }
}
