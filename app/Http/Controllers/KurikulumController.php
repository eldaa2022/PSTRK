<?php

namespace App\Http\Controllers;

use App\Models\Pesan;
use App\Models\Kontak;
use App\Models\Kurikulum;
use Illuminate\Http\Request;

class KurikulumController extends Controller
{
    public function index(Request $request)
    {
        $kurikulums = Kurikulum::latest()->paginate(5);

        if ($request ->has('search')) {
            $kurikulums = Kurikulum::where('nama_mk', 'like', '%'.$request->search.'%')->paginate(5);
        }

        return view('admin.kurikulum.list-kurikulum', compact('kurikulums'));
    }



        //pengguna
        public function kurikulumPengunjung(Request $request)
        {

            $kurikulums = Kurikulum::all();
            $kontaks = Kontak::all();
            $pesans = Pesan::all();

            return view('pengunjung.kurikulum-pengunjung', compact('kurikulums', 'kontaks', 'pesans'));
        }
}
