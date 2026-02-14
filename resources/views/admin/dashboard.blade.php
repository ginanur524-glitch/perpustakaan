@extends('layouts.app')

@section('content')

<style>
    /* ===== CARD STATISTIK ===== */
    .card-buku {
        background-color: #2C7A7B;
        color: white;
    }

    .card-siswa {
        background-color: #4C5C96;
        color: white;
    }

    .card-peminjaman {
        background-color: #C08457;
        color: white;
    }

    /* ===== MENU DASHBOARD ===== */
    .menu-card {
        border: none;
        border-radius: 15px;
        transition: 0.3s;
        background-color: #EFE1CF;
    }

    .menu-card:hover {
        transform: translateY(-6px);
        box-shadow: 0 12px 25px rgba(0,0,0,0.15);
        background-color: #E5D3BD;
    }

    .menu-icon {
        font-size: 45px;
    }

    .menu-link {
        text-decoration: none;
        color: #5A3E2B;
        font-weight: 600;
    }

    .menu-link:hover {
        color: #3E2A1F;
    }
</style>

<div class="container">
    <h3 class="fw-bold mb-4">Dashboard Admin</h3>

    <!-- ===== CARD STATISTIK ===== -->
    <div class="row g-4">
        <div class="col-md-4">
            <div class="card shadow border-0 rounded-4 card-buku">
                <div class="card-body text-center">
                    <div class="mb-2 fs-1">📚</div>
                    <h6>Total Buku</h6>
                    <h2 class="fw-bold">{{ $totalBuku }}</h2>
                </div>
            </div>
        </div>

        <div class="col-md-4">
            <div class="card shadow border-0 rounded-4 card-siswa">
                <div class="card-body text-center">
                    <div class="mb-2 fs-1">👨‍🎓</div>
                    <h6>Total Siswa</h6>
                    <h2 class="fw-bold">{{ $totalSiswa }}</h2>
                </div>
            </div>
        </div>

        <div class="col-md-4">
            <div class="card shadow border-0 rounded-4 card-peminjaman">
                <div class="card-body text-center">
                    <div class="mb-2 fs-1">🔄</div>
                    <h6>Peminjaman Aktif</h6>
                    <h2 class="fw-bold">{{ $peminjamanAktif }}</h2>
                </div>
            </div>
        </div>
    </div>

    <!-- ===== MENU DASHBOARD ===== -->
    <div class="row mt-5 g-4">

        <div class="col-md-4">
            <a href="/buku" class="menu-link">
                <div class="card menu-card shadow-sm text-center p-4">
                    <div class="menu-icon mb-3">📚</div>
                    <h5>Kelola Buku</h5>
                    <small>Tambah, edit, dan hapus data buku</small>
                </div>
            </a>
        </div>

        <div class="col-md-4">
            <a href="/siswa" class="menu-link">
                <div class="card menu-card shadow-sm text-center p-4">
                    <div class="menu-icon mb-3">👨‍🎓</div>
                    <h5>Kelola Siswa</h5>
                    <small>Manajemen data siswa</small>
                </div>
            </a>
        </div>

        <div class="col-md-4">
            <a href="/peminjaman" class="menu-link">
                <div class="card menu-card shadow-sm text-center p-4">
                    <div class="menu-icon mb-3">🔄</div>
                    <h5>Peminjaman Buku</h5>
                    <small>Kelola transaksi peminjaman</small>
                </div>
            </a>
        </div>

    </div>

</div>

@endsection
