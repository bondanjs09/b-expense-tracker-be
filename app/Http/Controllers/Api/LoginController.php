<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\User;
use Illuminate\Support\Facades\Hash;

class LoginController extends Controller
{
    public function login(Request $request)
    {
        // ✅ Validasi input
        $request->validate([
            'username' => 'required|string',
            'password' => 'required|string',
        ]);

        // ✅ Cari user berdasarkan username & isActive
        $user = User::where('username', $request->username)
            ->where('isActive', 1)
            ->first();

        // ✅ Jika user tidak ditemukan
        if (!$user) {
            return response()->json([
                'status' => false,
                'message' => 'Username tidak ditemukan atau tidak aktif'
            ], 401);
        }

        // ✅ Cek password (karena disimpan dalam bentuk hash)
        if (!Hash::check($request->password, $user->password)) {
            return response()->json([
                'status' => false,
                'message' => 'Password salah'
            ], 401);
        }

        // ✅ Login berhasil → Return JSON sesuai permintaan
        return response()->json([
            'status' => false,
            'message' => 'Login sukses.',
            'data' => [
                'id'       => $user->id,
                'username' => $user->username,
                'role'     => $user->role,
            ],
        ], 200);
    }
}
