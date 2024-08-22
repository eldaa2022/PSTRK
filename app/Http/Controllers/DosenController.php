<?php

namespace App\Http\Controllers;

use App\Models\Dosen;
use App\Models\Pesan;
use App\Models\Kontak;
use Illuminate\Http\Request;

class DosenController extends Controller
{
    public function index(Request $request)
    {
        $search = $request->input('search');
        $dosensQuery = Dosen::where('status', 'Aktif');

        if ($search) {
            $dosensQuery->where(function($query) use ($search) {
                $query->where('nama', 'like', '%' . $search . '%')
                    ->orWhere('nip', 'like', '%' . $search . '%')
                    ->orWhere('email', 'like', '%' . $search . '%')
                    ->orWhere('kompetensi', 'like', '%' . $search . '%')
                    ->orWhere('matkul', 'like', '%' . $search . '%');
            });
        }

        $dosens = $dosensQuery->latest()->paginate(4);

        // Cek apakah hasil pencarian kosong
        $dataKosong = $dosens->isEmpty();

        return view('admin.dosen.list-dosen', compact('dosens', 'dataKosong'));
    }

    public function arsip(Request $request)
    {
        $search = $request->input('search');
        $dosensQuery = Dosen::where('status', 'Tidak Aktif');

        if ($search) {
            $dosensQuery->where(function($query) use ($search) {
                $query->where('nama', 'like', '%' . $search . '%')
                    ->orWhere('nip', 'like', '%' . $search . '%')
                    ->orWhere('email', 'like', '%' . $search . '%')
                    ->orWhere('kompetensi', 'like', '%' . $search . '%')
                    ->orWhere('matkul', 'like', '%' . $search . '%');
            });
        }

        $dosens = $dosensQuery->latest()->paginate(4);

        // Cek apakah hasil pencarian kosong
        $dataKosong = $dosens->isEmpty();

        return view('admin.arsip.arsipDosen', compact('dosens', 'dataKosong'));
    }





    //pengguna
    public function dosenPengunjung(Request $request)
    {
        $dosens = Dosen::where('status', 'Aktif')->get(); // Hanya ambil dosen dengan status 'Aktif'
        $kontaks = Kontak::all();
        $pesans = Pesan::all();

        return view('pengunjung.dosen-pengunjung', compact('dosens', 'kontaks', 'pesans'));
    }

}
