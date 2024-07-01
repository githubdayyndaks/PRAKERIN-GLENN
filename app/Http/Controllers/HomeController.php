<?php

namespace App\Http\Controllers;
use App\Models\setting;
use Illuminate\Http\Request;

class HomeController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }

    public function index()
    {

        return view('home');
    }

    public function adminHome()
    {
        $settings = Setting::first();
        return view('dashboard', compact('settings'));
    }

    public function supervisorHome()
    {
        $settings = Setting::first();
        return view('dashboard', compact('settings'));
    }

    public function petugasHome()
    {
        $settings = Setting::first();
        return view('dashboard', compact('settings'));
    }

    public function PenggunaHome()
    {
        $settings = Setting::first();
        return view('dashboard', compact('settings'));
    }
}
