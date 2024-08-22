<?php

namespace App\Http\Controllers;

use DB;
use App\Models\User;
use App\Models\Pesan;
use App\Models\Agenda;
use App\Models\Kontak;
use App\Models\Konten;
use App\Models\Jenis_konten;
use Illuminate\Http\Request;

class KontenController extends Controller
{

    public function arsip(Request $request)
    {
        $search = $request->input('search');

        // Join antara tabel kontens dan jenis_kontens
        $kontensQuery = Konten::join('jenis_kontens', 'kontens.jenis_id', '=', 'jenis_kontens.id')
            ->where('kontens.status', 'Tidak Aktif')
            ->select('kontens.*', 'jenis_kontens.jenis'); // Memilih kolom yang diperlukan, termasuk jenis

        if ($search) {
            $kontensQuery->where(function($query) use ($search) {
                $query->where('kontens.judul', 'like', '%' . $search . '%')
                    ->orWhere('kontens.deskripsi', 'like', '%' . $search . '%')
                    ->orWhere('kontens.tgl_publish', 'like', '%' . $search . '%')
                    ->orWhere('kontens.tags', 'like', '%' . $search . '%')
                    ->orWhere('jenis_kontens.jenis', 'like', '%' . $search . '%'); // Mencari juga di kolom jenis
            });
        }

        $kontens = $kontensQuery->latest()->paginate(4);
        $jenis_kontens = Jenis_konten::all();
        // Cek apakah hasil pencarian kosong
        $dataKosong = $kontens->isEmpty();

        return view('admin.arsip.arsipKonten', compact('kontens', 'dataKosong', 'jenis_kontens'));
    }

    public function berita(Request $request)
    {
        $jenis = 'Berita';

        $query = Konten::join('jenis_kontens', 'kontens.jenis_id', '=', 'jenis_kontens.id')
                    ->join('users', 'kontens.admin_id', '=', 'users.id')
                    ->where('jenis_kontens.jenis', $jenis)
                    ->where('kontens.status', 'Aktif')
                    ->select('kontens.*');

        // Jika ada pencarian, tambahkan kondisi pencarian pada query
        if ($request->has('search')) {
            $query->where(function($q) use ($request) {
                $q->where('kontens.judul', 'like', '%'.$request->search.'%')
                  ->orWhere('kontens.deskripsi', 'like', '%'.$request->search.'%')
                  ->orWhere('kontens.tgl_publish', 'like', '%'.$request->search.'%')
                  ->orWhere('kontens.tags', 'like', '%'.$request->search.'%');
            });
        }


        $beritas = $query->paginate(5);
        $dataKosong = $beritas->isEmpty();
        $users = User::all();
        $jenis_kontens = Jenis_konten::all();

        return view('admin.konten.berita', compact('beritas', 'jenis_kontens', 'jenis', 'users', 'dataKosong'));
    }


    public function prestasi(Request $request)
    {
        $jenis = 'Prestasi';

                $query = Konten::join('jenis_kontens', 'kontens.jenis_id', '=', 'jenis_kontens.id')
                    ->join('users', 'kontens.admin_id', '=', 'users.id')
                    ->where('jenis_kontens.jenis', $jenis)
                    ->where('kontens.status', 'Aktif')
                    ->select('kontens.*');

        // Jika ada pencarian, tambahkan kondisi pencarian pada query
        if ($request->has('search')) {
            $query->where(function($q) use ($request) {
                $q->where('kontens.judul', 'like', '%'.$request->search.'%')
                  ->orWhere('kontens.deskripsi', 'like', '%'.$request->search.'%')
                  ->orWhere('kontens.tgl_publish', 'like', '%'.$request->search.'%')
                  ->orWhere('kontens.tags', 'like', '%'.$request->search.'%');
            });
        }


        $prestasis = $query->paginate(5);
        $dataKosong = $prestasis->isEmpty();
        $users = User::all();
        $jenis_kontens = Jenis_konten::all();

        return view('admin.konten.prestasi', compact('prestasis', 'jenis_kontens', 'jenis', 'users', 'dataKosong'));
    }

