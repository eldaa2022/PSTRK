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
        $kurikulums = Kurikulum::orderBy('smstr', 'asc');
        $search = $request->input('search');

        if ($search) {
            $kurikulums->where(function($query) use ($search) {
                $query->where('nama_mk', 'like', '%' . $search . '%')
                      ->orWhere('kode_mk', 'like', '%'.$search.'%')
                      ->orWhere('smstr', 'like', '%'.$search.'%')
                      ->orWhere('sks_teori', 'like', '%'.$search.'%')
                      ->orWhere('jam_teori', 'like', '%'.$search.'%')
                      ->orWhere('sks_prak', 'like', '%'.$search.'%')
                      ->orWhere('jam_prak', 'like', '%'.$search.'%');
            });
        }

        $kurikulums = $kurikulums->latest()->paginate(4);

        // Cek apakah hasil pencarian kosong
        $dataKosong = $kurikulums->isEmpty();

        return view('admin.kurikulum.list-kurikulum', compact('kurikulums', 'dataKosong'));
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
