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
        $dosens = Dosen::latest()->paginate(4);

        if ($request ->has('search')) {
            $dosens = Dosen::where('nama', 'like', '%'.$request->search.'%')->paginate(4);
        }

        return view('admin.dosen.list-dosen', compact('dosens'));
    }

    //pengguna
    public function dosenPengunjung(Request $request)
    {

        $dosens = Dosen::all();
        $kontaks = Kontak::all();
        $pesans = Pesan::all();

        return view('pengunjung.dosen-pengunjung', compact('dosens', 'kontaks', 'pesans'));
    }
}