    public function kegiatan(Request $request)
    {
        $jenis = 'Kegiatan';

                $query = Konten::join('jenis_kontens', 'kontens.jenis_id', '=', 'jenis_kontens.id')
                    ->join('users', 'kontens.admin_id', '=', 'users.id')
                    ->where('jenis_kontens.jenis', $jenis)
                    ->where('kontens.status', 'Aktif')
                    ->select('kontens.*');

        // Jika ada pencarian, tambahkan kondisi pencarian pada query
        if ($request->has('search')) {
            $query->where(function($q) use ($request) {
                $q->where('kontens.judul', 'like', '%'.$request->search.'%')
                  ->orWhere('kontens.deskripsi', 'like', '%'.$request->search.'%')
                  ->orWhere('kontens.tgl_publish', 'like', '%'.$request->search.'%')
                  ->orWhere('kontens.tags', 'like', '%'.$request->search.'%');
            });
        }


        $kegiatans = $query->paginate(5);
        $dataKosong = $kegiatans->isEmpty();
        $users = User::all();
        $jenis_kontens = Jenis_konten::all();

        return view('admin.konten.kegiatan', compact('kegiatans', 'jenis_kontens', 'jenis', 'users', 'dataKosong'));
    }

    public function akreditasi(Request $request)
    {
        $jenis = 'Akreditasi';

                $query = Konten::join('jenis_kontens', 'kontens.jenis_id', '=', 'jenis_kontens.id')
                    ->join('users', 'kontens.admin_id', '=', 'users.id')
                    ->where('jenis_kontens.jenis', $jenis)
                    ->where('kontens.status', 'Aktif')
                    ->select('kontens.*');

        // Jika ada pencarian, tambahkan kondisi pencarian pada query
        if ($request->has('search')) {
            $query->where(function($q) use ($request) {
                $q->where('kontens.judul', 'like', '%'.$request->search.'%')
                  ->orWhere('kontens.deskripsi', 'like', '%'.$request->search.'%')
                  ->orWhere('kontens.tgl_publish', 'like', '%'.$request->search.'%')
                  ->orWhere('kontens.tags', 'like', '%'.$request->search.'%');
            });
        }


        $akreditasis = $query->paginate(5);
        $dataKosong = $akreditasis->isEmpty();
        $users = User::all();
        $jenis_kontens = Jenis_konten::all();

        return view('admin.konten.akreditasi', compact('akreditasis', 'jenis_kontens', 'jenis', 'users', 'dataKosong'));
    }

    public function fasilitas(Request $request)
    {
        $jenis = 'Fasilitas';

                $query = Konten::join('jenis_kontens', 'kontens.jenis_id', '=', 'jenis_kontens.id')
                    ->join('users', 'kontens.admin_id', '=', 'users.id')
                    ->where('jenis_kontens.jenis', $jenis)
                    ->where('kontens.status', 'Aktif')
                    ->select('kontens.*');

        // Jika ada pencarian, tambahkan kondisi pencarian pada query
        if ($request->has('search')) {
            $query->where(function($q) use ($request) {
                $q->where('kontens.judul', 'like', '%'.$request->search.'%')
                  ->orWhere('kontens.deskripsi', 'like', '%'.$request->search.'%')
                  ->orWhere('kontens.tgl_publish', 'like', '%'.$request->search.'%')
                  ->orWhere('kontens.tags', 'like', '%'.$request->search.'%');
            });
        }


        $fasilitass = $query->paginate(5);
        $dataKosong = $fasilitass->isEmpty();
        $users = User::all();
        $jenis_kontens = Jenis_konten::all();

        return view('admin.konten.fasilitas', compact('fasilitass', 'jenis_kontens', 'jenis', 'users', 'dataKosong'));
    }

