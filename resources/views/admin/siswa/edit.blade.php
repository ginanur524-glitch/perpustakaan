@extends('layouts.app')

@section('content')
    <div class="container">
        <h3>Edit Siswa</h3>

        <form action="/siswa/{{ $siswa->id }}/update" method="POST">
            @csrf

            <div class="mb-3">
                <label>Nama Siswa</label>
                <input type="text" name="nama" class="form-control" value="{{ $siswa->nama }}">
            </div>

            <div class="mb-3">
                <label>Kelas</label>
                <input type="text" name="kelas" class="form-control" value="{{ $siswa->kelas }}">
            </div>

            <button class="btn btn-primary">Update</button>
            <a href="/siswa" class="btn btn-secondary">Kembali</a>
        </form>
    </div>
@endsection