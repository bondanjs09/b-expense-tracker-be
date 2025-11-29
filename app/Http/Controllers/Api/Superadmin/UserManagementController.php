<?php

namespace App\Http\Controllers\Api\SuperAdmin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\User;

class UserManagementController extends Controller
{
    public function addUser(Request $request)
    {
        // ✅ Validasi input
        $request->validate([
            'username' => 'required|string|unique:bet_user_tbl,username',
            'password' => 'required|string|min:6',
            'role'     => 'required|in:USER,ADMIN,SUPERADMIN',
        ]);

        // ✅ Simpan user baru
        User::create([
            'username'  => $request->username,
            'password'  => $request->password, // otomatis di-hash oleh mutator
            'role'      => $request->role,
            'isActive'  => 1,
            'createdAt' => now(),
            'updatedAt' => now(),
        ]);

        return response()->json([
            'status'  => true,
            'message' => 'User berhasil ditambahkan'
        ], 201);
    }
}
