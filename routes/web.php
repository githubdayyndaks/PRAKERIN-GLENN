<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\ProductController;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\AdminController;
use App\Http\Controllers\DaftarKamarController;
use App\Http\Controllers\PetugasController;
use App\Http\Controllers\settingController;
use App\Http\Controllers\SupervisorController;
use App\Http\Controllers\UserController;
use App\Http\Controllers\TamuController;
use App\Http\Controllers\PenggunaController;
use App\Http\Controllers\TipeKamarController;
use App\Http\Controllers\LantaiController;
use App\Models\DaftarKamar;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "web" middleware group. Make something great!
|
*/

Route::get('/generate-kode-kamar/{lantaiId}', [DaftarKamarController::class, 'generateKodeKamar']);
Route::get('/', function () {
    return view('welcome');
});

Route::controller(AuthController::class)->group(function () {
    Route::get('register', 'register')->name('register');
    Route::post('register', 'registerSave')->name('register.save');

    Route::get('login', 'login')->name('login');
    Route::post('login', 'loginAction')->name('login.action');

    Route::get('logout', 'logout')->middleware('auth')->name('logout');
});

//Normal Users Routes List
Route::middleware(['auth', 'user-access:user'])->group(function () {
    Route::get('/home', [HomeController::class, 'index'])->name('home');
});

