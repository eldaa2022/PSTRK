<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Pesan;

class PesanController extends Controller
{
    public function index(Request $request)
    {
        $pesans = Pesan::latest()->paginate(5);
        if ($request ->has('search')) {
            $pesans = Pesan::where('isi_pesan', 'like', '%'.$request->search.'%')->paginate(5);
        }
        return view('admin.pesan.list-pesan', compact('pesans'));
    }

    //pengguna
    public function pesanPengunjung(Request $request)
    {

        $pesans = Pesan::all();


        return view('pengunjung.dashboard-pengunjung', compact('pesans'));
    }
}
