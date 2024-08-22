<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Kontak;

class KontakController extends Controller
{
    public function index(Request $request)
    {
        $kontaks = Kontak::orderBy('created_at', 'desc');
        $search = $request->input('search');

        if ($search) {
            $kontaks->where(function($query) use ($search) {
                $query->where('kontak', 'like', '%' . $search . '%')
                      ->orWhere('jenis_kontak', 'like', '%'.$search.'%');
            });
        }

        $kontaks = $kontaks->latest()->paginate(4);

        // Cek apakah hasil pencarian kosong
        $dataKosong = $kontaks->isEmpty();

        return view('admin.kontak.list-kontak', compact('kontaks', 'dataKosong'));
    }
}
