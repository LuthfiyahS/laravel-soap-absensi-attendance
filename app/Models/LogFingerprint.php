<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class LogFingerprint extends Model
{
    use HasFactory;
    protected $table = 'log_fingerprints';
    protected $primaryKey = 'id';
    protected $fillable = ['user_id', 'datetime', 'mesin_id', 'status'];

    public function user()
    {
        return $this->belongsTo(User::class,'user_id');
    }

    public function mesin()
    {
        return $this->belongsTo(MesinFingerprint::class,'mesin_id');
    }
}
