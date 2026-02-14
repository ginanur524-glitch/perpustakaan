@extends('layouts.app')

@section('content')
<div class="container">
    <h3 class="mb-4">Katalog Buku Perpustakaan</h3>

    {{-- Form Pencarian --}}
    <form action="/search" method="GET" class="mb-3">
        <div class="row">
            <div class="col-md-9">
                <input 
                    type="text" 
                    name="keyword" 
                    class="form-control" 
                    placeholder="Cari judul buku"
                    value="{{ request('keyword') }}"
                >
            </div>
            <div class="col-md-3">
                <button class="btn btn-primary w-100">
                    Cari
                </button>
            </div>
        </div>
    </form>

    {{-- Tabel Buku --}}
    <table class="table table-bordered">
        <thead>
            <tr>
                <th width="50">No</th>
                <th>Judul Buku</th>
                <th width="100">Stok</th>
            </tr>
        </thead>
        <tbody>
            @forelse ($buku as $item)
                <tr>
                    <td>{{ $loop->iteration }}</td>
                    <td>{{ $item->judul }}</td>
                    <td>{{ $item->stok }}</td>
                </tr>
            @empty
                <tr>
                    <td colspan="3" class="text-center">
                        Data buku tidak ditemukan
                    </td>
                </tr>
            @endforelse
        </tbody>
    </table>
</div>
@endsection