//Admin Routes List
Route::middleware(['auth', 'user-access:admin'])->group(function () {
    Route::get('/admin/home', [HomeController::class, 'adminHome'])->name('admin/home');

    Route::get('/admin/profile', [AdminController::class, 'profilepage'])->name('admin/profile');

    Route::get('/admin/user', [TamuController::class, 'index'])->name('admin/user');
    Route::get('/admin/user/create', [TamuController::class, 'create'])->name('admin/user/create');
    Route::post('/admin/user/store', [TamuController::class, 'store'])->name('admin/user/store');
    Route::get('/admin/user/show/{id}', [TamuController::class, 'show'])->name('admin/user/show');
    Route::get('/admin/user/invoice', [TamuController::class, 'invoice'])->name('admin/user/invoice');
    Route::get('/admin/user/edit/{id}', [TamuController::class, 'edit'])->name('admin/user/edit');
    Route::put('/admin/user/edit/{id}', [TamuController::class, 'update'])->name('admin/user/update');
    Route::delete('/admin/user/destroy/{id}', [TamuController::class, 'destroy'])->name('admin/user/destroy');
    Route::get('/profile/edit', [AdminController::class, 'edit'])->name('profile.edit');
    Route::put('/admin/update', [AdminController::class, 'update'])->name('admin.update');

    Route::get('/admin/tipekamar', [TipeKamarController::class, 'index'])->name('admin/tipekamar');
    Route::get('/admin/tipekamar/create', [TipeKamarController::class, 'create'])->name('admin/tipekamar/create');
    Route::post('/admin/tipekamar/store', [TipeKamarController::class, 'store'])->name('admin/tipekamar/store');
    Route::get('/admin/tipekamar/show/{id}', [TipeKamarController::class, 'show'])->name('admin/tipekamar/show');
    Route::get('/admin/tipekamar/invoice', [TipeKamarController::class, 'invoice'])->name('admin/tipekamar/invoice');
    Route::get('/admin/tipekamar/edit/{id}', [TipeKamarController::class, 'edit'])->name('admin/tipekamar/edit');
    Route::put('/admin/tipekamar/edit/{id}', [TipeKamarController::class, 'update'])->name('admin/tipekamar/update');
    Route::delete('/admin/tipekamar/destroy/{id}', [TipeKamarController::class, 'destroy'])->name('admin/tipekamar/destroy');

    Route::get('/admin/lantai', [lantaiController::class, 'index'])->name('admin/lantai');
    Route::get('/admin/lantai/create', [lantaiController::class, 'create'])->name('admin/lantai/create');
    Route::post('/admin/lantai/store', [lantaiController::class, 'store'])->name('admin/lantai/store');
    Route::get('/admin/lantai/show/{id}', [lantaiController::class, 'show'])->name('admin/lantai/show');
    Route::get('/admin/lantai/invoice', [lantaiController::class, 'invoice'])->name('admin/lantai/invoice');
    Route::get('/admin/lantai/edit/{id}', [lantaiController::class, 'edit'])->name('admin/lantai/edit');
    Route::put('/admin/lantai/edit/{id}', [lantaiController::class, 'update'])->name('admin/lantai/update');
    Route::delete('/admin/lantai/destroy/{id}', [lantaiController::class, 'destroy'])->name('admin/lantai/destroy');

    Route::get('/admin/products', [ProductController::class, 'index'])->name('admin/products');
    Route::get('/admin/products/create', [ProductController::class, 'create'])->name('admin/products/create');
    Route::post('/admin/products/store', [ProductController::class, 'store'])->name('admin/products/store');
    Route::get('/admin/products/show/{id}', [ProductController::class, 'show'])->name('admin/products/show');
    Route::get('/admin/products/edit/{id}', [ProductController::class, 'edit'])->name('admin/products/edit');
    Route::put('/admin/products/edit/{id}', [ProductController::class, 'update'])->name('admin/products/update');
    Route::delete('/admin/products/destroy/{id}', [ProductController::class, 'destroy'])->name('admin/products/destroy');

    Route::get('/admin/setting', [settingController::class, 'index'])->name('admin/setting');
    Route::get('/admin//setting/create', [settingController::class, 'create'])->name('admin/setting/create');
    Route::get('/admin//setting/store', [settingController::class, 'store'])->name('admin/setting/store');
    Route::put('/admin/setting/update', [SettingController::class, 'update'])->name('admin/setting/update');

    Route::get('/admin/kamar', [DaftarKamarController::class, 'index'])->name('admin/kamar');
    Route::get('/admin/kamar/create', [DaftarKamarController::class, 'create'])->name('admin/kamar/create');
    Route::post('/admin/kamar/store', [DaftarKamarController::class, 'store'])->name('admin/kamar/store');
    Route::get('/admin/kamar/invoice', [DaftarKamarController::class, 'invoice'])->name('admin/kamar/invoice');
    Route::get('/admin/kamar/show/{id}', [DaftarKamarController::class, 'show'])->name('admin/kamar/show');
    Route::get('/admin/kamar/edit/{kode_daftarkamar}', [DaftarKamarController::class, 'edit'])->name('admin/kamar/edit');
    Route::put('/admin/kamar/update/{kode_daftarkamar}', [DaftarKamarController::class, 'update'])->name('admin/kamar/update');
    Route::delete('/admin/kamar/destroy/{id}', [DaftarKamarController::class, 'destroy'])->name('admin/kamar/destroy');
});

