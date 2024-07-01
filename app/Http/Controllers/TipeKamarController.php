<?php

namespace App\Http\Controllers;

use App\Models\setting;
use Illuminate\Http\Request;
use App\Models\tipekamar;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Storage;

class TipeKamarController extends Controller
{
    public function index()
    {
        $tipekamar = tipekamar::orderBy('created_at', 'ASC')->get();

        return view('tipekamar.index', compact('tipekamar'));
    }

    public function create()
    {
        // Ambil nomor urut berikutnya
        $nextId = TipeKamar::max('kode_tipekamar'); // Mendapatkan kode terakhir
        $nextId = $nextId ? (int) substr($nextId, 3) + 1 : 1; // Jika ada kode sebelumnya, tambahkan 1, jika tidak, mulai dari 1
        $nextId = str_pad($nextId, 3, '0', STR_PAD_LEFT); // Format nomor urut dengan 3 digit dan diisi dengan 0 di depan jika perlu

        // Hasilkan kode tipe kamar
        $kodeTipeKamar = 'TK-' . $nextId;

        return view('tipekamar.create', compact('kodeTipeKamar'));
    }

    public function store(Request $request)
    {
        $request->validate([
            'kode_tipekamar' => 'required|unique:tipekamar,kode_tipekamar',
            'nama_tipekamar' => 'required|string|max:255',
            'fasilitas' => 'required|string|max:255',
            'foto' => 'required|image|mimes:jpeg,png,jpg,gif,svg|max:2048',
        ]);

        $tipeKamar = new TipeKamar();
        $tipeKamar->kode_tipekamar = $request->kode_tipekamar;
        $tipeKamar->nama_tipekamar = $request->nama_tipekamar;
        $tipeKamar->fasilitas = $request->fasilitas;

        if ($request->hasFile('foto')) {
            $file = $request->file('foto');
            $filename = time() . '.' . $file->getClientOriginalExtension();
            $file->move(public_path('uploads'), $filename);
            $tipeKamar->foto = $filename;
        }

        $tipeKamar->save();

        $user = Auth::user();
        if ($user->type == 'admin'){
            return redirect()->route('admin/tipekamar')->with('success', 'data added successfully');
        }
        elseif ($user->type == 'supervisor'){
            return redirect()->route('supervisor/tipekamar')->with('success', 'data added successfully');
        }
        elseif ($user->type == 'petugas'){
            return redirect()->route('petugas/tipekamar')->with('success', 'data added successfully');
        }

    }

    public function show(string $kode_tipekamar)
    {
        $tipekamar = TipeKamar::findOrFail($kode_tipekamar);

        return view('tipekamar.show', compact('tipekamar'));
    }

    public function edit(string $kode_tipekamar)
    {
        $tipekamar = tipekamar::findOrFail($kode_tipekamar);

        return view('tipekamar.edit', compact('tipekamar'));
    }

    public function update(Request $request, $id)
    {
        $tipekamar = TipeKamar::findOrFail($id);

        // Validasi data yang diterima
        $request->validate([
            'nama_tipekamar' => 'required|string|max:255',
            'fasilitas' => 'required|string|max:255',
            'foto' => 'nullable|image|mimes:jpeg,png,jpg,gif,svg|max:2048',
        ]);

        // Update nama_tipekamar
        $tipekamar->nama_tipekamar = $request->nama_tipekamar;
        $tipekamar->fasilitas = $request->fasilitas;

        // Cek apakah ada file baru yang diunggah
        if ($request->hasFile('foto')) {
            // Hapus foto lama jika ada
            if ($tipekamar->foto && file_exists(public_path('uploads/' . $tipekamar->foto))) {
                unlink(public_path('uploads/' . $tipekamar->foto));
            }

            // Simpan file baru
            $file = $request->file('foto');
            $filename = time() . '.' . $file->getClientOriginalExtension();
            $file->move(public_path('uploads'), $filename);
            $tipekamar->foto = $filename;
        }

        // Simpan perubahan
        $tipekamar->save();
        $user = Auth::user();
        if ($user->type == 'admin'){
            return redirect()->route('admin/tipekamar')->with('success', 'Data updated successfully');
        }
        elseif ($user->type == 'supervisor'){
            return redirect()->route('supervisor/tipekamar')->with('success', 'Data updated successfully');
        }
        elseif ($user->type == 'petugas'){
            return redirect()->route('petugas/tipekamar')->with('success', 'Data updated successfully');
        }

    }


    public function invoice()
    {

        $tipekamar = tipekamar::orderBy('created_at', 'ASC')->get();

        return view('tipekamar.invoice', compact('tipekamar'));
    }


    public function destroy(string $kode_tipekamar)
    {
        $tipekamar = tipekamar::findOrFail($kode_tipekamar);

        $tipekamar->delete();

        $user = Auth::user();
        if ($user->type == 'admin'){
            return redirect()->route('admin/tipekamar')->with('success', 'data added successfully');
        }
        elseif ($user->type == 'supervisor'){
            return redirect()->route('supervisor/tipekamar')->with('success', 'data added successfully');
        }
        elseif ($user->type == 'petugas'){
            return redirect()->route('petugas/tipekamar')->with('success', 'data added successfully');
        }
    }
}



