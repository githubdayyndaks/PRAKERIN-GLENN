<?php

namespace App\Http\Controllers;
use App\Models\User;
use Illuminate\Support\Facades\Auth;
use Illuminate\Http\Request;

class PenggunaController extends Controller
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
        ]);

        $user = User::findOrFail($request->user()->id);
        $user->update([
            'name' => $request->name,
            'email' => $request->email,
            'alamat' => $request->alamat,
            'gender' => $request->gender,
            'nohp' => $request->nohp,
        ]);

        return redirect()->route('profile.edit')->with('success', 'Profile updated successfully.');
    }

    public function edit()
{
    $user = auth()->user(); // Assuming the user is authenticated
    return view('profile.edit', compact('user'));
}
}