//supervisor Routes List
Route::middleware(['auth', 'user-access:supervisor'])->group(function () {
    Route::get('/supervisor/home', [HomeController::class, 'supervisorHome'])->name('supervisor/home');

    Route::get('/supervisor/profile', [SupervisorController::class, 'profilepage'])->name('supervisor/profile');

    Route::get('/supervisor/user', [TamuController::class, 'index'])->name('supervisor/user');
    Route::get('/supervisor/user/create', [TamuController::class, 'create'])->name('supervisor/user/create');
    Route::post('/supervisor/user/store', [TamuController::class, 'store'])->name('supervisor/user/store');
    Route::get('/supervisor/user/show/{id}', [TamuController::class, 'show'])->name('supervisor/user/show');
    Route::get('/supervisor/user/edit/{id}', [TamuController::class, 'edit'])->name('supervisor/user/edit');
    Route::put('/supervisor/user/edit/{id}', [TamuController::class, 'update'])->name('supervisor/user/update');
    Route::delete('/supervisor/user/destroy/{id}', [TamuController::class, 'destroy'])->name('supervisor/user/destroy');
    Route::get('/profile/edit', [SupervisorController::class, 'edit'])->name('profile.edit');
    Route::put('/supervisor/update', [SupervisorController::class, 'update'])->name('supervisor.update');

    Route::get('/supervisor/tipekamar', [TipeKamarController::class, 'index'])->name('supervisor/tipekamar');
    Route::get('/supervisor/tipekamar/create', [TipeKamarController::class, 'create'])->name('supervisor/tipekamar/create');
    Route::post('/supervisor/tipekamar/store', [TipeKamarController::class, 'store'])->name('supervisor/tipekamar/store');
    Route::get('/supervisor/tipekamar/show/{id}', [TipeKamarController::class, 'show'])->name('supervisor/tipekamar/show');
    Route::get('/supervisor/tipekamar/edit/{id}', [TipeKamarController::class, 'edit'])->name('supervisor/tipekamar/edit');
    Route::put('/supervisor/tipekamar/edit/{id}', [TipeKamarController::class, 'update'])->name('supervisor/tipekamar/update');
    Route::delete('/supervisor/tipekamar/destroy/{id}', [TipeKamarController::class, 'destroy'])->name('supervisor/tipekamar/destroy');

    Route::get('/supervisor/products', [ProductController::class, 'index'])->name('supervisor/products');
    Route::get('/supervisor/products/create', [ProductController::class, 'create'])->name('supervisor/products/create');
    Route::post('/supervisor/products/store', [ProductController::class, 'store'])->name('supervisor/products/store');
    Route::get('/supervisor/products/show/{id}', [ProductController::class, 'show'])->name('supervisor/products/show');
    Route::get('/supervisor/products/edit/{id}', [ProductController::class, 'edit'])->name('supervisor/products/edit');
    Route::put('/supervisor/products/edit/{id}', [ProductController::class, 'update'])->name('supervisor/products/update');
    Route::delete('/supervisor/products/destroy/{id}', [ProductController::class, 'destroy'])->name('supervisor/products/destroy');

    Route::get('/supervisor/lantai', [lantaiController::class, 'index'])->name('supervisor/lantai');
    Route::get('/supervisor/lantai/create', [lantaiController::class, 'create'])->name('supervisor/lantai/create');
    Route::post('/supervisor/lantai/store', [lantaiController::class, 'store'])->name('supervisor/lantai/store');
    Route::get('/supervisor/lantai/show/{id}', [lantaiController::class, 'show'])->name('supervisor/lantai/show');
    Route::get('/supervisor/lantai/edit/{id}', [lantaiController::class, 'edit'])->name('supervisor/lantai/edit');
    Route::put('/supervisor/lantai/edit/{id}', [lantaiController::class, 'update'])->name('supervisor/lantai/update');
    Route::delete('/supervisor/lantai/destroy/{id}', [lantaiController::class, 'destroy'])->name('supervisor/lantai/destroy');

    Route::get('/supervisor/kamar', [DaftarKamarController::class, 'index'])->name('supervisor/kamar');
    Route::get('/supervisor/kamar/create', [DaftarKamarController::class, 'create'])->name('supervisor/kamar/create');
    Route::post('/supervisor/kamar/store', [DaftarKamarController::class, 'store'])->name('supervisor/kamar/store');
    Route::get('/supervisor/kamar/show/{id}', [DaftarKamarController::class, 'show'])->name('supervisor/kamar/show');
    Route::get('/supervisor/kamar/edit/{id}', [DaftarKamarController::class, 'edit'])->name('supervisor/kamar/edit');
    Route::put('/supervisor/kamar/edit/{id}', [DaftarKamarController::class, 'update'])->name('supervisor/kamar/update');
    Route::delete('/supervisor/kamar/destroy/{id}', [DaftarKamarController::class, 'destroy'])->name('supervisor/kamar/destroy');

    Route::get('/supervisor/setting', [settingController::class, 'index'])->name('supervisor/setting');
    Route::get('/supervisor//setting/create', [settingController::class, 'create'])->name('supervisor/setting/create');
    Route::get('/supervisor//setting/store', [settingController::class, 'store'])->name('supervisor/setting/store');
    Route::put('/supervisor/setting/update', [settingController::class, 'update'])->name('supervisor/setting/update');
});

