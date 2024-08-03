<?php

namespace App\Http\Controllers\API;

use App\Models\Jenis_konten;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use App\Http\Controllers\Controller;
use App\Http\Resources\ResponseResource;

class JenisKontenController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $jenis_konten = Jenis_konten::latest()->paginate(5);
        return new ResponseResource(true,'list data kontak', $jenis_konten);
    }


    public function store(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'jenis' => 'required',
        ]);
        if ($validator->fails()) {
            return response()->json($validator->errors(), 422);
        }

        $jenis_konten = Jenis_konten::create([
            'jenis' => $request-> jenis,

        ]);

        return new ResponseResource(true, 'Data Berhasil Ditambahkan!', $jenis_konten);

    }

    /**
     * Display the specified resource.
     */
    public function show($id)
    {
        $jenis_konten = Jenis_konten::whereId($id)->first();

        return new ResponseResource(true, 'Data Berhasil ditemukan!', $jenis_konten);

    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, $id)
    {
        $validator = Validator::make($request->all(), [
            'jenis' => 'required',

        ]);
        if ($validator->fails()) {
            return response()->json($validator->errors(), 401);
        }

        else{
            $jenis_konten = Jenis_konten::find($id);

            $jenis_konten->update([
                'jenis' => $request-> input('jenis'),

            ]);

            if ($jenis_konten) {
                return new ResponseResource(true, 'Data Berhasil diedit!', $jenis_konten);
            } else {
                return response()->json($validator->errors(), 401);
            }
        }
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        //
    }
}
