<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Kontak;

class KontakController extends Controller
{
    public function index(Request $request)
    {
        $kontaks = Kontak::latest()->paginate(5);
        if ($request ->has('search')) {
            $kontaks = Kontak::where('email', 'like', '%'.$request->search.'%')->paginate(5);
        }
        return view('admin.kontak.list-kontak', compact('kontaks'));
    }
}
