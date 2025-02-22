<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Product extends Model
{
    use HasFactory;

    // Atribut yang tidak boleh diisi secara massal
    protected $guarded = [
        'id',
        'created_at',
        'updated_at'
    ];

    // Relasi ke tabel bookings
    public function bookings()
    {
        // Menyatakan bahwa model Product memiliki banyak Booking
        return $this->hasMany(Booking::class);
    }

    // Polymorphic relationship untuk menghubungkan produk ke berbagai jenis produk
    public function productable()
    {
        // Menentukan relasi morphTo yang mengaitkan Product ke berbagai model produk
        return $this->morphTo();
    }
}
