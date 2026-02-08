<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Product extends Model
{
    use HasFactory;

    protected $fillable = ['user_id', 'name', 'details','image', 'price'];

    // Link product to its owner
    public function user()
    {
        return $this->belongsTo(\App\Models\User::class);
    }
}
