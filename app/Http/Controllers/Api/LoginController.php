<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\User;
use Illuminate\Support\Facades\Hash;
use Tymon\JWTAuth\Facades\JWTAuth;

class LoginController extends Controller
{
    public function login(Request $request)
    {
        // ✅ Validasi input
        $request->validate([
            'username' => 'required|string',
            'password' => 'required|string',
        ]);

        // ✅ Cari user aktif
        $user = User::where('username', $request->username)
            ->where('isActive', 1)
            ->first();

        // ❌ User tidak ditemukan
        if (!$user) {
            return response()->json([
                'status' => false,
                'message' => 'Username tidak ditemukan atau tidak aktif'
            ], 401);
        }

        // ❌ Password salah
        if (!Hash::check($request->password, $user->password)) {
            return response()->json([
                'status' => false,
                'message' => 'Password salah'
            ], 401);
        }

        // ✅ BUAT TOKEN JWT
        $token = JWTAuth::fromUser($user);

        // ✅ RESPONSE LOGIN BERHASIL + TOKEN
        return response()->json([
            'status' => true,
            'message' => 'Login sukses',
            'data' => [
                'id'       => $user->id,
                'username' => $user->username,
                'role'     => $user->role,
            ],
            'token' => $token
        ], 200);
    }
}
