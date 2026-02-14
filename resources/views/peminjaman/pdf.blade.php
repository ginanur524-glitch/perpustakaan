<!DOCTYPE html>
<html>
<head>
    <title>Data Peminjaman</title>
    <style>
        body { font-family: sans-serif; }
        table {
            width: 100%;
            border-collapse: collapse;
        }
        table, th, td {
            border: 1px solid black;
        }
        th, td {
            padding: 6px;
            text-align: center;
        }
        h3 {
            text-align: center;
        }
    </style>
</head>
<body>

<h3>Data Peminjaman Buku</h3>

<table>
    <tr>
        <th>No</th>
        <th>Nama Siswa</th>
        <th>Judul Buku</th>
        <th>Tanggal Pinjam</th>
        <th>Tanggal Kembali</th>
        <th>Status</th>
    </tr>

    @foreach($data as $p)
    <tr>
        <td>{{ $loop->iteration }}</td>
        <td>{{ $p->siswa->nama }}</td>
        <td>{{ $p->buku->judul }}</td>
        <td>{{ $p->tanggal_pinjam }}</td>
        <td>{{ $p->tanggal_kembali ?? '-' }}</td>
        <td>{{ ucfirst($p->status) }}</td>
    </tr>
    @endforeach

</table>

</body>
</html>