//petugas Routes List
Route::middleware(['auth', 'user-access:petugas'])->group(function () {
    Route::get('/petugas/home', [HomeController::class, 'petugasHome'])->name('petugas/home');

    Route::get('/petugas/profile', [PetugasController::class, 'profilepage'])->name('petugas/profile');

    Route::get('/petugas/user', [TamuController::class, 'index'])->name('petugas/user');
    Route::get('/petugas/user/create', [TamuController::class, 'create'])->name('petugas/user/create');
    Route::post('/petugas/user/store', [TamuController::class, 'store'])->name('petugas/user/store');
    Route::get('/petugas/user/show/{id}', [TamuController::class, 'show'])->name('petugas/user/show');
    Route::get('/petugas/user/edit/{id}', [TamuController::class, 'edit'])->name('petugas/user/edit');
    Route::put('/petugas/user/edit/{id}', [TamuController::class, 'update'])->name('petugas/user/update');
    Route::delete('/petugas/user/destroy/{id}', [TamuController::class, 'destroy'])->name('petugas/user/destroy');
    Route::get('/profile/edit', [PetugasController::class, 'edit'])->name('profile.edit');
    Route::put('/petugas/update', [PetugasController::class, 'update'])->name('petugas.update');

    Route::get('/petugas/tipekamar', [TipeKamarController::class, 'index'])->name('petugas/tipekamar');
    Route::get('/petugas/tipekamar/create', [TipeKamarController::class, 'create'])->name('petugas/tipekamar/create');
    Route::post('/petugas/tipekamar/store', [TipeKamarController::class, 'store'])->name('petugas/tipekamar/store');
    Route::get('/petugas/tipekamar/show/{id}', [TipeKamarController::class, 'show'])->name('petugas/tipekamar/show');
    Route::get('/petugas/tipekamar/edit/{id}', [TipeKamarController::class, 'edit'])->name('petugas/tipekamar/edit');
    Route::put('/petugas/tipekamar/edit/{id}', [TipeKamarController::class, 'update'])->name('petugas/tipekamar/update');
    Route::delete('/petugas/tipekamar/destroy/{id}', [TipeKamarController::class, 'destroy'])->name('petugas/tipekamar/destroy');

    Route::get('/petugas/products', [ProductController::class, 'index'])->name('petugas/products');
    Route::get('/petugas/products/create', [ProductController::class, 'create'])->name('petugas/products/create');
    Route::post('/petugas/products/store', [ProductController::class, 'store'])->name('petugas/products/store');
    Route::get('/petugas/products/show/{id}', [ProductController::class, 'show'])->name('petugas/products/show');
    Route::get('/petugas/products/edit/{id}', [ProductController::class, 'edit'])->name('petugas/products/edit');
    Route::put('/petugas/products/edit/{id}', [ProductController::class, 'update'])->name('petugas/products/update');
    Route::delete('/petugas/products/destroy/{id}', [ProductController::class, 'destroy'])->name('petugas/products/destroy');

    Route::get('/petugas/lantai', [lantaiController::class, 'index'])->name('lantai/lantai');
    Route::get('/petugas/lantai/create', [lantaiController::class, 'create'])->name('petugas/lantai/create');
    Route::post('/petugas/lantai/store', [lantaiController::class, 'store'])->name('petuags/lantai/store');
    Route::get('/petugas/lantai/show/{id}', [lantaiController::class, 'show'])->name('petugas/lantai/show');
    Route::get('/petugas/lantai/edit/{id}', [lantaiController::class, 'edit'])->name('petugas/lantai/edit');
    Route::put('/petugas/lantai/edit/{id}', [lantaiController::class, 'update'])->name('petugas/lantai/update');
    Route::delete('/petugas/lantai/destroy/{id}', [lantaiController::class, 'destroy'])->name('petugas/lantai/destroy');

    // Route::get('/petugas/setting', [settingController::class, 'index'])->name('petugas/setting');
    // Route::get('/petugas//setting/create', [settingController::class, 'create'])->name('petugas/setting/create');
    // Route::get('/petugas//setting/store', [settingController::class, 'store'])->name('petugas/setting/store');
    // Route::get('/petugas/setting/update', [settingController::class, 'update'])->name('petugas/setting/update');
});

