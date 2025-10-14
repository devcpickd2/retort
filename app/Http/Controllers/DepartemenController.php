<?php

namespace App\Http\Controllers;

use App\Models\Departemen;
use Illuminate\Http\Request;

class DepartemenController extends Controller
{
    public function index()
    {
        $departemens = Departemen::all();
        return view('form.departemen.index', compact('departemens')); // path view
    }

    public function create()
    {
        return view('form.departemen.create');
    }

    public function store(Request $request)
    {
        $request->validate(['nama' => 'required']);
        Departemen::create($request->all());

        return redirect()->route('departemen.index')->with('success', 'Departemen berhasil ditambahkan');
    }

    public function edit($uuid)
    {
        $departemen = Departemen::where('uuid', $uuid)->firstOrFail();
        return view('form.departemen.edit', compact('departemen'));
    }

    public function update(Request $request, $uuid)
    {
        $request->validate(['nama' => 'required|string|max:255']);
        $departemen = Departemen::where('uuid', $uuid)->firstOrFail();
        $departemen->update(['nama' => $request->nama]);

        return redirect()->route('departemen.index')->with('success', 'Departemen berhasil diupdate');
    }

    public function destroy($uuid)
    {
        $departemen = Departemen::where('uuid', $uuid)->firstOrFail();
        $departemen->delete();

        return redirect()->route('departemen.index')->with('success', 'Departemen berhasil dihapus');
    }
}
