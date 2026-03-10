<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Cetak Laporan Mata Kuliah</title>
    <style>
        body { font-family: Arial, sans-serif; margin: 40px; }
        .header { text-align: center; margin-bottom: 30px; border-bottom: 2px solid #000; padding-bottom: 10px; }
        table { width: 100%; border-collapse: collapse; margin-top: 20px; }
        th, td { border: 1px solid #000; padding: 10px; text-align: left; }
        th { background-color: #f2f2f2; }
        .footer { margin-top: 50px; text-align: right; }
    </style>
</head>
<body>
    <div class="header">
        <h2>LAPORAN DATA MATA KULIAH</h2>
        <p>Universitas Siliwangi - Tasikmalaya</p>
    </div>

    <table>
        <thead>
            <tr>
                <th width="5%">No</th>
                <th width="20%">Kode Matkul</th>
                <th>Nama Mata Kuliah</th>
                <th width="30%">Jurusan</th>
            </tr>
        </thead>
        <tbody>
            @foreach($matkul as $index => $mk)
            <tr>
                <td style="text-align: center;">{{ $index + 1 }}</td>
                <td>{{ $mk->kode }}</td>
                <td>{{ $mk->nama }}</td>
                <td>{{ $mk->jurusan }}</td>
            </tr>
            @endforeach
        </tbody>
    </table>

    <div class="footer">
        <p>Tasikmalaya, {{ date('d F Y') }}</p>
        <br><br><br>
        <p><strong>Administrator</strong></p>
    </div>

    <script>
        window.print();
    </script>
</body>
</html>