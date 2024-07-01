<?php

namespace App\Http\Controllers;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Validator;

class TamuController extends Controller
{
    public function index()
    {
        $users = User::orderBy('created_at', 'ASC')->get();

        return view('bukutamu.index', compact('users'));
    }

    public function create()
    {
        return view('bukutamu.create');
    }

    public function store(Request $request)
    {
        Validator::make($request->all(), [
            'name' => 'required',
            'email' => 'required|email',
            'password' => 'required|confirmed'
        ])->validate();

        User::create([
            'name' => $request->name,
            'email' => $request->email,
            'password' => Hash::make($request->password),
            'type' => "0"
        ]);

        $user = Auth::user();
        if ($user->type == 'admin'){
            return redirect()->route('admin/user')->with('success', 'data added successfully');
        }
        elseif ($user->type == 'supervisor'){
            return redirect()->route('supervisor/user')->with('success', 'data added successfully');
        }
        elseif ($user->type == 'petugas'){
            return redirect()->route('petugas/user')->with('success', 'data added successfully');
        }
    }

    public function show(string $id)
    {
        $users = User::findOrFail($id);

        return view('bukutamu.show', compact('users'));
    }

    public function invoice()
    {

        $users = User::orderBy('created_at', 'ASC')->get();

        return view('bukutamu.invoice', compact('users'));
    }

    public function edit(string $id)
    {
        $users = User::findOrFail($id);

        return view('bukutamu.edit', compact('users'));
    }

    public function update(Request $request, string $id)
    {
        $users = User::findOrFail($id);

        $users->update($request->all());

        $user = Auth::user();
        if ($user->type == 'admin'){
            return redirect()->route('admin/user')->with('success', 'data added successfully');
        }
        elseif ($user->type == 'supervisor'){
            return redirect()->route('supervisor/user')->with('success', 'data added successfully');
        }
        elseif ($user->type == 'petugas'){
            return redirect()->route('petugas/user')->with('success', 'data added successfully');
        }
    }

    public function destroy(string $id)
    {
        $users = User::findOrFail($id);

        $users->delete();

        $user = Auth::user();
        if ($user->type == 'admin'){
            return redirect()->route('admin/user')->with('success', 'data added successfully');
        }
        elseif ($user->type == 'supervisor'){
            return redirect()->route('supervisor/user')->with('success', 'data added successfully');
        }
        elseif ($user->type == 'petugas'){
            return redirect()->route('petugas/user')->with('success', 'data added successfully');
        }
    }
}
