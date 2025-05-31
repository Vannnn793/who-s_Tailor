<?php

namespace App\Http\Controllers\Penjahit;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class ProfileController extends Controller
{
    // Menampilkan form edit profil
    public function edit()
    {
        $user = auth()->user();  // Ambil data user yang sedang login
        return view('penjahit.profile.edit', compact('user'));
    }

    // Memproses update profil
    public function update(Request $request)
    {
        $request->validate([
            'name' => 'required',
            'email' => 'required|email',
            'alamat' => 'nullable|string',
            'no_hp' => 'nullable|string',
        ]);

        $user = auth()->user();  // Ambil data user yang sedang login
        $user->update([
            'name' => $request->name,
            'email' => $request->email,
            'alamat' => $request->alamat,
            'no_hp' => $request->no_hp,
        ]);

        return redirect()->back()->with('success', 'Profil berhasil diperbarui.');
    }
}
