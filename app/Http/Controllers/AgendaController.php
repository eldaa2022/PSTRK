<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Agenda;

class AgendaController extends Controller
{
    public function index(Request $request)
    {
        $agendas = Agenda::latest()->paginate(5);
        if ($request ->has('search')) {
            $agendas = Agenda::where('judul', 'like', '%'.$request->search.'%')->paginate(5);
        }

        return view('admin.agenda.list-agenda', compact('agendas'));
    }
}
