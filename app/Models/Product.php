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
    ];

    protected $casts = [
        'name' => 'string',
        'description' => 'string',
        'price' => 'float',
        'stock' => 'integer',
    ];
}
