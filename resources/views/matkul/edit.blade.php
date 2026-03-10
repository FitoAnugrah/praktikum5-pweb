<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Edit Matkul</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">
    <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@300;400;500;600&display=swap" rel="stylesheet">
    
    <style>
        body {
            font-family: 'Poppins', sans-serif;
            background: linear-gradient(135deg, #f5f7fa 0%, #c3cfe2 100%);
            min-height: 100vh;
            display: flex;
            align-items: center;
        }
        .card {
            border: none;
            border-radius: 20px;
            box-shadow: 0 15px 35px rgba(0,0,0,0.1);
            overflow: hidden;
        }
        .card-header {
            /* Warna gradien kita bedakan sedikit (kuning/orange) agar jelas ini halaman Edit */
            background: linear-gradient(135deg, #f6d365 0%, #fda085 100%);
            padding: 25px;
            border-bottom: none;
        }
        .form-control {
            border-radius: 10px;
            padding: 12px 15px;
            border: 1px solid #e1e5eb;
            background-color: #f8f9fa;
        }
        .form-control:focus {
            box-shadow: 0 0 0 3px rgba(253, 160, 133, 0.2);
            border-color: #fda085;
            background-color: #ffffff;
        }
        .input-group-text {
            background-color: #f8f9fa;
            border: 1px solid #e1e5eb;
            border-radius: 10px 0 0 10px;
        }
        .btn-custom {
            border-radius: 10px;
            padding: 12px;
            font-weight: 500;
            letter-spacing: 0.5px;
            transition: all 0.3s ease;
        }
        .btn-update {
            background: linear-gradient(135deg, #f6d365 0%, #fda085 100%);
            border: none;
            color: white;
        }
        .btn-update:hover {
            box-shadow: 0 8px 20px rgba(253, 160, 133, 0.3);
            transform: translateY(-2px);
            color: white;
        }
    </style>
</head>
<body>
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-md-7 col-lg-6">
                
                <div class="card">
                    <div class="card-header text-center">
                        <h4 class="mb-0 text-white fw-semibold">
                            <i class="fas fa-edit me-2"></i>Edit Data Mata Kuliah
                        </h4>
                    </div>
                    
                    <div class="card-body p-4 p-md-5">
                        <form action="/matkul/{{ $matkul->id }}" method="POST">
                            @csrf
                            @method('PUT')
                            
                            <div class="mb-4">
                                <label class="form-label text-muted fw-medium small text-uppercase tracking-wider">Kode Mata Kuliah</label>
                                <div class="input-group">
                                    <span class="input-group-text border-end-0"><i class="fas fa-barcode text-muted"></i></span>
                                    <input type="text" name="kode" value="{{ $matkul->kode }}" class="form-control border-start-0 ps-0" required>
                                </div>
                            </div>

                            <div class="mb-4">
                                <label class="form-label text-muted fw-medium small text-uppercase tracking-wider">Nama Mata Kuliah</label>
                                <div class="input-group">
                                    <span class="input-group-text border-end-0"><i class="fas fa-book text-muted"></i></span>
                                    <input type="text" name="nama" value="{{ $matkul->nama }}" class="form-control border-start-0 ps-0" required>
                                </div>
                            </div>

                            <div class="mb-5">
                                <label class="form-label text-muted fw-medium small text-uppercase tracking-wider">Jurusan</label>
                                <div class="input-group">
                                    <span class="input-group-text border-end-0"><i class="fas fa-graduation-cap text-muted"></i></span>
                                    <input type="text" name="jurusan" value="{{ $matkul->jurusan }}" class="form-control border-start-0 ps-0" required>
                                </div>
                            </div>

                            <div class="d-flex gap-3">
                                <a href="/matkul" class="btn btn-light btn-custom w-50 border shadow-sm">
                                    <i class="fas fa-arrow-left me-2"></i>Batal
                                </a>
                                <button type="submit" class="btn btn-update btn-custom w-50 shadow">
                                    <i class="fas fa-sync-alt me-2"></i>Update Data
                                </button>
                            </div>
                            
                        </form>
                    </div>
                </div>
                
            </div>
        </div>
    </div>
</body>
</html>