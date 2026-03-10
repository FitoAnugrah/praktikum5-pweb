<?php

namespace App\Http\Controllers;

use App\Models\Matkul;
use Illuminate\Http\Request;

class MatkulController extends Controller
{
    public function index(Request $request)
    {
        // Menangkap teks pencarian dari kotak input
        $search = $request->search;

        // Mengambil data berdasarkan pencarian, dan dibatasi 5 data per halaman
        $matkul = Matkul::where('nama', 'LIKE', '%' . $search . '%')
                        ->orWhere('kode', 'LIKE', '%' . $search . '%')
                        ->paginate(5); // Angka 5 bisa kamu ganti sesuai selera
        
        return view('matkul.index', compact('matkul'));
    }
    public function create()
    {
        // Menampilkan form tambah data
        return view('matkul.create');
    }

    public function store(Request $request)
    {
        // 1. Proses Validasi
        $request->validate([
            'kode' => 'required|unique:matkuls,kode',
            'nama' => 'required',
            'jurusan' => 'required'
        ], [
            'kode.required' => 'Kode Matkul tidak boleh kosong!',
            'kode.unique' => 'Ups! Kode Matkul ini sudah terdaftar di sistem.',
            'nama.required' => 'Nama Matkul wajib diisi!',
            'jurusan.required' => 'Jurusan wajib diisi!'
        ]);

        // 2. Simpan Data jika lolos validasi
        Matkul::create($request->all());
        
        return redirect('/matkul')->with('success', 'Data Mata Kuliah berhasil ditambahkan!');
    }
    public function edit($id)
    {
        // Mencari data matkul berdasarkan ID
        $matkul = Matkul::find($id);
        
        // Mengirim data ke halaman form edit
        return view('matkul.edit', compact('matkul'));
    }

    public function update(Request $request, $id)
    {
        $request->validate([
            'kode' => 'required|unique:matkuls,kode,'.$id,
            'nama' => 'required',
            'jurusan' => 'required'
        ], [
            'kode.required' => 'Kode Matkul tidak boleh kosong!',
            'kode.unique' => 'Ups! Kode Matkul ini sudah dipakai matkul lain.',
            'nama.required' => 'Nama Matkul wajib diisi!',
            'jurusan.required' => 'Jurusan wajib diisi!'
        ]);

        $matkul = Matkul::find($id);
        $matkul->update($request->all());
        
        return redirect('/matkul')->with('success', 'Data Mata Kuliah berhasil diperbarui!');
    }
    public function destroy($id)
    {
        Matkul::destroy($id);
        // Tambahkan with() untuk mengirim pesan sukses
        return redirect('/matkul')->with('success', 'Data Mata Kuliah berhasil dihapus!');
    }
    public function cetak()
    {
        $matkul = Matkul::all();
        return view('matkul.cetak', compact('matkul'));
    }
    
}