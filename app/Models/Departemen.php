<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Departemen extends Model
{
    use HasFactory;
    protected $primaryKey = 'id';
    protected $table = 'departemens';
    protected $fillable = ['name','jam_masuk','jam_masuk_mulai','jam_masuk_selesai','jam_pulang','jam_pulang_mulai','jam_pulang_selesai'];

    public function user()
    {
        return $this->hashOne(User::class);
    }
}
