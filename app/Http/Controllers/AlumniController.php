<?php

namespace App\Http\Controllers;

use App\Models\User;
use App\Models\Pesan;
use App\Models\Alumni;
use App\Models\Kontak;
use App\Models\Konten;
use App\Models\Jenis_konten;
use Illuminate\Http\Request;

class AlumniController extends Controller
{
    public function index(Request $request)
    {
        $query = Alumni::join('users', 'alumnis.admin_id', '=', 'users.id')
                    ->select('alumnis.*');

        if ($request->has('search')) {
            $query->where('alumnis.nama', 'like', '%'.$request->search.'%')
            ->orWhere('alumnis.pekerjaan', 'like', '%'.$request->search.'%')
            ->orWhere('alumnis.kompetensi', 'like', '%'.$request->search.'%')
            ->orWhere('alumnis.deskripsi', 'like', '%'.$request->search.'%')
            ->orWhere('alumnis.generasi', 'like', '%'.$request->search.'%');
        }

        $alumnis = $query->paginate(5);
        $dataKosong = $alumnis->isEmpty();
        $users = User::all();

        return view('admin.alumni.list-alumni', compact('alumnis', 'users', 'dataKosong'));
    }

    //pengguna
    public function alumniPengunjung(Request $request)
    {
        $jenis2 = 'Berita';

        $beritas = Konten::join('jenis_kontens', 'kontens.jenis_id', '=', 'jenis_kontens.id')
                        ->where('jenis_kontens.jenis', $jenis2)
                        ->select('kontens.*')->paginate(5);

        $jenis_kontens = Jenis_konten::all();

        $alumnis = Alumni::all();
        $kontaks = Kontak::all();
        $pesans = Pesan::all();

        return view('pengunjung.alumni-pengunjung', compact('alumnis', 'kontaks', 'jenis2', 'jenis_kontens','beritas','pesans'));
    }
}
