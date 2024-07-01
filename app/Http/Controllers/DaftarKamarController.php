<?php

namespace App\Http\Controllers;
use App\Models\DaftarKamar;
use App\Models\Lantai;
use Illuminate\Support\Facades\Log;
use App\Models\tipekamar;
use Illuminate\Support\Facades\Auth;
use Illuminate\Http\Request;

class DaftarKamarController extends Controller
{
    public function index()
    {
        $kamar = DaftarKamar::orderBy('created_at', 'ASC')->get();

        return view('kamar.index', compact('kamar'));
    }

    public function create()
    {
        $lantai = Lantai::all();
        $tipeKamar = TipeKamar::all();
        return view('kamar.create', compact('lantai', 'tipeKamar'));
    }

    public function generateKodeKamar($lantaiId)
    {
        $lantai = Lantai::find($lantaiId);
        $kodeLantai = $lantai->lantai; // Menggunakan nilai lantai yang dipilih

        $latestKamar = DaftarKamar::where('lantai_id', $lantaiId)
                        ->orderBy('kode_daftarkamar', 'desc')
                        ->first();

        if ($latestKamar) {
            $lastNumber = (int)substr($latestKamar->kode_daftarkamar, -3);
            $newNumber = str_pad($lastNumber + 1, 3, '0', STR_PAD_LEFT);
        } else {
            $newNumber = '001';
        }

        return $kodeLantai . '-KMR' . $newNumber;
    }

    public function store(Request $request)
    {
        $validatedData = $request->validate([
            'lantai' => 'required|exists:lantai,lantai_id',
            'tipeKamar' => 'required|exists:tipeKamar,kode_tipekamar',
            'harga' => 'required|numeric',
            'luas' => 'required|string|max:255',
            'status' => 'required|in:Tersedia,Disewa',
        ]);

        Log::info('Validated Data: ', $validatedData);

        $kode_daftarkamar = $this->generateKodeKamar($request->lantai);

        $daftar_kamar = new DaftarKamar();
        $daftar_kamar->kode_daftarkamar = $kode_daftarkamar;
        $daftar_kamar->lantai_id = $request->lantai;
        $daftar_kamar->kode_tipekamar = $request->tipeKamar;
        $daftar_kamar->fasilitas = $request->fasilitas;
        $daftar_kamar->harga = $request->harga;
        $daftar_kamar->luas = $request->luas;
        $daftar_kamar->status = $request->status;

        // Get the foto from the selected tipeKamar
        $tipeKamar = TipeKamar::find($request->tipeKamar);
        $daftar_kamar->nama_tipekamar = $tipeKamar->nama_tipekamar;
        $daftar_kamar->fasilitas = $tipeKamar->fasilitas;
        $daftar_kamar->foto = $tipeKamar->foto;
        $user = Auth::user();
        $daftar_kamar->nama_penyewa = $user->name;

        Log::info('Kamar Data: ', $daftar_kamar->toArray());

        $daftar_kamar->save();

        Log::info('Data saved successfully');

        $daftar_kamar->save();

        $user = Auth::user();
        if ($user->type == 'admin'){
            return redirect()->route('admin/kamar')->with('success', 'Data updated successfully');
        }
        elseif ($user->type == 'supervisor'){
            return redirect()->route('supervisor/kamar')->with('success', 'Data updated successfully');
        }
        elseif ($user->type == 'petugas'){
            return redirect()->route('petugas/kamar')->with('success', 'Data updated successfully');
        }
    }

    public function show(string $kode_daftarkamar)
    {
        $kamar = DaftarKamar::findOrFail($kode_daftarkamar);

        return view('kamar.show', compact('kamar'));
    }

    public function edit(string $kode_daftarkamar)
    {
        $kamar = DaftarKamar::findOrFail($kode_daftarkamar);
        $lantai = Lantai::all();
        $tipeKamar = tipekamar::all();

        return view('kamar.edit', compact('kamar', 'lantai', 'tipeKamar'));
    }

    public function invoice()
    {

        $kamar = DaftarKamar::orderBy('created_at', 'ASC')->get();

        return view('kamar.invoice', compact('kamar'));
    }

    public function update(Request $request, $kode_daftarkamar)
    {
        try {
            // Validasi data yang diterima
            $validatedData = $request->validate([
                'tipeKamar' => 'required|exists:tipeKamar,kode_tipekamar',
                'harga' => 'required|numeric',
                'luas' => 'required|string|max:255',
                'status' => 'required|in:Tersedia,Disewa',
            ]);
            Log::info('Validated Data: ', $validatedData);
            // dd($validatedData);

            // Cari data kamar berdasarkan kode_daftarkamar
            $kamar = DaftarKamar::where('kode_daftarkamar', $kode_daftarkamar)->firstOrFail();
            Log::info('Kamar Found: ', $kamar->toArray());
            // dd($kamar);

            // Update data kamar
            $kamar->update([
                'kode_tipekamar' => $request->tipeKamar,
                'harga' => $request->harga,
                'luas' => $request->luas,
                'status' => $request->status,
                'foto' => TipeKamar::find($request->tipeKamar)->foto,
            ]);
            Log::info('Kamar Data edited: ', $kamar->toArray());

            // Redirect berdasarkan tipe user
            return redirect()->route(Auth::user()->type . '/kamar')->with('success', 'Data updated successfully');
        } catch (\Exception $e) {
            Log::error('Error updating data: ', ['message' => $e->getMessage()]);
            return redirect()->back()->with('error', 'An error occurred while updating the data.');
        }
    }










    public function destroy(string $id)
    {
        $kamar = DaftarKamar::findOrFail($id);

        $kamar->delete();

        $user = Auth::user();
        if ($user->type == 'admin'){
            return redirect()->route('admin/kamar')->with('success', 'data added successfully');
        }
        elseif ($user->type == 'supervisor'){
            return redirect()->route('supervisor/kamar')->with('success', 'data added successfully');
        }
        elseif ($user->type == 'petugas'){
            return redirect()->route('petugas/kamar')->with('success', 'data added successfully');
        }
    }
}
