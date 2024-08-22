<?php

namespace App\Http\Controllers\API;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use App\Http\Controllers\Controller;
use App\Models\Kontak;
use App\Http\Resources\ResponseResource;


class KontakController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $kontak = Kontak::latest()->paginate(5);
        return new ResponseResource(true,'list data kontak', $kontak);
    }


    public function store(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'kontak' => 'required',
            'jenis_kontak' => 'required',

        ]);
        if ($validator->fails()) {
            return response()->json($validator->errors(), 422);
        }

        $kontak = Kontak::create([
            'kontak' => $request-> kontak,
            'jenis_kontak' => $request-> jenis_kontak,
        ]);

        return new ResponseResource(true, 'Data Berhasil Ditambahkan!', $kontak);

    }

    /**
     * Display the specified resource.
     */
    public function show($id)
    {
        $kontak = Kontak::whereId($id)->first();

        return new ResponseResource(true, 'Data Berhasil ditemukan!', $kontak);

    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, $id)
    {
        $validator = Validator::make($request->all(), [
            'kontak' => 'required',
            'jenis_kontak' => 'required',

        ]);
        if ($validator->fails()) {
            return response()->json($validator->errors(), 401);
        }
        else{
            $kontak = Kontak::find($id);

            $kontak->update([
                'kontak' => $request-> input('kontak'),
                'jenis_kontak' => $request-> input('jenis_kontak'),

            ]);

            if ($kontak) {
                return new ResponseResource(true, 'Data Berhasil diedit!', $kontak);
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
