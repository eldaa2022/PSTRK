<?php

namespace App\Http\Controllers\API;

use App\Models\Alumni;
use App\Models\User;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Storage;
use App\Http\Resources\ResponseResource;
use Illuminate\Support\Facades\Validator;

class AlumniController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $alumni = Alumni::latest()->paginate(5);
        return new ResponseResource(true,'list data pesan', $alumni);
    }


    public function store(Request $request, Alumni $alumni)
    {
        $validator = Validator::make($request->all(), [
            'nama' => 'required',
            'generasi' => 'required',
            'pekerjaan' => 'required',
            'deskripsi' => 'required',
            'kompetensi' => 'required',
            'foto' => 'required|image|mimes:png,jpg, jpeg,svg|max:2048',
            'admin_id' => 'required',
        ]);
        if ($validator->fails()) {
            return response()->json($validator->errors(), 422);
        }

        $foto = $request->file('foto');
        $foto->storeAs('public/foto', $foto->hashName());

        $alumni = Alumni::create([
            'nama' => $request-> nama,
            'generasi' => $request-> generasi,
            'pekerjaan' => $request-> pekerjaan,
            'deskripsi' => $request-> deskripsi,
            'kompetensi' => $request-> kompetensi,
            'foto' => $foto-> hashName(),
            'admin_id' => $request-> admin_id
        ]);

        return new ResponseResource(true, 'Data Berhasil Ditambahkan!', $alumni);

    }


    /**
     * Display the specified resource.
     */
    public function show($id)
    {
        $alumni = Alumni::whereId($id)->first();

        return new ResponseResource(true, 'Data Berhasil ditemukan!', $alumni);

    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, $id)
    {
        $validator = Validator::make($request->all(), [
            'nama' => 'required',
            'generasi' => 'required',
            'pekerjaan' => 'required',
            'deskripsi' => 'required',
            'kompetensi' => 'required',
        ]);

        if ($validator->fails()) {
            return response()->json($validator->errors(), 401);
        }

        $alumni = Alumni::find($id);

        if ($request->hasFile('foto')) {

            $foto = $request->file('foto');
            $foto->storeAs('public/foto', $foto->hashName());

            Storage::delete('public/foto/'.basename($alumni->foto));

                // Update alumni data with new photo
                $alumni->update([
                    'nama' => $request->input('nama'),
                    'generasi' => $request->input('generasi'),
                    'pekerjaan' => $request->input('pekerjaan'),
                    'deskripsi' => $request->input('deskripsi'),
                    'kompetensi' => $request->input('kompetensi'),
                    'foto' => $foto->hashName(),
                ]);
            } else {
                // Update alumni data without changing photo
                $alumni->update([
                    'nama' => $request->input('nama'),
                    'generasi' => $request->input('generasi'),
                    'pekerjaan' => $request->input('pekerjaan'),
                    'deskripsi' => $request->input('deskripsi'),
                    'kompetensi' => $request->input('kompetensi'),


                ]);
            }

            return response()->json(['success' => true, 'message' => 'Data Berhasil diedit!', 'data' => $alumni]);
    }


    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        //
    }
}
