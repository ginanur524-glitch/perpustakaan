@extends('layouts.app')

@section('content')
<div class="container">
    <h3>Peminjaman Buku</h3>

    {{-- NOTIFIKASI ERROR --}}
    @if (session('error'))
        <div class="alert alert-danger">
            {{ session('error') }}
        </div>
    @endif

    {{-- FORM TAMBAH PEMINJAMAN --}}
    <form action="/peminjaman" method="POST" class="row mb-4">
        @csrf
        <div class="col-md-4">
            <select name="siswa_id" class="form-control" required>
                <option value="">Pilih Siswa</option>
                @foreach ($siswa as $s)
                    <option value="{{ $s->id }}">{{ $s->nama }}</option>
                @endforeach
            </select>
        </div>

        <div class="col-md-4">
            <select name="buku_id" class="form-control" required>
                <option value="">Pilih Buku</option>
                @foreach ($buku as $b)
                    <option value="{{ $b->id }}">
                        {{ $b->judul }} (Stok: {{ $b->stok }})
                    </option>
                @endforeach
            </select>
        </div>

        <div class="col-md-4">
            <button class="btn btn-primary w-100">
                Pinjam
            </button>
        </div>
    </form>

    {{-- FILTER STATUS --}}
    <form method="GET" action="/peminjaman" class="row mb-3">
        <div class="col-md-4">
            <select name="status"
                    class="form-control"
                    onchange="this.form.submit()">
                <option value="">-- Semua Status --</option>
                <option value="dipinjam"
                    {{ request('status') == 'dipinjam' ? 'selected' : '' }}>
                    Dipinjam
                </option>
                <option value="dikembalikan"
                    {{ request('status') == 'dikembalikan' ? 'selected' : '' }}>
                    Dikembalikan
                </option>
            </select>
        </div>
    </form>

    <div class="d-flex justify-content-between align-items-center mb-3">
    <h5>Data Peminjaman</h5>

    <div>
        <a href="{{ url('/peminjaman/export') }}" class="btn btn-success">
            📥 Excel
        </a>

        <a href="{{ url('/peminjaman/export/pdf') }}" class="btn btn-danger">
            📄 PDF
        </a>
    </div>
</div>


    {{-- TABEL DATA --}}
    <table class="table table-bordered">
        <tr>
            <th>No</th>
            <th>Nama Siswa</th>
            <th>Judul Buku</th>
            <th>Tanggal Pinjam</th>
            <th>Tanggal Kembali</th>
            <th>Status</th>
            <th>Aksi</th>
        </tr>

        @foreach ($data as $p)
        <tr>
            <td>{{ $loop->iteration }}</td>
            <td>{{ $p->siswa->nama }}</td>
            <td>{{ $p->buku->judul }}</td>
            <td>{{ $p->tanggal_pinjam }}</td>
            <td>{{ $p->tanggal_kembali ?? '-' }}</td>
            <td>{{ ucfirst($p->status) }}</td>
            <td>
                @if ($p->status == 'dipinjam')
                    <a href="/peminjaman/{{ $p->id }}/kembali"
                       class="btn btn-success btn-sm"
                       onclick="return confirm('Kembalikan buku ini?')">
                        Kembalikan
                    </a>
                @else
                    <span class="text-muted">Selesai</span>
                @endif
            </td>
        </tr>
        @endforeach
    </table>

    {{-- PAGINATION --}}
    {{ $data->withQueryString()->links() }}

</div>
@endsection
