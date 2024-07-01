<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class tipekamar extends Model
{
    use HasFactory;
    protected $table = 'tipekamar';
    protected $primaryKey = 'kode_tipekamar';
    public $incrementing = false;

    protected $fillable = [
        'kode_tipekamar',
        'fasilitas',
        'nama_tipekamar',
        'foto'
    ];
}
