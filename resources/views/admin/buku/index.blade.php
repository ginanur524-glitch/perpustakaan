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

    .btn-hapus {
        background-color: #8B3A3A; /* soft maroon */
        color: white;
        border: none;
    }

    .btn-hapus:hover {
        background-color: #6f2e2e;
        color: white;
    }

    .btn-simpan {
        background-color: #3E6B48; /* calm green */
        color: white;
        border: none;
    }

    .btn-simpan:hover {
        background-color: #2f5237;
        color: white;
    }
</style>

<div class="container">
    <h3>Data Buku</h3>

    {{-- NOTIF ERROR --}}
    @if ($errors->any())
        <div class="alert alert-danger">
            <ul class="mb-0">
                @foreach ($errors->all() as $error)
                    <li>{{ $error }}</li>
                @endforeach
            </ul>
        </div>
    @endif

    {{-- NOTIF SUCCESS --}}
    @if (session('success'))
        <div class="alert alert-success">
            {{ session('success') }}
        </div>
    @endif

    <form action="/buku" method="POST" class="row mb-4">
        @csrf
        <div class="col-md-6">
            <input type="text" name="judul" class="form-control" placeholder="Judul Buku">
        </div>
        <div class="col-md-3">
            <input type="number" name="stok" class="form-control" placeholder="Stok">
        </div>
        <div class="col-md-3">
            <button class="btn btn-simpan w-100">
                Simpan
            </button>
        </div>
    </form>

    <table class="table table-bordered">
        <tr>
            <th>No</th>
            <th>Judul</th>
            <th>Stok</th>
            <th>Aksi</th>
        </tr>

        @foreach ($buku as $item)
        <tr>
            <td>{{ $loop->iteration }}</td>
            <td>{{ $item->judul }}</td>
            <td>{{ $item->stok }}</td>
            <td>
                <a href="/buku/{{ $item->id }}/edit" class="btn btn-edit btn-sm">
                    Edit
                </a>

                <a href="/buku/{{ $item->id }}/hapus"
                   class="btn btn-hapus btn-sm"
                   onclick="return confirm('Hapus buku?')">
                    Hapus
                </a>
            </td>
        </tr>
        @endforeach
    </table>

    <div class="d-flex justify-content-center mt-3">
        {{ $buku->links() }}
    </div>
</div>

@endsection
