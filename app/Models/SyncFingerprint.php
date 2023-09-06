<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class SyncFingerprint extends Model
{
    use HasFactory;
    protected $table = 'sync_fingerprints';
    protected $primaryKey = 'id';
    protected $fillable = ['datetime', 'status'];
    
    public function log_finger()
    {
        return $this->hashOne(LogFingerprint::class);
    }
}
