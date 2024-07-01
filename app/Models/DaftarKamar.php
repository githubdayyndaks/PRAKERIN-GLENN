<?php

namespace App\Models;
use App\Models\Lantai;
use App\Models\tipekamar;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class DaftarKamar extends Model
{
    use HasFactory;
    protected $table = 'daftar_kamar';
    protected $primaryKey = 'kode_daftarkamar';
    public $incrementing = false;
    protected $fillable = [
        'kode_daftarkamar',
        'lantai_id',
        'kode_tipekamar',
        'harga',
        'luas',
        'status',
        'foto'


    ];

    public function lantai()
    {
        return $this->belongsTo(Lantai::class, 'lantai_id');
    }
    public function tipeKamar()
    {
        return $this->belongsTo(TipeKamar::class, 'kode_tipekamar');
    }
}
