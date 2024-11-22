<?php

namespace App\Http\Controllers;

use App\Models\LaporanPenjualan;
use App\Models\StokBarang;
use Illuminate\Http\Request;
use Illuminate\Routing\Controller;
use Illuminate\Support\Facades\Log;


class LaporanPenjualanController extends Controller
{
    /**
     * Menampilkan daftar stok barang.
     *
     * @return \Illuminate\Http\JsonResponse
     */
    public function index()
    {
        $items = LaporanPenjualan::all();
        return view('laporan-penjualan.index', compact('items'));
    }

    public function create()
    {
        return view('laporan-operasional.create');
    }

    public function store(Request $request)
    {
        try {
            // Validate input, remove harga_beli, untung_kg, total_keuntungan, and total_penjualan since they will be calculated
            $validatedData = $request->validate([
                'nama_pembeli' => 'required|string',
                'size' => 'required|numeric', // Ensure it's a numeric value
                'nama_barang' => 'required|string|exists:stock_items,nama_ikan',
                'QTY' => 'required|numeric', // Ensure it's a numeric value
                'harga_penjualan' => 'required|numeric', // harga_penjualan is input manually
            ]);

            Log::info('Request Data:', $request->all());

            // Retrieve the stock item based on nama_ikan and size
            $stockItem = StokBarang::where('nama_ikan', $request->nama_barang)
                ->where('size', $request->size)
                ->first();

            if (!$stockItem) {
                return response()->json([
                    'message' => 'Item with specified nama_ikan and size not found in stock_items table.'
                ], 400);
            }

            // Check if sufficient stock is available
            if ($stockItem->stok_akhir < $request->QTY) {
                return response()->json([
                    'message' => 'Stok tidak mencukupi, periksa kembali jumlah stok.'
                ], 400);
            }

            // Calculate the fields based on the stock data and request data
            $harga_beli = $stockItem->harga_beli; // Get harga_beli from stock_items
            $harga_penjualan = $request->harga_penjualan;
            $QTY = $request->QTY;

            $untung_kg = $harga_penjualan - $harga_beli; // Profit per kilogram
            $total_keuntungan = $untung_kg * $QTY; // Total profit
            $total_penjualan = $harga_penjualan * $QTY; // Total sale amount

            // Update the stock
            $stockItem->stok_akhir -= $QTY;
            $stockItem->save();

            // Prepare data for LaporanPenjualan creation
            $dataToInsert = array_merge($validatedData, [
                'harga_beli' => $harga_beli,
                'untung_kg' => $untung_kg,
                'total_keuntungan' => $total_keuntungan,
                'total_penjualan' => $total_penjualan,
            ]);

            // Create a new sales report entry
            $item = LaporanPenjualan::create($dataToInsert);

            return response()->json([
                'message' => 'Laporan Penjualan berhasil ditambahkan ke jurnal',
                'data' => $item
            ], 201);

        } catch (\Illuminate\Validation\ValidationException $e) {
            return response()->json([
                'errors' => $e->errors()
            ], 422);
        }
    }




    /**
     * Menampilkan detail stok barang berdasarkan ID.
     *
     * @param  int  $id
     * @return \Illuminate\Http\JsonResponse
     */
    public function show($id)
    {
        $item = LaporanPenjualan::find($id);

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
        $item = LaporanPenjualan::find($id);

        if (!$item) {
            return response()->json([
                'message' => 'Barang tidak ditemukan.'
            ], 404);
        }

        $validatedData = $request->validate([
            'nama_pembeli' =>'required|string',
            'size' =>'required|float',
            'nama_barang' =>'required|string',
            'QTY' =>'required|float',
            'harga_beli' =>'required|double',
            'harga_penjualan' =>'required|double',
            'total_penjualan' =>'required|double',
            'untung_kg' =>'required|duble',
            'total_keuntungan' =>'required|double',
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
        $item = LaporanPenjualan::find($id);

        if (!$item) {
            return response()->json([
                'message' => 'Barang tidak ditemukan.'
            ], 404);
        }

        $item->delete();

        return response()->json([
            'message' => 'laporan berhasil dihapus dari journal.'
        ], 200);
    }
}
