<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Jenis_konten;

class JenisKontenController extends Controller
{
    public function index(Request $request)
    {
        $jenis_kontens = Jenis_konten::orderBy('created_at', 'desc');
        $search = $request->input('search');

        if ($search) {
            $jenis_kontens->where(function($query) use ($search) {
                $query->where('jenis', 'like', '%' . $search . '%');
            });
        }

        $jenis_kontens = $jenis_kontens->latest()->paginate(5);

        // Cek apakah hasil pencarian kosong
        $dataKosong = $jenis_kontens->isEmpty();


        return view('admin.jeniskonten.list-jeniskonten', compact('jenis_kontens', 'dataKosong'));
    }
}
