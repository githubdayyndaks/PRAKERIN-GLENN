<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Lantai extends Model
{
    use HasFactory;
    protected $table = 'lantai';
    protected $primaryKey = 'lantai_id';
    protected $fillable = [
        'lantai',
        'lantai_id'
    ];
}
