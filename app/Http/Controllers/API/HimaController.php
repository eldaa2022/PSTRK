<?php

namespace App\Http\Controllers\API;

use App\Models\Hima;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Storage;
use App\Http\Resources\ResponseResource;
use Illuminate\Support\Facades\Validator;

class HimaController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $hima = Hima::latest()->paginate(5);
        return new ResponseResource(true,'list data kontak', $hima);
    }


    public function store(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'nama' => 'required',
            'sejarah' => 'required',
            'visi' => 'required',
            'misi' => 'required',
            'deskripsi' => 'required',
            'foto' => 'required|image|mimes:png,jpg, jpeg,svg|max:2048', // untuk poto
            'admin_id' => 'required',
        ]);
        if ($validator->fails()) {
            return response()->json($validator->errors(), 422);
        }

        $foto = $request->file('foto');
        $foto->storeAs('public/foto', $foto->hashName());

        $hima = Hima::create([
            'nama' => $request-> nama,
            'sejarah' => $request-> sejarah,
            'visi' => $request-> visi,
            'misi' => $request-> misi,
            'deskripsi' => $request-> deskripsi,
            'foto' => $foto-> hashName(),
            'admin_id' => $request-> admin_id
        ]);

        return new ResponseResource(true, 'Data Berhasil Ditambahkan!', $hima);

    }

    /**
     * Display the specified resource.
     */
    public function show($id)
    {
        $hima = Hima::whereId($id)->first();

        return new ResponseResource(true, 'Data Berhasil ditemukan!', $hima);

    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, $id)
    {
        $validator = Validator::make($request->all(), [
            'nama' => 'required',
            'sejarah' => 'required',
            'visi' => 'required',
            'misi' => 'required',
            'deskripsi' => 'required',
            // 'foto' => 'image|mimes:png,jpg, jpeg,svg|max:2048', // untuk poto

        ]);
        if ($validator->fails()) {
            return response()->json($validator->errors(), 401);
        }

        $hima = Hima::find($id);

        if ($request->hasFile('foto')) {

            $foto = $request->file('foto');
            $foto->storeAs('public/foto', $foto->hashName());

            Storage::delete('public/foto/'.basename($hima->foto));

                // Update hima data with new photo
                $hima->update([
                    'nama' => $request-> input('nama'),
                    'sejarah' => $request-> input('sejarah'),
                    'visi' => $request-> input('visi'),
                    'misi' => $request-> input('misi'),
                    'deskripsi' => $request-> input('deskripsi'),
                    'foto' => $foto->hashName(),
                ]);
            } else {
                // Update hima data without changing photo
                $hima->update([
                    'nama' => $request-> input('nama'),
                    'sejarah' => $request-> input('sejarah'),
                    'visi' => $request-> input('visi'),
                    'misi' => $request-> input('misi'),
                    'deskripsi' => $request-> input('deskripsi'),
                ]);
            }

            return response()->json(['success' => true, 'message' => 'Data Berhasil diedit!', 'data' => $hima]);

    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        //
    }
}
