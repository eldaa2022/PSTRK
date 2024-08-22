<?php

namespace App\Http\Controllers;

use Log;
use Exception;
use App\Models\Pesan;
use Illuminate\Http\Request;

class PesanController extends Controller
{
    public function index(Request $request)
    {
        $pesans = Pesan::orderBy('created_at', 'desc');
        $search = $request->input('search');

        if ($search) {
            $pesans->where(function($query) use ($search) {
                $query->where('email', 'like', '%' . $search . '%')
                      ->orWhere('isi_pesan', 'like', '%'.$search.'%')
                      ->orWhere('balasan', 'like', '%'.$search.'%');
            });
        }

        $pesans = $pesans->latest()->paginate(4);

        $dataKosong = $pesans->isEmpty();



        return view('admin.pesan.list-pesan', compact('pesans', 'dataKosong'));
    }


    public function countNewMessages(Request $request)
{
    try {
        $lastCheckTime = $request->input('lastCheckTime');
        $newMessagesCount = Pesan::where('created_at', '>', $lastCheckTime)->count();

        return response()->json([
            'newMessagesCount' => $newMessagesCount
        ]);
    } catch (Exception $e) {
        Log::error('Error counting new messages: ' . $e->getMessage());
        return response()->json([
            'newMessagesCount' => 0,
            'error' => $e->getMessage()
        ], 500);
    }
}





    //pengguna
    public function pesanPengunjung(Request $request)
    {

        $pesans = Pesan::all();


        return view('pengunjung.dashboard-pengunjung', compact('pesans'));
    }
}
