<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Product extends Model
{
    use HasFactory;

    protected $fillable = [
        'name', 'photo', 'description', 'qty', 'price', 'seller_id', 'category'
    ];

    public function seller()
    {
        return $this->belongsTo(Seller::class);
    }
}
