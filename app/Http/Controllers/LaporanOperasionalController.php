<?php

namespace App\Http\Controllers;

use App\Models\LaporanOperasional;
use Illuminate\Http\Request;
use Illuminate\Routing\Controller;

class LaporanOperasionalController extends Controller
{
    /**
     * Menampilkan daftar stok barang.
     *
     * @return \Illuminate\Http\JsonResponse
     */
    public function index()
    {
        $items = LaporanOperasional::all();
        return view('laporan-operasional.index', compact('items'));
    }

    public function create()
    {
        return view('laporan-operasional.create');
    }

    /**
     * Menyimpan barang baru ke dalam stok.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\JsonResponse
     */
    public function store(Request $request)
    {

        $validatedData = $request->validate([
            'nama_barang' =>'required|string',
            'jumlah' =>'required|numeric',

        ]);

        $item = LaporanOperasional::create($validatedData);

        return response()->json([
            'message' => 'Barang berhasil ditambahkan ke stok.',
            'data' => $item
        ], 201);
    }

    /**
     * Menampilkan detail stok barang berdasarkan ID.
     *
     * @param  int  $id
     * @return \Illuminate\Http\JsonResponse
     */
    public function show($id)
    {
        $item = LaporanOperasional::find($id);

        if (!$item) {
            return response()->json([
                'message' => 'Barang tidak ditemukan.'
            ], 404);
        }

        return response()->json($item, 200);
    }

    /**
     * Memperbarui data stok barang berdasarkan ID.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\JsonResponse
     */
    public function update(Request $request, $id)
    {
        $item = LaporanOperasional::find($id);

        if (!$item) {
            return response()->json([
                'message' => 'Barang tidak ditemukan.'
            ], 404);
        }

        $validatedData = $request->validate([
            'nama_barang' =>'required|string',
            'jumlah' =>'required|double',
        ]);

        $item->update($validatedData);

        return response()->json([
            'message' => 'Data barang berhasil diperbarui.',
            'data' => $item
        ], 200);
    }

    /**
     * Menghapus data stok barang berdasarkan ID.
     *
     * @param  int  $id
     * @return \Illuminate\Http\JsonResponse
     */
    public function destroy($id)
    {
        $item = LaporanOperasional::find($id);

        if (!$item) {
            return response()->json([
                'message' => 'Barang tidak ditemukan.'
            ], 404);
        }

        $item->delete();

        return response()->json([
            'message' => 'Barang berhasil dihapus dari stok.'
        ], 200);
    }
}
