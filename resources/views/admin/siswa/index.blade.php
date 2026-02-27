@extends('layouts.app')

@section('content')

<style>
    .btn-edit {
        background-color: #5C7C8A; /* soft blue gray */
        color: white;
        border: none;
    }

    .btn-edit:hover {
        background-color: #4a6673;
        color: white;
    }

    .btn-detail {
        background-color: #2F7F7F; /* calm teal */
        color: white;
        border: none;
    }

    .btn-detail:hover {
        background-color: #256666;
        color: white;
    }

    .btn-hapus {
        background-color: #8B3A3A; /* soft maroon */
        color: white;
        border: none;
    }

    .btn-hapus:hover {
        background-color: #6f2e2e;
        color: white;
    }
</style>

<div class="container">
    <h3>Daftar Siswa</h3>

    {{-- NOTIFIKASI SUCCESS --}}
    @if (session('success'))
        <div class="alert alert-success alert-dismissible fade show">
            {{ session('success') }}
            <button type="button" class="btn-close" data-bs-dismiss="alert"></button>
        </div>
    @endif

    {{-- NOTIFIKASI ERROR VALIDASI --}}
    @if ($errors->any())
        <div class="alert alert-danger">
            <ul class="mb-0">
                @foreach ($errors->all() as $error)
                    <li>{{ $error }}</li>
                @endforeach
            </ul>
        </div>
    @endif

    <form action="/siswa" method="POST" class="row mb-4">
        @csrf
        <div class="col-md-6">
            <input type="text" name="nama" class="form-control" placeholder="Nama">
        </div>
        <div class="col-md-3">
            <input type="text" name="kelas" class="form-control" placeholder="Kelas">
        </div>
        <div class="col-md-3">
            <button class="btn w-100" style="background-color:#3E6B48; color:white;">
                Simpan
            </button>
        </div>
    </form>

    <table class="table table-bordered">
        <tr>
            <th>No</th>
            <th>Nama</th>
            <th>Kelas</th>
            <th>Aksi</th>
        </tr>

        @foreach ($siswa as $item)
        <tr>
            <td>{{ $siswa->firstItem() + $loop->index }}</td>
            <td>{{ $item->nama }}</td>
            <td>{{ $item->kelas }}</td>
            <td>
                <a href="/siswa/{{ $item->id }}/edit" class="btn btn-edit btn-sm">
                    Edit
                </a>

                <a href="/siswa/{{ $item->id }}/detail" class="btn btn-detail btn-sm">
                    Detail
                </a>

                <a href="/siswa/{{ $item->id }}/hapus"
                   class="btn btn-hapus btn-sm"
                   onclick="return confirm('Hapus data siswa?')">
                    Hapus
                </a>
            </td>
        </tr>
        @endforeach
    </table>

    <div class="d-flex justify-content-center mt-3">
        {{ $siswa->links('pagination::bootstrap-5') }}
    </div>
</div>

@endsection
