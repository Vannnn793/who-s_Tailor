<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Order;

class pesanancontroller extends Controller
{
    public function index()
    {
        $orders = Order::where('user_id', auth()->id())->latest()->get();
        return view('orders.index', compact('orders'));
    }

    public function create()
    {
        return view('orders.create');
    }

    public function store(Request $request)
    {
        $request->validate([
            'nama' => 'required',
            'jumlah' => 'required|numeric|min:1',
            'ukuran' => 'required',
            'deskripsi' => 'nullable',
            'design' => 'required|file|mimes:jpg,jpeg,png,pdf|max:2048',
            'harga' => 'required|numeric',
        ]);

        $designPath = $request->file('design')->store('designs', 'public');

        Order::create([
            'user_id' => auth()->id(),
            'nama' => $request->nama,
            'jumlah' => $request->jumlah,
            'ukuran' => $request->ukuran,
            'deskripsi' => $request->deskripsi,
            'design' => $designPath,
            'harga' => $request->harga,
        ]);

        return redirect()->route('orders.index')->with('success', 'Pesanan berhasil dibuat!');
    }
}
