<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Hotel extends Model
{
    use HasFactory;

    // Property yang diisi menggunakan form

    protected $fillable = [
        'name',
        'address',
        'description',
        'photo_url',
        'email',
        'phone_number'
    ];

// Define relaticon
    public function reviews(){
        return $this->hasMany(Review::class);
    }

    public function facilities(){
        return $this->belongsToMany(Facility::class);
    }
}
