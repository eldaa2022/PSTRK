<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Agenda;

class AgendaController extends Controller
{
    public function index(Request $request)
    {
        $agendas = Agenda::orderBy('tgl_mulai', 'asc');
        $search = $request->input('search');

        if ($search) {
            $agendas->where(function($query) use ($search) {
                $query->where('judul', 'like', '%' . $search . '%')
                      ->orWhere('deskripsi', 'like', '%'.$search.'%')
                      ->orWhere('tgl_mulai', 'like', '%'.$search.'%')
                      ->orWhere('tgl_selesai', 'like', '%'.$search.'%')
                      ->orWhere('tags', 'like', '%'.$search.'%')
                      ->orWhere('lokasi', 'like', '%'.$search.'%')
                      ->orWhere('penyelenggara', 'like', '%'.$search.'%');
            });
        }

        $agendas = $agendas->latest()->paginate(4);

        $dataKosong = $agendas->isEmpty();

        return view('admin.agenda.list-agenda', compact('agendas', 'dataKosong'));
    }
}
