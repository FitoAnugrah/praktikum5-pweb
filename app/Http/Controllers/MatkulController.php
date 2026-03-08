<?php

namespace App\Http\Controllers;

use App\Models\Matkul;
use Illuminate\Http\Request;

class MatkulController extends Controller
{
    public function index()
    {
        // Mengambil semua data matkul dari database
        $matkul = Matkul::all();
        
        // Mengirim data ke view
        return view('matkul.index', compact('matkul'));
    }
}