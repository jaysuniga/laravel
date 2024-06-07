<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Seller extends Model
{
    use HasFactory;

    protected $fillable = ['name', 'cover_photo', 'user_id'];

    public function user()
    {
        return $this->belongsTo(User::class);
    }
}
