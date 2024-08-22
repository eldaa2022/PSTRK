<?php

namespace App\Http\Controllers;

use App\Models\Hima;
use App\Models\Pesan;
use App\Models\Kontak;
use App\Models\Kabinet;
use Illuminate\Http\Request;

class HimaController extends Controller
{
    public function index(Request $request)
    {
        $himas = Hima::orderBy('nama', 'asc');
        $search = $request->input('search');

        if ($search) {
            $himas->where(function($query) use ($search) {
                $query->where('sejarah', 'like', '%' . $search . '%')
                      ->orWhere('visi', 'like', '%'.$search.'%')
                      ->orWhere('misi', 'like', '%'.$search.'%')
                      ->orWhere('deskripsi', 'like', '%'.$search.'%');
            });
        }

        $himas = $himas->latest()->paginate(4);

        $dataKosong = $himas->isEmpty();

        return view('admin.hima.list-hima', compact('himas', 'dataKosong'));
    }

    //pengguna
     public function himaPengunjung(Request $request)
     {

         $himas = Hima::all();
         $kontaks = Kontak::all();
         $kabinets = Kabinet::all();
         $pesans = Pesan::all();

         foreach ($himas as $hima) {
            // Pastikan 'misi' tidak kosong sebelum dipecah
            if (!empty($hima->misi)) {
                // Pisahkan misi menjadi array berdasarkan tanda titik
                $hima->misi_list = array_filter(array_map('trim', explode('.', $hima->misi)));
            } else {
                $hima->misi_list = []; // Set ke array kosong jika 'misi' kosong
            }
        }

         return view('pengunjung.hima-pengunjung', compact('himas', 'kontaks', 'kabinets', 'pesans'));
     }
}
