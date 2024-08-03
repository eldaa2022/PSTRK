<?php

namespace App\Http\Controllers\API;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use App\Http\Controllers\Controller;
use App\Models\Faq;
use App\Models\User;
use App\Http\Resources\ResponseResource;


class FaqController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $faq = Faq::latest()->paginate(5);
        return new ResponseResource(true,'list data faq', $faq);
    }


    public function store(Request $request, Faq $faq)
    {
        $validator = Validator::make($request->all(), [
            'pertanyaan' => 'required',
            'jawaban' => 'required',
            'admin_id' => 'required',
        ]);
        if ($validator->fails()) {
            return response()->json($validator->errors(), 422);
        }

        $faq = Faq::create([
            'pertanyaan' => $request-> pertanyaan,
            'jawaban' => $request-> jawaban,
            'admin_id' => $request-> admin_id,
        ]);

        return new ResponseResource(true, 'Data Berhasil Ditambahkan!', $faq);

    }

    /**
     * Display the specified resource.
     */
    public function show($id)
    {
        $faq = Faq::whereId($id)->first();

        return new ResponseResource(true, 'Data Berhasil ditemukan!', $faq);

    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, $id)
    {
        $validator = Validator::make($request->all(), [
            'pertanyaan' => 'required',
            'jawaban' => 'required',
        ]);
        if ($validator->fails()) {
            return response()->json($validator->errors(), 401);
        } else{
            $faq = Faq::find($id);

            $faq->update([
                'pertanyaan' => $request-> input('pertanyaan'),
                'jawaban' => $request-> input('jawaban'),
            ]);

            if ($faq) {
                return new ResponseResource(true, 'Data Berhasil diedit!', $faq);
            } else {
                return response()->json($validator->errors(), 401);
            }
        }
    }

    /**
     * Remove the specified resource from storage.
     */

}
