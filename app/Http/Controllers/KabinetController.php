<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Kabinet;

class KabinetController extends Controller
{
    public function index(Request $request)
    {
        $kabinets = Kabinet::latest()->paginate(5);
        if ($request ->has('search')) {
            $kabinets = Kabinet::where('nama', 'like', '%'.$request->search.'%')->paginate(4);
        }
        return view('admin.hima.list-kabinet', compact('kabinets'));
    }
}
