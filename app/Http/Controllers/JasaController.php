<?php
namespace App\Http\Controllers;

use App\Models\Jasa;
use Illuminate\Http\Request;

class JasaController extends Controller
{
    public function index()
    {
        $jasas = Jasa::all();
        return view('jasas.index', compact('jasas'));
    }

    public function create()
    {
        return view('jasas.create');
    }

    public function store(Request $request)
    {
        $request->validate([
            'name' => 'required',
            'skill' => 'required',
            'price' => 'required|numeric',
            'description' => 'required',
        ]);

        Jasa::create($request->all());
        return redirect()->route('jasas.index')->with('success', 'Jasa berhasil ditambahkan.');
    }

    public function edit(Jasa $jasa)
    {
        return view('jasas.edit', compact('jasa'));
    }

    public function update(Request $request, Jasa $jasa)
    {
        $request->validate([
            'name' => 'required',
            'skill' => 'required',
            'price' => 'required|numeric',
            'description' => 'required',
        ]);

        $jasa->update($request->all());
        return redirect()->route('jasas.index')->with('success', 'Jasa berhasil diperbarui.');
    }

    public function destroy(Jasa $jasa)
    {
        $jasa->delete();
        return redirect()->route('jasas.index')->with('success', 'Jasa berhasil dihapus.');
    }
}
