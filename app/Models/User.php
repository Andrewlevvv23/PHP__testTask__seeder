<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class User extends Model
{
    protected $fillable = ['name', 'city'];
    protected $table = 'users';

    public function images()
    {
        return $this->hasMany(UserImage::class);
    }
}
