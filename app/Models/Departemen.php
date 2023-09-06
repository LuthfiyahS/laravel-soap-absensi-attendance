<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Departemen extends Model
{
    use HasFactory;
    protected $primaryKey = 'id';
    protected $table = 'departemens';
    protected $fillable = ['name','created_at','updated_at'];

    // public function mahasiswa()
    // {
    //     return $this->belongsTo(Mahasiswa::class, 'id_mahasiswa');
    // }
}
