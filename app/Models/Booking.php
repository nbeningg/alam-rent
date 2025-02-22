<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Models\User;
use Illuminate\Support\Facades\Storage;

class Booking extends Model
{
    use HasFactory;

    // Menentukan atribut yang tidak boleh diisi secara massal
    protected $guarded = [
        'id',
        'created_at',
        'updated_at'
    ];

    // Relasi ke User
    public function user()
    {
        // Menyatakan bahwa model Booking berelasi dengan model User melalui user_id
        return $this->belongsTo(User::class);
    }

    // Relasi ke produk
    public function product()
    {
        // Menentukan kelas model produk berdasarkan kategori
        // Mengubah nama kategori menjadi huruf besar pada huruf pertama
        $productClassName = ucfirst($this->category);
        // Membuat nama kelas model produk dengan namespace App\Models
        $productClass = "App\\Models\\$productClassName";
        // Mengembalikan relasi belongsTo ke model produk yang sesuai berdasarkan product_id
        return $this->belongsTo($productClass, 'product_id');
    }
}
