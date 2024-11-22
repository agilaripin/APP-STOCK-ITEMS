<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Routing\Controller;
use App\Models\BelanjaHarian;
use App\Models\StokBarang;

class BelanjaHarianController extends Controller
{

     /**
     * Menampilkan daftar stok barang.
     *
     * @return \Illuminate\Http\JsonResponse
     */
    public function index()
    {
        $items = BelanjaHarian::all();
        return view('belanja-harian.index', compact('items'));
    }


        /**
         * Menyimpan barang baru ke dalam stok.
         *
         * @param  \Illuminate\Http\Request  $request
         * @return \Illuminate\Http\JsonResponse
         */
        public function store(Request $request)
    {
        // Validate incoming request
        $validatedData = $request->validate([
            'nama_barang' => 'required|string',
            'quantity' => 'required|numeric',
            'harga_beli' => 'required|numeric',
            'jumalah' => 'required|numeric',
        ]);

        // Create a new BelanjaHarian entry
        $item = BelanjaHarian::create($validatedData);

        // Find the corresponding StokBarang entry based on nama_barang
        $stokBarang = StokBarang::where('nama_ikan', $request->nama_barang)->first();

        // If StokBarang not found, create a new one
        if (!$stokBarang) {
            // Create new stock item if not found
            $stokBarang = new StokBarang();
            $stokBarang->nama_ikan = $request->nama_barang;
            $stokBarang->stok_awal = 0;
            $stokBarang->barang_keluar = 0;
            $stokBarang->barang_masuk = $request->quantity;
            $stokBarang->stok_akhir = $request->quantity;
            $stokBarang->harga_beli = $request->harga_beli;
            $stokBarang->total = $request->quantity * $request->harga_beli;
            $stokBarang->size = 0;
            $stokBarang->save();
        } else {
            // If StokBarang exists, update stok_akhir and harga_beli
            $stokBarang->stok_akhir += $request->quantity; // Increase the stock with the purchased quantity
            $stokBarang->harga_beli = $request->harga_beli; // Update harga_beli
            $stokBarang->total = $stokBarang->stok_akhir * $stokBarang->harga_beli; // Update total cost
            $stokBarang->save();
        }

        // Set the jumlah (quantity * harga_beli) for BelanjaHarian
        $item->jumalah = $request->quantity * $request->harga_beli;
        $item->save();

        return response()->json([
            'message' => 'Barang berhasil ditambahkan ke stok dan Belanja Harian.',
            'data' => $item
        ], 201);
    }

    public function create()
    {
        return view('belanja-harian.create');
    }

    /**
     * Menampilkan detail stok barang berdasarkan ID.
     *
     * @param  int  $id
     * @return \Illuminate\Http\JsonResponse
     */
    public function show($id)
    {
        $item = BelanjaHarian::find($id);

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
        $item = BelanjaHarian::find($id);

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
        $item = BelanjaHarian::find($id);

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
