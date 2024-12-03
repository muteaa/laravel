<?php

namespace App\Http\Controllers;

use App\Models\Pelanggan;
use Illuminate\Http\Request;

class LoyalitasController extends Controller
{
    public function index()
    {
        // Fetch all Pelanggan records
        $pelanggan = Pelanggan::all();
        // Pass the data to the view
        return view('loyalitas.index', compact('pelanggan'));
    }


    public function create()
    {
        // Return the form for adding a new pelanggan
        return view('loyalitas.create');
    }

    public function store(Request $request)
    {
        // Validate and store new pelanggan
        $request->validate([
            'nama_member' => 'required|string',
            'kontak_member' => 'nullable|string',
            'alamat_member' => 'nullable|string',
        ]);

        Pelanggan::create($request->all());

        return redirect()->route('loyalitas.index')->with('success', 'Pelanggan added successfully.');
    }

    public function edit($id)
    {
        // Find the pelanggan by id
        $pelanggan = Pelanggan::findOrFail($id);

        return view('loyalitas.edit', compact('pelanggan'));
    }

    public function update(Request $request, $id)
    {
        // Validate and update the pelanggan
        $request->validate([
            'nama_member' => 'required|string',
            'kontak_member' => 'nullable|string',
            'alamat_member' => 'nullable|string',
        ]);

        $pelanggan = Pelanggan::findOrFail($id);
        $pelanggan->update($request->all());

        return redirect()->route('loyalitas.index')->with('success', 'Pelanggan updated successfully.');
    }

    public function destroy($id)
    {
        // Find and delete the pelanggan
        $pelanggan = Pelanggan::findOrFail($id);
        $pelanggan->delete();

        return redirect()->route('loyalitas.index')->with('success', 'Pelanggan deleted successfully.');
    }
}
