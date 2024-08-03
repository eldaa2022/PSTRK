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
        $himas = Hima::latest()->paginate(5);
        if ($request ->has('search')) {
            $himas = Hima::where('sejarah', 'like', '%'.$request->search.'%')->paginate(5);
        }
        return view('admin.hima.list-hima', compact('himas'));
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
