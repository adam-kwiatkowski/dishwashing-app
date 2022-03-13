<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Utensil extends Model
{
    use HasFactory;

    protected $fillable = [
        'name',
        'quantity',
        'used',
    ];

    protected $attributes = [
        'used' => 0,
    ];
}
