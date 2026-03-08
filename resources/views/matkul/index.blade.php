<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <title>Data Matkul</title>
</head>
<body>
    <h1>Daftar Matkul</h1>
    <table border="1" cellpadding="10">
        <thead>
            <tr>
                <th>Kode</th>
                <th>Nama</th>
                <th>Jurusan</th>
            </tr>
        </thead>
        <tbody>
            @forelse($matkul as $mk)
            <tr>
                <td>{{ $mk->kode }}</td>
                <td>{{ $mk->nama }}</td>
                <td>{{ $mk->jurusan }}</td>
            </tr>
            @empty
            <tr>
                <td colspan="3">Belum ada data matkul.</td>
            </tr>
            @endforelse
        </tbody>
    </table>
</body>
</html>