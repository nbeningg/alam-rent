<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Testimoni extends Model
{
    use HasFactory;

    // Menentukan atribut yang tidak boleh diisi secara massal
    protected $guarded = [
        'id',
        'created_at',
        'updated_at'
    ];
}
