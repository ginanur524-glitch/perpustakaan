@extends('layouts.app')

@section('content')
<div class="container">
    <h3>Detail Siswa</h3>

    {{-- DATA SISWA --}}
    <div class="card mb-4">
        <div class="card-body">
            <h5>Informasi Siswa</h5>
            <table class="table table-bordered">
                <tr>
                    <th>Nama</th>
                    <td>{{ $siswa->nama }}</td>
                </tr>
                <tr>
                    <th>Kelas</th>
                    <td>{{ $siswa->kelas }}</td>
                </tr>
            </table>
        </div>
    </div>

    {{-- RIWAYAT PEMINJAMAN --}}
    <div class="card">
        <div class="card-body">
            <h5>Riwayat Buku Dipinjam</h5>

            @if ($siswa->peminjaman->count() == 0)
                <div class="alert alert-info">
                    Siswa belum pernah meminjam buku.
                </div>
            @else
                <table class="table table-bordered">
                    <tr>
                        <th>No</th>
                        <th>Judul Buku</th>
                        <th>Tanggal Pinjam</th>
                        <th>Status</th>
                    </tr>
                    @foreach ($siswa->peminjaman as $p)
                        <tr>
                            <td>{{ $loop->iteration }}</td>
                            <td>{{ $p->buku->judul }}</td>
                            <td>{{ $p->tanggal_pinjam }}</td>
                            <td>
                                @if ($p->status == 'dipinjam')
                                    <span class="badge bg-warning">Dipinjam</span>
                                @else
                                    <span class="badge bg-success">Dikembalikan</span>
                                @endif
                            </td>
                        </tr>
                    @endforeach
                </table>
            @endif
        </div>
    </div>

    <a href="/siswa" class="btn btn-secondary mt-3">Kembali</a>
</div>
@endsection