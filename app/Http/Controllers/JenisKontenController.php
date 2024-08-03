<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Jenis_konten;

class JenisKontenController extends Controller
{
    public function index(Request $request)
    {
        $jenis_kontens = Jenis_konten::latest()->paginate(5);
        if ($request ->has('search')) {
            $jenis_kontens = Jenis_konten::where('jenis', 'like', '%'.$request->search.'%')->paginate(5);
        }
        return view('admin.jeniskonten.list-jeniskonten', compact('jenis_kontens'));
    }
}
