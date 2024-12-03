<?php
namespace App\Http\Controllers;

use App\Models\Karyawan;
use Illuminate\Http\Request;

class KaryawanController extends Controller
{
    // Display a listing of the resource
    public function index()
    {
        $karyawan = Karyawan::all();
        return view('karyawan.index', compact('karyawan'));
    }

    // Show the form for creating a new resource
    public function create()
    {
        return view('karyawan.create');
    }

    // Store a newly created resource in storage
    public function store(Request $request)
    {
        $validatedData = $request->validate([
            'nama_karyawan' => 'required|string|max:255',
            'kontak_karyawan' => 'nullable|string|max:255',
            'email' => 'required|email|unique:karyawan,email',
            'password' => 'required|string|min:8',
        ]);

        $karyawan = Karyawan::create($validatedData);

        if ($karyawan) {
            return redirect()->route('karyawan.index')->with('success', 'Karyawan created successfully.');
        } else {
            return redirect()->back()->with('error', 'Failed to create karyawan.');
        }
    }

    // Show the form for editing the specified resource
    public function edit($id)
    {
        $karyawan = Karyawan::findOrFail($id);
        return view('karyawan.edit', compact('karyawan'));
    }

    // Update the specified resource in storage
    public function update(Request $request, Karyawan $karyawan)
    {
        $request->validate([
            'nama_karyawan' => 'required|string|max:255',
            'kontak_karyawan' => 'nullable|string|max:255',
            'email' => 'required|email|unique:karyawan,email,',
        ]);

      
        $karyawan->update($request->only('nama_karyawan', 'kontak_karyawan', 'email'));
        return redirect()->route('karyawan')->with('success', 'Karyawan updated successfully.');
    }

    // Remove the specified resource from storage
    public function destroy($id)
    {
        $karyawan = Karyawan::findOrFail($id);
        $karyawan->delete();

        return redirect()->route('karyawan.index')->with('success', 'Karyawan deleted successfully.');
    }
}
