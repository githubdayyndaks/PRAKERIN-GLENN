<?php

namespace App\Http\Controllers;
use Illuminate\Support\Facades\Auth;
use App\Models\Lantai;
use Illuminate\Http\Request;

class LantaiController extends Controller
{
    public function index()
    {
        $lantai = Lantai::orderBy('created_at', 'ASC')->get();

        return view('lantai.index', compact('lantai'));
    }

    public function create()
    {
        return view('lantai.create');
    }

    public function store(Request $request)
    {
        $request->validate([
            'lantai' => 'required|string|max:255',
        ]);

        $lantai = new Lantai();
        $lantai->lantai = $request->lantai;

        $lantai->save();

        $user = Auth::user();
        if ($user->type == 'admin'){
            return redirect()->route('admin/lantai')->with('success', 'data added successfully');
        }
        elseif ($user->type == 'supervisor'){
            return redirect()->route('supervisor/lantai')->with('success', 'data added successfully');
        }
        elseif ($user->type == 'petugas'){
            return redirect()->route('petugas/lantai')->with('success', 'data added successfully');
        }

    }

    public function show(string $id)
    {
        $lantai = Lantai::findOrFail($id);

        return view('lantai.show', compact('lantai'));
    }

    public function edit(string $id)
    {
        $lantai = Lantai::findOrFail($id);

        return view('lantai.edit', compact('lantai'));
    }

    public function invoice()
    {

        $lantai = Lantai::orderBy('created_at', 'ASC')->get();

        return view('lantai.invoice', compact('lantai'));
    }

    public function update(Request $request, $id)
    {
        $lantai = Lantai::findOrFail($id);

        // Validasi data yang diterima
        $request->validate([
            'lantai' => 'required|string|max:255',
        ]);

        // Update nama_tipekamar
        $lantai->lantai = $request->lantai;

        // Simpan perubahan
        $lantai->save();
        $user = Auth::user();
        if ($user->type == 'admin'){
            return redirect()->route('admin/lantai')->with('success', 'Data updated successfully');
        }
        elseif ($user->type == 'supervisor'){
            return redirect()->route('supervisor/lantai')->with('success', 'Data updated successfully');
        }
        elseif ($user->type == 'petugas'){
            return redirect()->route('petugas/lantai')->with('success', 'Data updated successfully');
        }
    }



    public function destroy(string $id)
    {
        $lantai = Lantai::findOrFail($id);

        $lantai->delete();

        $user = Auth::user();
        if ($user->type == 'admin'){
            return redirect()->route('admin/lantai')->with('success', 'data added successfully');
        }
        elseif ($user->type == 'supervisor'){
            return redirect()->route('supervisor/lantai')->with('success', 'data added successfully');
        }
        elseif ($user->type == 'petugas'){
            return redirect()->route('petugas/lantai')->with('success', 'data added successfully');
        }
    }
}
