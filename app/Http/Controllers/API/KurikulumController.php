<?php

namespace App\Http\Controllers\API;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use App\Http\Controllers\Controller;
use App\Models\Kurikulum;
use App\Http\Resources\ResponseResource;


class KurikulumController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $kurikulum = Kurikulum::latest()->paginate(5);
        return new ResponseResource(true,'list data kurikulum', $kurikulum);
    }


    public function store(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'kode_mk' => 'required',
            'nama_mk' => 'required',
            'smstr' => 'required',
            'sks_teori' => 'required',
            'jam_teori' => 'required',
            'sks_prak' => 'required',
            'jam_prak' => 'required',

        ]);
        if ($validator->fails()) {
            return response()->json($validator->errors(), 422);
        }

        $kurikulum = Kurikulum::create([
            'kode_mk' => $request-> kode_mk,
            'nama_mk' => $request-> nama_mk,
            'smstr' => $request-> smstr,
            'sks_teori' => $request-> sks_teori,
            'jam_teori' => $request-> jam_teori,
            'sks_prak' => $request-> sks_prak,
            'jam_prak' => $request-> jam_prak,

        ]);

        return new ResponseResource(true, 'Data Berhasil Ditambahkan!', $kurikulum);

    }

    /**
     * Display the specified resource.
     */
    public function show($id)
    {
        $kurikulum = Kurikulum::whereId($id)->first();

        return new ResponseResource(true, 'Data Berhasil ditemukan!', $kurikulum);

    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, $id)
    {
        $validator = Validator::make($request->all(), [
            'kode_mk' => 'required',
            'nama_mk' => 'required',
            'smstr' => 'required',
            'sks_teori' => 'required',
            'jam_teori' => 'required',
            'sks_prak' => 'required',
            'jam_prak' => 'required',

        ]);
        if ($validator->fails()) {
            return response()->json($validator->errors(), 401);
        }

        else{
            $kurikulum = Kurikulum::find($id);

            $kurikulum->update([
                'kode_mk' => $request-> input('kode_mk'),
                'nama_mk' => $request-> input('nama_mk'),
                'smstr' => $request-> input('smstr'),
                'sks_teori' => $request-> input('sks_teori'),
                'jam_teori' => $request-> input('jam_teori'),
                'sks_prak' => $request-> input('sks_prak'),
                'jam_prak' => $request-> input('jam_prak'),
               
            ]);

            if ($kurikulum) {
                return new ResponseResource(true, 'Data Berhasil diedit!', $kurikulum);
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
