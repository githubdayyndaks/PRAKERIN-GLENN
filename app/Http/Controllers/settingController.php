<?php

namespace App\Http\Controllers;
use App\Models\setting;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class settingController extends Controller
{
    public function index()
    {
        $settings = Setting::first();
        return view('setting.index', compact('settings'));
    }

    public function update(Request $request)
    {
        $request->validate([
            'nama_perusahaan' => 'required|string|max:255',
            'deskripsi' => 'required|string',
            'foto' => 'nullable|image|mimes:jpeg,png,jpg,gif,svg|max:2048',
        ]);

        $settings = Setting::first();
        $settings->nama_perusahaan = $request->nama_perusahaan;
        $settings->deskripsi = $request->deskripsi;

        if ($request->hasFile('foto')) {
            // Hapus foto lama jika ada
            if ($settings->foto) {
                $oldImagePath = public_path('uploads/' . $settings->foto);
                if (file_exists($oldImagePath)) {
                    unlink($oldImagePath);
                }
            }

            // Simpan foto baru
            $fotoName = time() . '.' . $request->foto->extension();
            $request->foto->move(public_path('uploads'), $fotoName);
            $settings->foto = $fotoName;
            $settings->save();
        }

        $settings->save();
        $user = Auth::user();
        if ($user->type == 'admin'){
            return redirect()->route('admin/setting')->with('success', 'Data updated successfully');
        }
        elseif ($user->type == 'supervisor'){
            return redirect()->route('supervisor/setting')->with('success', 'Data updated successfully');
        }
        elseif ($user->type == 'petugas'){
            return redirect()->route('petugas/setting')->with('success', 'Data updated successfully');
        }
    }
}