    public function profil(Request $request)
    {
        $jenis = 'Profil';

                $query = Konten::join('jenis_kontens', 'kontens.jenis_id', '=', 'jenis_kontens.id')
                    ->join('users', 'kontens.admin_id', '=', 'users.id')
                    ->where('jenis_kontens.jenis', $jenis)
                    ->where('kontens.status', 'Aktif')
                    ->select('kontens.*');

        // Jika ada pencarian, tambahkan kondisi pencarian pada query
        if ($request->has('search')) {
            $query->where(function($q) use ($request) {
                $q->where('kontens.judul', 'like', '%'.$request->search.'%')
                  ->orWhere('kontens.deskripsi', 'like', '%'.$request->search.'%')
                  ->orWhere('kontens.tgl_publish', 'like', '%'.$request->search.'%')
                  ->orWhere('kontens.tags', 'like', '%'.$request->search.'%');
            });
        }


        $profils = $query->paginate(5);
        $dataKosong = $profils->isEmpty();
        $users = User::all();
        $jenis_kontens = Jenis_konten::all();

        return view('admin.konten.profil', compact('profils', 'jenis_kontens', 'jenis', 'users', 'dataKosong'));
    }

    public function photo(Request $request)
    {
        $jenis = 'Foto';

        // Inisialisasi query dengan filter jenis konten
        $query = Konten::join('jenis_kontens', 'kontens.jenis_id', '=', 'jenis_kontens.id')
            ->join('users', 'kontens.admin_id', '=', 'users.id')
            ->where('jenis_kontens.jenis', $jenis)
            ->where('kontens.status', 'Aktif') // Filter berdasarkan jenis konten 'Foto'
            ->select('kontens.*');

        // Jika ada pencarian, tambahkan kondisi pencarian pada query
        if ($request->has('search')) {
            $query->where(function($q) use ($request) {
                $q->where('kontens.judul', 'like', '%'.$request->search.'%')
                  ->orWhere('kontens.deskripsi', 'like', '%'.$request->search.'%')
                  ->orWhere('kontens.tgl_publish', 'like', '%'.$request->search.'%')
                  ->orWhere('kontens.tags', 'like', '%'.$request->search.'%');
            });
        }

        // Pagination dan pengambilan data
        $photos = $query->paginate(5);
        $dataKosong = $photos->isEmpty();
        $users = User::all();
        $jenis_kontens = Jenis_konten::all();

        // Return view dengan data yang telah difilter
        return view('admin.konten.photo', compact('photos', 'jenis_kontens', 'jenis', 'users', 'dataKosong'));
    }


    public function video(Request $request)
    {
        $jenis = 'Video';

                $query = Konten::join('jenis_kontens', 'kontens.jenis_id', '=', 'jenis_kontens.id')
                    ->join('users', 'kontens.admin_id', '=', 'users.id')
                    ->where('jenis_kontens.jenis', $jenis)
                    ->where('kontens.status', 'Aktif')
                    ->select('kontens.*');

        // Jika ada pencarian, tambahkan kondisi pencarian pada query
        if ($request->has('search')) {
            $query->where(function($q) use ($request) {
                $q->where('kontens.judul', 'like', '%'.$request->search.'%')
                  ->orWhere('kontens.deskripsi', 'like', '%'.$request->search.'%')
                  ->orWhere('kontens.tgl_publish', 'like', '%'.$request->search.'%')
                  ->orWhere('kontens.tags', 'like', '%'.$request->search.'%');
            });
        }


        $videos = $query->paginate(5);
        $dataKosong = $videos->isEmpty();
        $users = User::all();
        $jenis_kontens = Jenis_konten::all();

        return view('admin.konten.video', compact('videos', 'jenis_kontens', 'jenis', 'users', 'dataKosong'));
    }




        //pengunjung
        public function akreditasiPengunjung(Request $request)
        {
            $jenis = 'Akreditasi';

            $akreditasis = Konten::join('jenis_kontens', 'kontens.jenis_id', '=', 'jenis_kontens.id')
                        ->where('jenis_kontens.jenis', $jenis)
                        ->where('kontens.status', 'Aktif')
                        ->select('kontens.*')->paginate(5);

            $jenis_kontens = Jenis_konten::all();
            $kontaks = Kontak::all();
            $pesans = Pesan::all();

            return view('pengunjung.akreditasi-pengunjung', compact('akreditasis', 'jenis', 'jenis_kontens', 'kontaks', 'pesans'));
        }

