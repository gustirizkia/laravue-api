<?php

namespace App\Http\Controllers;

use App\api_artikel;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

class artikelController extends Controller
{
    public function index() {
        $artikel = api_artikel::latest()->get();
        return response([
            'success' => true,
            'message' => 'List Semua Artikel',
            'data' => $artikel
        ], 200);
    }
    public function store(Request $request) {
        $validator = Validator::make($request->all(), [
            'judul' => 'required',
            'konten' => 'required',
        ],
        [
            'judul.required' => 'masukan judul artikel',
            'konten.required' => 'masukan konten',
        ]
    );

    if($validator->fails()){
        return response([
            'success' => false,
            'message' => 'isi bidang yang kosong',
            'data' => $validator->errors()
        ], 400);
    } else {
        $artikel = api_artikel::create([
            'judul' => $request->input('judul'),
            'konten' => $request->input('konten'),
        ], 200);
    }
    if($artikel) {
        return response()->json([
            'success' => true,
            'message' => 'Data berhasil disimpan',
            'data' => $artikel,
        ], 200);
    } else {
        return response()->json([
            'success' => false,
            'message' => 'Data gagal disimpan'
        ], 400);
    }

    }
    public function show($id){
        $artikel = api_artikel::whereId($id)->first();

        if($artikel) {
            return response()->json([
                'success' => true,
                'message' => 'Detail Artikel',
                'data' => $artikel,
            ], 200);
        } else {
            return response()->json([
                'success' => false,
                'message' => 'Tidak ada artikel',
                'data' => '',
            ], 200);
        }

    }

    public function update(Request $request) {
        $validator = Validator::make($request->all(), [
            'judul' => 'required',
            'konten' => 'required',
        ],
        [
            'judul.required' => 'masukan judul artikel',
            'konten.required' => 'masukan konten',
        ]
        );

        if($validator->fails()){
            return response()->json([
                'success' => true,
                'message' => 'Isi bidang yang kosong',
                'data' => $validator,
            ], 400);
        } else {
            $post = api_artikel::whereId($request->input('id'))->update([
                'judul' => $request->input('judul'),
                'konten' => $request->input('konten'),
            ], 200);
        }
        if($post) {
            return response()->json([
                'success' => true,
                'message' => 'data berhasil di ubah',
                'data' => $post,
            ], 200);
        }
    }
    public function destroy($id){
        $artikel = api_artikel::whereId($id);
        $artikel->delete();

        if($artikel){
            return response()->json([
                'success' => true,
                'message' => '$artikel.judul berhasil di hapus',
            ], 200);
        }
    }
}
