<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\StokBarang;
use Illuminate\Routing\Controller;

class StokBarangController extends Controller
{
    /**
     * Menampilkan daftar stok barang.
     *
     * @return \Illuminate\Http\JsonResponse
     */
    public function index()
    {
        $items = StokBarang::all();
        return view('stok-barang.index', compact('items'));
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
            'size' => 'required',
            'nama_ikan' => 'required|string',
            'stok_awal' => 'required|integer',
            'barang_keluar' => 'required|integer',
            'barang_masuk' => 'required|integer',
            'stok_akhir' => 'required|integer',
            'harga_beli' => 'required',
            'total' => 'required',
        ]);

        $item = StokBarang::create($validatedData);

        return response()->json([
            'message' => 'Barang berhasil ditambahkan ke stok.',
            'data' => $item
        ], 201);
    }

    public function create()
    {
        return view('stok-barang.create');
    }

    /**
     * Menampilkan detail stok barang berdasarkan ID.
     *
     * @param  int  $id
     * @return \Illuminate\Http\JsonResponse
     */
    public function show($id)
    {
        $item = StokBarang::find($id);

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
        $item = StokBarang::find($id);

        if (!$item) {
            return response()->json([
                'message' => 'Barang tidak ditemukan.'
            ], 404);
        }

        $validatedData = $request->validate([
            'Size' => 'required|integer',
            'NamaIkan' => 'required|string',
            'StokAwal' => 'required|string',
            'BarangKeluar' => 'required|integer',
            'BarangMasuk' => 'required|integer',
            'StokAkhir' => 'required|integer',
            'HargaBeli' => 'required|integer',
            'Total' => 'required|integer',
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
        $item = StokBarang::find($id);

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
