<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Casts\Attribute;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Alert extends Model
{
    use HasFactory;

    protected $fillable = [
        'title',
        'category',
        'content',
        'image_url',
        'is_urgent',
    ];

    protected function casts(): array
    {
        return [
            'is_urgent' => 'boolean',
        ];
    }

    // Otomatis hitung URL lengkap setiap kali data dibaca
    protected function imageUrl(): Attribute
    {
        return Attribute::make(
            get: fn ($value) => $value ? asset('storage/' . $value) : null,
        );
    }
}