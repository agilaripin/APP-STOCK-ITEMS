<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\User;
use Illuminate\Support\Facades\Hash; // Untuk hashing password
use Illuminate\Validation\Rule; // Untuk validasi unik email

class UserController
{
    /**
     * Menampilkan daftar semua pengguna.
     *
     * @return \Illuminate\Http\JsonResponse
     */
    public function index()
    {
        // Mendapatkan semua pengguna tanpa menampilkan password
        $users = User::select('id', 'name', 'email', 'created_at', 'updated_at')->get();

        return response()->json($users, 200);
    }

    /**
     * Menyimpan pengguna baru.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\JsonResponse
     */
    public function store(Request $request)
    {
        // Validasi input
        $validatedData = $request->validate([
            'name' => 'required|string|max:255',
            'email' => 'required|email|unique:users,email',
            'password' => 'required|string|min:6|confirmed', // password_confirmation diperlukan
        ]);

        // Membuat pengguna baru dengan hashing password
        $user = User::create([
            'name' => $validatedData['name'],
            'email' => $validatedData['email'],
            'password' => Hash::make($validatedData['password']),
        ]);

        // Menyembunyikan password dari response
        $user->makeHidden(['password', 'remember_token']);

        return response()->json([
            'message' => 'Pengguna berhasil dibuat.',
            'user' => $user
        ], 201);
    }

    /**
     * Menampilkan pengguna berdasarkan ID.
     *
     * @param  int  $id
     * @return \Illuminate\Http\JsonResponse
     */
    public function show($id)
    {
        $user = User::select('id', 'name', 'email', 'created_at', 'updated_at')->find($id);

        if (!$user) {
            return response()->json([
                'message' => 'Pengguna tidak ditemukan.'
            ], 404);
        }

        return response()->json($user, 200);
    }

    /**
     * Memperbarui pengguna berdasarkan ID.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\JsonResponse
     */
    public function update(Request $request, $id)
    {
        $user = User::find($id);

        if (!$user) {
            return response()->json([
                'message' => 'Pengguna tidak ditemukan.'
            ], 404);
        }

        // Validasi input
        $validatedData = $request->validate([
            'name' => 'sometimes|required|string|max:255',
            'email' => [
                'sometimes',
                'required',
                'email',
                Rule::unique('users')->ignore($user->id),
            ],
            'password' => 'sometimes|nullable|string|min:6|confirmed',
        ]);

        // Memperbarui data pengguna
        if (isset($validatedData['name'])) {
            $user->name = $validatedData['name'];
        }

        if (isset($validatedData['email'])) {
            $user->email = $validatedData['email'];
        }

        if (!empty($validatedData['password'])) {
            $user->password = Hash::make($validatedData['password']);
        }

        $user->save();

        // Menyembunyikan password dari response
        $user->makeHidden(['password', 'remember_token']);

        return response()->json([
            'message' => 'Pengguna berhasil diperbarui.',
            'user' => $user
        ], 200);
    }

    /**
     * Menghapus pengguna berdasarkan ID.
     *
     * @param  int  $id
     * @return \Illuminate\Http\JsonResponse
     */
    public function destroy($id)
    {
        $user = User::find($id);

        if (!$user) {
            return response()->json([
                'message' => 'Pengguna tidak ditemukan.'
            ], 404);
        }

        $user->delete();

        return response()->json([
            'message' => 'Pengguna berhasil dihapus.'
        ], 200);
    }
}
