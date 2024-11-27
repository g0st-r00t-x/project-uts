<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Product extends Model
{
    use HasFactory;

    protected $fillable = [
        'name', 
        'description', 
        'price', 
        'stock', 
        'category'
    ];

    // Optional: Add mutators or accessors if needed
    public function getPriceFormattedAttribute()
    {
        return 'Rp ' . number_format($this->price, 2, ',', '.');
    }
}