        public function fasilitasPengunjung(Request $request)
        {
            $jenis = 'Fasilitas';

            $fasilitass = Konten::join('jenis_kontens', 'kontens.jenis_id', '=', 'jenis_kontens.id')
                        ->where('jenis_kontens.jenis', $jenis)
                        ->where('kontens.status', 'Aktif')
                        ->select('kontens.*')->paginate(5);

            $jenis_kontens = Jenis_konten::all();
            $kontaks = Kontak::all();
            $pesans = Pesan::all();

            return view('pengunjung.fasilitas-pengunjung', compact('fasilitass', 'jenis', 'jenis_kontens', 'kontaks', 'pesans'));
        }

        public function profilPengunjung(Request $request)
        {
            $jenis = 'profil';

            $profils = Konten::join('jenis_kontens', 'kontens.jenis_id', '=', 'jenis_kontens.id')
                        ->where('jenis_kontens.jenis', $jenis)
                        ->where('kontens.status', 'Aktif')
                        ->select('kontens.*')->paginate(5);

            $jenis_kontens = Jenis_konten::all();
            $kontaks = Kontak::all();
            $pesans = Pesan::all();

            // Pisahkan deskripsi dengan tag "Misi" menjadi array
            foreach ($profils as $profil) {
                if ($profil->tags == 'Misi') {
                    $profil->deskripsi = explode('.', $profil->deskripsi);
                }
            }

            foreach ($profils as $profil) {
                if ($profil->tags == 'Prospek Kerja') {
                    $profil->deskripsi = explode(',', $profil->deskripsi);
                }
            }

            return view('pengunjung.profil-pengunjung', compact('profils', 'jenis', 'jenis_kontens', 'kontaks', 'pesans'));
        }

        public function prestasiDosen(Request $request)
        {
            $jenis = 'Prestasi';
            $tags = 'Dosen';

            $prestasis = Konten::join('jenis_kontens', 'kontens.jenis_id', '=', 'jenis_kontens.id')
                        ->where('jenis_kontens.jenis', $jenis)
                        ->where('kontens.status', 'Aktif')
                        ->where('kontens.tags', $tags)
                        ->select('kontens.*')->paginate(5);

            $jenis_kontens = Jenis_konten::all();
            $kontaks = Kontak::all();
            $pesans = Pesan::all();
            $agendas = Agenda::all();


            return view('pengunjung.prestasiDosen', compact('prestasis', 'jenis','tags', 'jenis_kontens', 'kontaks', 'pesans', 'agendas'));
        }


        public function prestasiMhs(Request $request)
        {
            $jenis = 'Prestasi';
            $tags = 'Mahasiswa';

            $prestasis = Konten::join('jenis_kontens', 'kontens.jenis_id', '=', 'jenis_kontens.id')
                        ->where('jenis_kontens.jenis', $jenis)
                        ->where('kontens.status', 'Aktif')
                        ->where('kontens.tags', $tags)
                        ->select('kontens.*')->paginate(5);

            $jenis_kontens = Jenis_konten::all();
            $kontaks = Kontak::all();
            $pesans = Pesan::all();
            $agendas = Agenda::all();


            return view('pengunjung.prestasiMhs', compact('prestasis', 'jenis','tags', 'jenis_kontens', 'kontaks', 'pesans', 'agendas'));
        }

