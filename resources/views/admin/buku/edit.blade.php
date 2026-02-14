@extends('layouts.app')

@section('content')
    <div class="container">
        <h3>Edit Buku</h3>

        <form action="/buku/{{ $buku->id }}/update" method="POST">
            @csrf

            <div class="mb-3">
                <label>Judul Buku</label>
                <input type="text" name="judul" class="form-control" value="{{ $buku->judul }}">
            </div>

            <div class="mb-3">
                <label>Stok</label>
                <input type="number" name="stok" class="form-control" value="{{ $buku->stok }}">
            </div>

            <button class="btn btn-primary">Update</button>
            <a href="/buku" class="btn btn-secondary">Kembali</a>
        </form>
    </div>
@endsection
