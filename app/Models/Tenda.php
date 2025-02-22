<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Tenda extends Model
{
    use HasFactory;

    // Menentukan nama tabel yang terkait dengan model ini
    protected $table = 'tendas';

    // Menentukan atribut yang tidak boleh diisi secara massal
    protected $guarded = [
        'id',
        'created_at',
        'updated_at'
    ];

    // Relasi ke tabel bookings
    public function bookings()
    {
        // Menyatakan bahwa model Tenda memiliki banyak Booking
        return $this->hasMany(Booking::class);
    }
}