        public function beritaDosen(Request $request)
        {
            $jenis = 'Berita';
            $tags = 'Dosen';

            $beritas = Konten::join('jenis_kontens', 'kontens.jenis_id', '=', 'jenis_kontens.id')
                        ->where('jenis_kontens.jenis', $jenis)
                        ->where('kontens.status', 'Aktif')
                        ->where('kontens.tags', $tags)
                        ->select('kontens.*')->paginate(5);

            $jenis_kontens = Jenis_konten::all();
            $kontaks = Kontak::all();
            $pesans = Pesan::all();
            $agendas = Agenda::all();


            return view('pengunjung.beritaDosen', compact('beritas', 'jenis','tags', 'jenis_kontens', 'kontaks', 'pesans', 'agendas'));
        }


        public function beritaMhs(Request $request)
        {
            $jenis = 'Berita';
            $tags = 'Mahasiswa';

            $beritas = Konten::join('jenis_kontens', 'kontens.jenis_id', '=', 'jenis_kontens.id')
                        ->where('jenis_kontens.jenis', $jenis)
                        ->where('kontens.status', 'Aktif')
                        ->where('kontens.tags', $tags)
                        ->select('kontens.*')->paginate(5);

            $jenis_kontens = Jenis_konten::all();
            $kontaks = Kontak::all();
            $pesans = Pesan::all();
            $agendas = Agenda::all();


            return view('pengunjung.beritaMhs', compact('beritas', 'jenis','tags', 'jenis_kontens', 'kontaks', 'pesans', 'agendas'));
        }


        public function kegiatanDosen(Request $request)
        {
            $jenis = 'Kegiatan';
            $tags = 'Dosen';

            $kegiatans = Konten::join('jenis_kontens', 'kontens.jenis_id', '=', 'jenis_kontens.id')
                        ->where('jenis_kontens.jenis', $jenis)
                        ->where('kontens.status', 'Aktif')
                        ->where('kontens.tags', $tags)
                        ->select('kontens.*')->paginate(5);

            $jenis_kontens = Jenis_konten::all();
            $kontaks = Kontak::all();
            $pesans = Pesan::all();
            $agendas = Agenda::all();


            return view('pengunjung.kegiatanDosen', compact('kegiatans', 'jenis','tags', 'jenis_kontens', 'kontaks', 'pesans', 'agendas'));
        }


        public function kegiatanMhs(Request $request)
        {
            $jenis = 'Kegiatan';
            $tags = 'Mahasiswa';

            $kegiatans = Konten::join('jenis_kontens', 'kontens.jenis_id', '=', 'jenis_kontens.id')
                        ->where('jenis_kontens.jenis', $jenis)
                        ->where('kontens.status', 'Aktif')
                        ->where('kontens.tags', $tags)
                        ->select('kontens.*')->paginate(5);

            $jenis_kontens = Jenis_konten::all();
            $kontaks = Kontak::all();
            $pesans = Pesan::all();
            $agendas = Agenda::all();


            return view('pengunjung.kegiatanMhs', compact('kegiatans', 'jenis','tags', 'jenis_kontens', 'kontaks', 'pesans', 'agendas'));
        }

        public function fotoPengunjung(Request $request)
        {
            $jenis1 = 'Foto';
            $jenis2 = 'Berita';

            $fotos = Konten::join('jenis_kontens', 'kontens.jenis_id', '=', 'jenis_kontens.id')
                        ->where('jenis_kontens.jenis', $jenis1)
                        ->select('kontens.*')->paginate(100);

            $beritas = Konten::join('jenis_kontens', 'kontens.jenis_id', '=', 'jenis_kontens.id')
                        ->where('jenis_kontens.jenis', $jenis2)
                        ->select('kontens.*')->paginate(5);

            $jenis_kontens = Jenis_konten::all();
            $kontaks = Kontak::all();
            $pesans = Pesan::all();
            $agendas = Agenda::all();


            return view('pengunjung.foto-pengunjung', compact('fotos', 'jenis1','jenis2', 'beritas', 'jenis_kontens', 'kontaks', 'pesans', 'agendas'));
        }


