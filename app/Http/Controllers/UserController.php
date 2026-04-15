<?php

namespace App\Http\Controllers;

use App\Models\User;
use App\Models\Prodi; // Pastikan model Prodi di-import
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Auth;

class UserController extends Controller
{
    public function index()
    {
        // Tampilkan user, bisa difilter sesuai prodi admin yang login jika perlu
        $users = User::with('prodi')->latest()->get();
        return view('users.index', compact('users'));
    }

    public function create()
    {
        $prodis = Prodi::all();
        return view('users.create', compact('prodis'));
    }

    public function store(Request $request)
    {
        $request->validate([
            'name'     => 'required|string|max:255',
            'email'    => 'required|string|email|max:255|unique:users',
            'password' => 'required|string|min:8',
            'prodi_id' => 'required|exists:prodis,id',
            // 'role' => 'required|string' // Buka ini kalau kamu punya kolom role di tabel users
        ]);

        User::create([
            'name'     => $request->name,
            'email'    => $request->email,
            'password' => Hash::make($request->password),
            'prodi_id' => $request->prodi_id,
        ]);

        return redirect()->route('users.index')->with('success', 'Pengguna baru berhasil ditambahkan.');
    }

    public function edit($id)
    {
        $user = User::findOrFail($id);
        $prodis = Prodi::all();
        return view('users.edit', compact('user', 'prodis'));
    }

    public function update(Request $request, $id)
    {
        $user = User::findOrFail($id);

        $request->validate([
            'name'     => 'required|string|max:255',
            'email'    => 'required|string|email|max:255|unique:users,email,' . $user->id,
            'password' => 'nullable|string|min:8', // Boleh kosong
            'prodi_id' => 'required|exists:prodis,id',
        ]);

        $data = [
            'name'     => $request->name,
            'email'    => $request->email,
            'prodi_id' => $request->prodi_id,
        ];

        // Hanya update password jika form password diisi
        if ($request->filled('password')) {
            $data['password'] = Hash::make($request->password);
        }

        $user->update($data);

        return redirect()->route('users.index')->with('success', 'Data pengguna berhasil diperbarui.');
    }

    public function destroy($id)
    {
        $user = User::findOrFail($id);

        // Cegah user menghapus akunnya sendiri saat sedang login
        if ($user->id === Auth::id()) {
            return redirect()->route('users.index')->with('error', 'Gagal! Anda tidak bisa menghapus akun yang sedang Anda gunakan.');
        }

        $user->delete();
        return redirect()->route('users.index')->with('success', 'Akun pengguna berhasil dihapus.');
    }
}
