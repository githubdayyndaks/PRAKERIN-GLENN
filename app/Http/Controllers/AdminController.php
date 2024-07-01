<?php

namespace App\Http\Controllers;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Storage;
use Illuminate\Http\Request;
use App\Models\User;

class AdminController extends Controller
{
    public function profilepage()
    {
        $user = Auth::user();
        return view('profile', compact('user'));
    }

    public function update(Request $request)
    {
        $request->validate([
            'name' => 'required|string|max:255',
            'email' => 'required|string|email|max:255',
            'alamat' => 'nullable|string|max:255',
            'gender' => 'nullable|string|max:10',
            'nohp' => 'nullable|string|max:15',
            'foto' => 'nullable|image|mimes:jpeg,png,jpg,gif|max:2048'
        ]);

        $user = User::findOrFail($request->user()->id);
        $user->update([
            'name' => $request->name,
            'email' => $request->email,
            'alamat' => $request->alamat,
            'gender' => $request->gender,
            'nohp' => $request->nohp,
        ]);

        if ($request->hasFile('foto')) {
            // Hapus foto lama jika ada
            if ($user->foto) {
                Storage::delete('public/uploads/' . $user->foto);
            }

            // Simpan foto baru
            $fotoName = time() . '.' . $request->foto->extension();
            $request->foto->move(public_path('uploads'), $fotoName);
            $user->foto = $fotoName;
            $user->save();
        }

        $user = Auth::user();
        if ($user->type == 'admin'){
            return redirect()->route('admin/profile')->with('success', 'Data updated successfully');
        }
        elseif ($user->type == 'supervisor'){
            return redirect()->route('supervisor/profile')->with('success', 'Data updated successfully');
        }
        elseif ($user->type == 'petugas'){
            return redirect()->route('petugas/profile')->with('success', 'Data updated successfully');
        }
    }

    public function showProfile()
    {
        $user = Auth::user();
        return view('profile', compact('user'));
    }

    public function edit()
{
    $user = auth()->user(); // Assuming the user is authenticated
    $user = Auth::user();
    if ($user->type == 'admin'){
        return redirect()->route('admin/profile')->with('success', 'Data updated successfully');
    }
    elseif ($user->type == 'supervisor'){
        return redirect()->route('supervisor/profile')->with('success', 'Data updated successfully');
    }
    elseif ($user->type == 'petugas'){
        return redirect()->route('petugas/profile')->with('success', 'Data updated successfully');
    }
}
}