        public function videoPengunjung(Request $request)
        {
            $jenis1 = 'Video';
            $jenis2 = 'Berita';

            $videos = Konten::join('jenis_kontens', 'kontens.jenis_id', '=', 'jenis_kontens.id')
                        ->where('jenis_kontens.jenis', $jenis1)
                        ->select('kontens.*')->paginate(5);

            $beritas = Konten::join('jenis_kontens', 'kontens.jenis_id', '=', 'jenis_kontens.id')
                        ->where('jenis_kontens.jenis', $jenis2)
                        ->select('kontens.*')->paginate(5);

            $jenis_kontens = Jenis_konten::all();
            $kontaks = Kontak::all();
            $pesans = Pesan::all();
            $agendas = Agenda::all();


            return view('pengunjung.video-pengunjung', compact('videos', 'jenis1','jenis2', 'beritas', 'jenis_kontens', 'kontaks', 'pesans', 'agendas'));
        }



        public function beritaDetail($id)
        {
            $jenis = 'Berita';

            // Ambil berita berdasarkan ID
            $berita = Konten::join('jenis_kontens', 'kontens.jenis_id', '=', 'jenis_kontens.id')
                            ->where('kontens.id', $id)
                            ->where('jenis_kontens.jenis', $jenis)
                            ->where('kontens.status', 'Aktif')
                            ->select('kontens.*')
                            ->firstOrFail();

            // Data lain yang dibutuhkan
            $beritas = Konten::join('jenis_kontens', 'kontens.jenis_id', '=', 'jenis_kontens.id')
                            ->where('jenis_kontens.jenis', $jenis)
                            ->select('kontens.*')->paginate(5);

            $jenis_kontens = Jenis_konten::all();
            $kontaks = Kontak::all();
            $pesans = Pesan::all();
            $agendas = Agenda::all();

            return view('pengunjung.berita-detail', compact('berita', 'jenis_kontens', 'kontaks', 'pesans', 'agendas', 'beritas'));
        }

        public function prestasiDetail($id)
        {
            $jenis = 'Prestasi';
            $jenis2 = 'Berita';

            // Ambil berita berdasarkan ID
            $prestasi = Konten::join('jenis_kontens', 'kontens.jenis_id', '=', 'jenis_kontens.id')
                            ->where('kontens.id', $id)
                            ->where('jenis_kontens.jenis', $jenis)
                            ->where('kontens.status', 'Aktif')
                            ->select('kontens.*')
                            ->firstOrFail();

            // Data lain yang dibutuhkan
            $beritas = Konten::join('jenis_kontens', 'kontens.jenis_id', '=', 'jenis_kontens.id')
                            ->where('jenis_kontens.jenis', $jenis2)
                            ->select('kontens.*')->paginate(5);

            $jenis_kontens = Jenis_konten::all();
            $kontaks = Kontak::all();
            $pesans = Pesan::all();
            $agendas = Agenda::all();

            return view('pengunjung.prestasi-detail', compact('prestasi', 'jenis_kontens', 'kontaks', 'pesans', 'agendas', 'beritas'));
        }

        public function kegiatanDetail($id)
        {
            $jenis = 'Kegiatan';
            $jenis2 = 'Berita';

            // Ambil berita berdasarkan ID
            $kegiatan = Konten::join('jenis_kontens', 'kontens.jenis_id', '=', 'jenis_kontens.id')
                            ->where('kontens.id', $id)
                            ->where('jenis_kontens.jenis', $jenis)
                            ->where('kontens.status', 'Aktif')
                            ->select('kontens.*')
                            ->firstOrFail();

            // Data lain yang dibutuhkan
            $beritas = Konten::join('jenis_kontens', 'kontens.jenis_id', '=', 'jenis_kontens.id')
                            ->where('jenis_kontens.jenis', $jenis2)
                            ->select('kontens.*')->paginate(5);

            $jenis_kontens = Jenis_konten::all();
            $kontaks = Kontak::all();
            $pesans = Pesan::all();
            $agendas = Agenda::all();

            return view('pengunjung.kegiatan-detail', compact('kegiatan', 'jenis_kontens', 'kontaks', 'pesans', 'agendas', 'beritas'));
        }


}
