<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Manajemen Matkul</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">
    <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@300;400;500;600&display=swap" rel="stylesheet">
    
    <style>
        body {
            font-family: 'Poppins', sans-serif;
            background: linear-gradient(135deg, #f5f7fa 0%, #c3cfe2 100%);
            min-height: 100vh;
            padding-top: 3rem;
        }
        .card { border: none; border-radius: 15px; box-shadow: 0 10px 30px rgba(0,0,0,0.08); }
        .table > :not(caption) > * > * { padding: 1rem 1.5rem; vertical-align: middle; }
        .table-hover tbody tr { transition: all 0.3s ease; }
        .table-hover tbody tr:hover { background-color: #f8f9fa; transform: scale(1.01); box-shadow: 0 5px 15px rgba(0,0,0,0.05); }
        .btn-tambah { background: linear-gradient(135deg, #667eea 0%, #764ba2 100%); border: none; border-radius: 30px; padding: 10px 25px; font-weight: 500; color: white; transition: transform 0.2s; }
        .btn-tambah:hover { transform: translateY(-2px); color: white; box-shadow: 0 5px 15px rgba(118, 75, 162, 0.4); }
        .action-btn { border-radius: 50px; padding: 5px 15px; font-size: 0.85rem; font-weight: 500; }
        
        /* Animasi loading tipis saat mencari */
        #dataContainer { transition: opacity 0.2s; }
        .is-loading { opacity: 0.5; pointer-events: none; }
    </style>
</head>
<body>
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-lg-10">
                
                <div class="d-flex justify-content-between align-items-center mb-4">
                    <h2 class="fw-bold" style="color: #2c3e50;">
                        <i class="fas fa-book-open me-2 text-primary"></i> Data Mata Kuliah
                    </h2>
                    <a href="/matkul/create" class="btn btn-tambah shadow-sm">
                        <i class="fas fa-plus-circle me-1"></i> Tambah Matkul
                    </a>
                </div>

                <div class="row mb-3">
                    <div class="col-md-6">
                        <div class="input-group shadow-sm" style="border-radius: 30px; overflow: hidden;">
                            <span class="input-group-text border-0 bg-white ps-4"><i class="fas fa-search text-muted"></i></span>
                            <input type="text" id="searchInput" class="form-control border-0 py-2" placeholder="Ketik kode atau nama matkul untuk mencari..." autocomplete="off">
                        </div>
                    </div>
                </div>

                <div id="dataContainer">
                    <div class="card overflow-hidden">
                        <div class="table-responsive">
                            <table class="table table-hover mb-0">
                                <thead style="background-color: #f8f9fa; color: #495057;">
                                    <tr>
                                        <th class="border-0 ps-4">Kode Matkul</th>
                                        <th class="border-0">Nama Mata Kuliah</th>
                                        <th class="border-0">Jurusan</th>
                                        <th class="border-0 text-center" width="200px">Aksi</th>
                                    </tr>
                                </thead>
                                <tbody class="border-top-0">
                                    @forelse($matkul as $mk)
                                    <tr>
                                        <td class="ps-4">
                                            <span class="badge bg-light text-dark border"><i class="fas fa-hashtag me-1 text-muted"></i>{{ $mk->kode }}</span>
                                        </td>
                                        <td class="fw-medium" style="color: #34495e;">{{ $mk->nama }}</td>
                                        <td class="text-muted"><i class="fas fa-graduation-cap me-2 opacity-50"></i>{{ $mk->jurusan }}</td>
                                        <td class="text-center">
                                            <a href="/matkul/{{ $mk->id }}/edit" class="btn btn-warning btn-sm action-btn text-dark me-1 shadow-sm">
                                                <i class="fas fa-edit me-1"></i> Edit
                                            </a>
                                            <form action="/matkul/{{ $mk->id }}" method="POST" class="form-delete" data-name="{{ $mk->nama }}" style="display:inline;">
                                                @csrf
                                                @method('DELETE')
                                                <button type="button" class="btn btn-danger btn-sm action-btn shadow-sm btn-delete">
                                                    <i class="fas fa-trash-alt me-1"></i> Hapus
                                                </button>
                                            </form>
                                        </td>
                                    </tr>
                                    @empty
                                    <tr>
                                        <td colspan="4" class="text-center py-5">
                                            <div class="text-muted opacity-50 mb-3"><i class="fas fa-search fa-3x"></i></div>
                                            <h5 class="fw-light">Data tidak ditemukan.</h5>
                                        </td>
                                    </tr>
                                    @endforelse
                                </tbody>
                            </table>
                        </div>
                    </div>
                    <div class="mt-4 d-flex justify-content-between align-items-center">
        <a href="/matkul/cetak" target="_blank" class="btn btn-outline-secondary shadow-sm" style="border-radius: 30px; background-color: white;">
            <i class="fas fa-print me-1"></i> Cetak Laporan
        </a>

        <div>
            {{ $matkul->links() }}
        </div>
    </div>

                    <div class="mt-4 d-flex justify-content-center">
                        {{ $matkul->links() }}
                    </div>
                </div> </div>
        </div>
    </div>

    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>

    <script>
        // 1. Notifikasi Sukses Otomatis
        @if(session('success'))
            Swal.fire({
                icon: 'success',
                title: 'Berhasil!',
                text: '{{ session('success') }}',
                showConfirmButton: false,
                timer: 2500
            });
        @endif

        // 2. Event Listener untuk Pop-up Hapus (Menggunakan teknik Event Delegation)
        document.body.addEventListener('click', function(e) {
            if (e.target.closest('.btn-delete')) {
                e.preventDefault(); 
                const button = e.target.closest('.btn-delete');
                const form = button.closest('.form-delete');
                const namaMatkul = form.getAttribute('data-name');

                Swal.fire({
                    title: 'Apakah Anda Yakin?',
                    text: "Data mata kuliah " + namaMatkul + " akan dihapus permanen!",
                    icon: 'warning',
                    showCancelButton: true,
                    confirmButtonColor: '#e74c3c',
                    cancelButtonColor: '#95a5a6',
                    confirmButtonText: '<i class="fas fa-trash-alt me-1"></i> Ya, hapus!',
                    cancelButtonText: '<i class="fas fa-times me-1"></i> Batal',
                    reverseButtons: true
                }).then((result) => {
                    if (result.isConfirmed) {
                        form.submit();
                    }
                });
            }
        });

        // 3. Script Ajaib untuk LIVE SEARCH
        const searchInput = document.getElementById('searchInput');
        const dataContainer = document.getElementById('dataContainer');

        searchInput.addEventListener('input', function() {
            const keyword = this.value;
            
            // Tambahkan efek loading tipis
            dataContainer.classList.add('is-loading');

            // Ambil data dari server secara diam-diam
            fetch(`/matkul?search=${keyword}`)
                .then(response => response.text())
                .then(html => {
                    // Ubah teks HTML dari server menjadi struktur DOM
                    const parser = new DOMParser();
                    const doc = parser.parseFromString(html, 'text/html');
                    
                    // Ambil isi tabel dan pagination yang baru
                    const newContent = doc.getElementById('dataContainer').innerHTML;
                    
                    // Ganti isi tabel lama dengan yang baru
                    dataContainer.innerHTML = newContent;
                    
                    // Hilangkan efek loading
                    dataContainer.classList.remove('is-loading');
                })
                .catch(error => console.error('Error:', error));
        });
    </script>
</body>
</html>