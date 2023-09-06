<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class RoleUser extends Model
{
    use HasFactory;
    protected $primaryKey = 'id';
    protected $table = 'role_users';
    protected $fillable = ['name'];

    public function user()
    {
        return $this->hashOne(User::class);
    }
}
