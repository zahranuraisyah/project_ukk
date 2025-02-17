<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Barang;
use Illuminate\Support\Facades\Auth;

class BarangController extends Controller
{
    public function index()
    {
        $barangs = Barang::all();
        
        return view('barangs.index', compact('barangs'));
    }

    public function create()
    {
        if (Auth::user()->role !== 'admin') {
            abort(403, 'Unauthorized');
        }
        return view('barangs.create');
    }

    public function store(Request $request)
    {
        if (Auth::user()->role !== 'admin') {
            abort(403, 'Unauthorized');
        }

        $request->validate([
            'nama' => 'required|string|max:255',
            'harga' => 'required|numeric|min:1',
            'stok' => 'required|integer|min:1',
            'kategori' => 'required|string',
            'gambar' => 'nullable|image|mimes:jpeg,png,jpg,gif|max:2048',
        ]);

        if ($request->hasFile('gambar')) {
            $gambarPath = $request->file('gambar')->store('uploads', 'public');
        } else {
            $gambarPath = 'uploads/no.png';
        }

        Barang::create([
            'nama' => $request->nama,
            'harga' => $request->harga,
            'stok' => $request->stok,
            'kategori' => $request->kategori,
            'gambar' => $gambarPath,
        ]);

        return redirect()->route('barangs.index')->with('success', 'Barang berhasil ditambahkan.');
    }

    public function edit(Barang $barang)
    {
        if (Auth::user()->role !== 'admin') {
            abort(403, 'Unauthorized');
        }
        return view('barangs.edit', compact('barang'));
    }

    public function update(Request $request, Barang $barang)
    {
        if (Auth::user()->role !== 'admin') {
            abort(403, 'Unauthorized');
        }

        $request->validate([
            'nama' => 'required|string|max:255',
            'harga' => 'required|numeric',
            'stok' => 'required|integer',
            'kategori' => 'required|string|max:255',
            'gambar' => 'nullable|image|mimes:jpg,jpeg,png|max:2048',
        ]);

        $gambarPath = $barang->gambar;
        if ($request->hasFile('gambar')) {
            $gambarPath = $request->file('gambar')->store('uploads', 'public');
        }

        $barang->update([
            'nama' => $request->nama,
            'harga' => $request->harga,
            'stok' => $request->stok,
            'kategori' => $request->kategori,
            'gambar' => $gambarPath,
        ]);

        return redirect()->route('barangs.index')->with('success', 'Barang berhasil diperbarui.');
    }

    protected $barangTerkunci = [16, 17, 18, 19, 20, 21, 22, 23, 24, 25, 26, 27];
    public function destroy(Barang $barang)
    {
        

        if (Auth::user()->role !== 'admin') {
            abort(403, 'Unauthorized');
        }
        if (in_array($barang->id, $this->barangTerkunci)) {
            return redirect()->route('barangs.index')->with('error', 'Barang ini gagal di dihapus.');
        }

        $barang->delete();

        return redirect()->route('barangs.index')->with('success', 'Barang berhasil dihapus.');
    }

    public function pembelian()
    {
        $barangs = Barang::all(); // Ambil semua barang dari database

        return view('admin.pembelian.index', compact('barangs'));
    }

}
