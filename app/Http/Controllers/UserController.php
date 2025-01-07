<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;

class UserController extends Controller
{
    public function index()
    {
        // Ambil semua pengguna dari database
        $users = User::all();  // Anda juga bisa menggunakan query yang lebih spesifik jika diperlukan

        // Kirim data pengguna ke view
        return view('admin.users.index', compact('users'));
    }

    public function updateRole(Request $request)
    {
        $user = User::findOrFail($request->user_id);
        $user->role = $request->role;
        $user->save();

        return redirect()->back()->with('success', 'Role pengguna berhasil diupdate!');
    }
}