//pengguna Routes List
Route::middleware(['auth', 'user-access:pengguna'])->group(function () {
    Route::get('/pengguna/home', [HomeController::class, 'penggunaHome'])->name('pengguna/home');

    Route::get('/pengguna/profile', [penggunaController::class, 'profilepage'])->name('pengguna/profile');

    Route::get('/pengguna/user', [TamuController::class, 'index'])->name('pengguna/user');
    // Route::get('/pengguna/user/create', [TamuController::class, 'create'])->name('pengguna/user/create');
    // Route::post('/pengguna/user/store', [TamuController::class, 'store'])->name('pengguna/user/store');
    // Route::get('/pengguna/user/show/{id}', [TamuController::class, 'show'])->name('pengguna/user/show');
    // Route::get('/pengguna/user/edit/{id}', [TamuController::class, 'edit'])->name('pengguna/user/edit');
    // Route::put('/pengguna/user/edit/{id}', [TamuController::class, 'update'])->name('pengguna/user/update');
    // Route::delete('/pengguna/user/destroy/{id}', [TamuController::class, 'destroy'])->name('pengguna/user/destroy');
    // Route::get('/profile/edit', [penggunaController::class, 'edit'])->name('profile.edit');
    // Route::put('/pengguna/update', [penggunaController::class, 'update'])->name('pengguna.update');

    Route::get('/pengguna/tipekamar', [TipeKamarController::class, 'index'])->name('pengguna/tipekamar');
    // Route::get('/pengguna/tipekamar/create', [TipeKamarController::class, 'create'])->name('pengguna/tipekamar/create');
    // Route::post('/pengguna/tipekamar/store', [TipeKamarController::class, 'store'])->name('pengguna/tipekamar/store');
    // Route::get('/pengguna/tipekamar/show/{id}', [TipeKamarController::class, 'show'])->name('pengguna/tipekamar/show');
    // Route::get('/pengguna/tipekamar/edit/{id}', [TipeKamarController::class, 'edit'])->name('pengguna/tipekamar/edit');
    // Route::put('/pengguna/tipekamar/edit/{id}', [TipeKamarController::class, 'update'])->name('pengguna/tipekamar/update');
    // Route::delete('/pengguna/tipekamar/destroy/{id}', [TipeKamarController::class, 'destroy'])->name('pengguna/tipekamar/destroy');

    Route::get('/pengguna/products', [ProductController::class, 'index'])->name('pengguna/products');
    // Route::get('/pengguna/products/create', [ProductController::class, 'create'])->name('pengguna/products/create');
    // Route::post('/pengguna/products/store', [ProductController::class, 'store'])->name('pengguna/products/store');
    // Route::get('/pengguna/products/show/{id}', [ProductController::class, 'show'])->name('pengguna/products/show');
    // Route::get('/pengguna/products/edit/{id}', [ProductController::class, 'edit'])->name('pengguna/products/edit');
    // Route::put('/pengguna/products/edit/{id}', [ProductController::class, 'update'])->name('pengguna/products/update');
    // Route::delete('/pengguna/products/destroy/{id}', [ProductController::class, 'destroy'])->name('pengguna/products/destroy');

    // Route::get('/pengguna/setting', [settingController::class, 'index'])->name('pengguna/setting');
    // Route::get('/pengguna//setting/create', [settingController::class, 'create'])->name('pengguna/setting/create');
    // Route::get('/pengguna//setting/store', [settingController::class, 'store'])->name('pengguna/setting/store');
    // Route::get('/pengguna/setting/update', [settingController::class, 'update'])->name('pengguna/setting/update');
});


