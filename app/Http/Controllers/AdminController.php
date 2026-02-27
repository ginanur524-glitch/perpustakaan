<?php

namespace App\Http\Controllers;

use App\Models\Buku;
use App\Models\Peminjaman;
use App\Models\Siswa;
use Illuminate\Http\Request;
use App\Exports\PeminjamanExport;
use Maatwebsite\Excel\Facades\Excel;
use Barryvdh\DomPDF\Facade\Pdf;


class AdminController extends Controller
{
    /* ======================
       DASHBOARD
       ====================== */
        public function dashboard()
    {
        $totalBuku = Buku::count();
        $totalSiswa = Siswa::count();
        $peminjamanAktif = Peminjaman::where('status', 'dipinjam')->count();

        return view('admin.dashboard', compact('totalBuku', 'totalSiswa', 'peminjamanAktif'));
    }


    /* ======================
       CRUD BUKU
       ====================== */

        // Tampilkan data buku
    public function buku()
    {
        $buku = Buku::orderBy('id', 'desc')->paginate(5);

        return view('admin.buku.index', compact('buku'));
    }


        // Simpan buku baru
        public function storeBuku(Request $request)
    {
        $request->validate([
            'judul' => 'required',
            'stok' => 'required|integer|min:0',
        ], [
            'judul.required' => 'Judul wajib diisi, tidak boleh kosong!',
            'stok.required' => 'Stok wajib diisi, tidak boleh kosong!',
            'stok.integer' => 'Stok harus berupa angka!',
            'stok.min' => 'Stok tidak boleh kurang dari 0!',
        ]);

        Buku::create([
            'judul' => $request->judul,
            'stok' => $request->stok
        ]);

        return redirect('/buku')->with('success', 'Data buku berhasil disimpan!');
    }


    // edit buku
    public function editBuku($id)
    {
        $buku = Buku::findOrFail($id);

        return view('admin.buku.edit', compact('buku'));
    }

    // Proses update buku
    public function updateBuku(Request $request, $id)
    {
        $request->validate([
            'judul' => 'required',
            'stok' => 'required|integer|min:0',
        ]);

        $buku = Buku::findOrFail($id);
        $buku->update($request->all());

        return redirect('/buku');
    }

    // Hapus buku
    public function deleteBuku($id)
    {
        Buku::findOrFail($id)->delete();

        return redirect()->back();
    }

    /* ======================
       PEMINJAMAN BUKU
       ====================== */

    // Tampilkan form & data peminjaman
        public function peminjaman(Request $request)
    {
        $siswa = Siswa::all();
        $buku = Buku::all();

        $query = Peminjaman::with(['siswa', 'buku']);

        // Filter status jika dipilih
        if ($request->status) {
            $query->where('status', $request->status);
        }

        $data = $query->orderBy('tanggal_pinjam', 'desc')->paginate(5);

        return view('admin.peminjaman.index', compact('siswa', 'buku', 'data'));
    }

    // Proses peminjaman
        public function storePeminjaman(Request $request)
    {
        $request->validate([
            'siswa_id' => 'required',
            'buku_id' => 'required',
        ]);

        $buku = Buku::findOrFail($request->buku_id);

        if ($buku->stok <= 0) {
            return redirect()->back()->with('error', 'Stok buku habis');
        }

        Peminjaman::create([
            'siswa_id' => $request->siswa_id,
            'buku_id' => $request->buku_id,
            'tanggal_pinjam' => now(),
            'status' => 'dipinjam',
            'tanggal_kembali' => null
        ]);

        $buku->decrement('stok');

        return redirect()->back()->with('success', 'Buku berhasil dipinjam');
    }


    // Proses pengembalian buku
    public function kembalikan($id)
{
    $peminjaman = Peminjaman::with('buku')->findOrFail($id);

    if ($peminjaman->status === 'dikembalikan') {
        return redirect()->back();
    }

    $peminjaman->update([
        'status' => 'dikembalikan',
        'tanggal_kembali' => now(), // ⬅️ OTOMATIS ISI
    ]);

    $peminjaman->buku->increment('stok');

    return redirect()->back()->with('success', 'Buku berhasil dikembalikan');
}



    /* ======================
       CRUD SISWA
       ====================== */

        // Tampilkan daftar siswa
        public function siswa()
    {
        $siswa = Siswa::orderBy('id', 'desc')->paginate(5);

        return view('admin.siswa.index', compact('siswa'));
    }


        // Simpan buku baru
        public function storeSiswa(Request $request)
    {
        $request->validate([
            'nama' => 'required',
            'kelas' => 'required'
        ], [
            'nama.required' => 'Nama wajib diisi, tidak boleh kosong!',
            'kelas.required' => 'Kelas wajib diisi, tidak boleh kosong!'
        ]);

        Siswa::create([
            'nama' => $request->nama,
            'kelas' => $request->kelas
        ]);

        return redirect('/siswa')->with('success', 'Data siswa berhasil disimpan!');
    }


    // edit siswa
    public function editSiswa($id)
    {
        $siswa = Siswa::findOrFail($id);

        return view('admin.siswa.edit', compact('siswa'));
    }

    // Proses update siswa
    public function updateSiswa(Request $request, $id)
    {
        $request->validate([
            'nama' => 'required',
            'kelas' => 'required',
        ]);

        $siswa = Siswa::findOrFail($id);
        $siswa->update($request->all());

        return redirect('/siswa');
    }

    // Hapus siswa
    public function deleteSiswa($id)
    {
        Siswa::findOrFail($id)->delete();

        return redirect()->back();
    }

    public function detailSiswa($id)
    {
        $siswa = Siswa::with('peminjaman.buku')->findOrFail($id);

        return view('admin.siswa.detail', compact('siswa'));
    }

public function exportPeminjaman()
{
    return Excel::download(new PeminjamanExport, 'data_peminjaman.xlsx');
}
public function exportPdf()
{
    $data = Peminjaman::with(['siswa','buku'])->get();

    $pdf = Pdf::loadView('peminjaman.pdf', compact('data'))
              ->setPaper('a4', 'landscape');

    return $pdf->download('data_peminjaman.pdf');
}

}