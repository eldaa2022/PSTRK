<?php

namespace App\Http\Controllers\API;

use App\Models\Konten;
use App\Models\User;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Storage;
use App\Http\Resources\ResponseResource;
use Illuminate\Support\Facades\Validator;
use Illuminate\Foundation\Http\Middleware\ValidatePostSize;


class KontenController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $konten = Konten::latest()->paginate(5);
        return new ResponseResource(true,'list data kontak', $konten);
    }


    public function store(Request $request)
{
    $validator = Validator::make($request->all(), [
        'judul' => 'required',
        'deskripsi' => 'nullable',
        'tgl_publish' => 'required',
        'tags' => 'required',
        'status' => 'required',
        'lampiran' => 'sometimes|mimes:png,jpg,jpeg,svg,mp4,mov,ogg,qt|max:50000', // untuk foto dan video
        'admin_id' => 'required',
        'jenis_id' => 'required',
    ]);

    if ($validator->fails()) {
        return response()->json($validator->errors(), 422);
    }

    $kontenData = [
        'judul' => $request->judul,
        'deskripsi' => $request->deskripsi,
        'tgl_publish' => $request->tgl_publish,
        'tags' => $request->tags,
        'status' => $request->status,
        'admin_id' => $request->admin_id,
        'jenis_id' => $request->jenis_id,
    ];

    if ($request->hasFile('lampiran')) {
        $lampiran = $request->file('lampiran');
        $extension = $lampiran->getClientOriginalExtension();

        if (in_array($extension, ['png', 'jpg', 'jpeg', 'svg'])) {
            $lampiran->storeAs('public/foto', $lampiran->hashName());
        } elseif (in_array($extension, ['mp4', 'mov', 'ogg', 'qt'])) {
            $lampiran->storeAs('public/video', $lampiran->hashName());
        }

        $kontenData['lampiran'] = $lampiran->hashName();
    }

    $konten = Konten::create($kontenData);

    return new ResponseResource(true, 'Data Berhasil Ditambahkan!', $konten);
}


    /**
     * Display the specified resource.
     */
    public function show($id)
    {
        $konten = Konten::whereId($id)->first();

        return new ResponseResource(true, 'Data Berhasil ditemukan!', $konten);

    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, $id)
{
    $validator = Validator::make($request->all(), [
        'judul' => 'required',
        'deskripsi' => 'nullable',
        'tgl_publish' => 'required',
        'tags' => 'required',
        'status' => 'required',
        'jenis_id' => 'required|exists:jenis_kontens,id' // Ensure jenis_id exists in jenis_kontens table
    ]);

    if ($validator->fails()) {
        return response()->json($validator->errors(), 401);
    }

    $konten = Konten::find($id);
    if (!$konten) {
        return response()->json(['error' => 'Konten not found'], 404);
    }

    $kontenData = [
        'judul' => $request->judul,
        'deskripsi' => $request->deskripsi,
        'tgl_publish' => $request->tgl_publish,
        'tags' => $request->tags,
        'status' => $request->status,
        'jenis_id' => $request->jenis_id,
    ];

    if ($request->hasFile('lampiran')) {
        $lampiran = $request->file('lampiran');
        $extension = $lampiran->getClientOriginalExtension();

        if (in_array($extension, ['png', 'jpg', 'jpeg', 'svg'])) {
            $lampiran->storeAs('public/foto', $lampiran->hashName());
            Storage::delete('public/foto/' . basename($konten->lampiran));
        } elseif (in_array($extension, ['mp4', 'mov', 'ogg', 'qt'])) {
            $lampiran->storeAs('public/video', $lampiran->hashName());
            Storage::delete('public/video/' . basename($konten->lampiran));
        }

        $kontenData['lampiran'] = $lampiran->hashName();
    }

    $konten->update($kontenData);

    return response()->json(['success' => true, 'message' => 'Data Berhasil diedit!', 'data' => $konten]);
}


    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        //
    }
}

