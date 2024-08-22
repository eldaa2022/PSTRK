<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Kabinet;

class KabinetController extends Controller
{
    public function index(Request $request)
    {
        $kabinets = Kabinet::orderBy('nama', 'asc');
        $search = $request->input('search');

        if ($search) {
            $kabinets->where(function($query) use ($search) {
                $query->where('jabatan', 'like', '%' . $search . '%')
                      ->orWhere('departemen', 'like', '%'.$search.'%')
                      ->orWhere('nama', 'like', '%'.$search.'%')
                      ->orWhere('tahun', 'like', '%'.$search.'%');
            });
        }

        $kabinets = $kabinets->latest()->paginate(4);

        $dataKosong = $kabinets->isEmpty();

        return view('admin.hima.list-kabinet', compact('kabinets', 'dataKosong'));
    }
}
