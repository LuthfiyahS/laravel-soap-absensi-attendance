<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Absensi extends Model
{
    use HasFactory;
    protected $table = 'absensi';
    protected $primaryKey = 'id';
    protected $fillable = ['user_id', 'kehadiran', 'status', 'tanggal','jam_masuk', 'jam_pulang'];

    public function user()
    {
        return $this->belongsTo(User::class,'user_id');
    }
}
