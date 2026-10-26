<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Products extends Model
{
    use HasFactory;

    // This "fillable" array is a security feature. 
    // It tells Laravel it's okay to save these specific fields to the database.
    protected $fillable = [
    'name',
    'category',
    'price',
    'stock',
    'image',
    ];
}