<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Song extends Model
{
    use HasFactory;

    protected $attributes = [
        'is_active' => true,
    ];

    protected $fillable = [
        'title', 
        'album_id', 
        'artist_id', 
        'genre',
        'date_released', 
        'rating',
        'is_active',
        'created_at',
        'updated_at'
    ];

    public function albums() {
        return $this->belongsTo(Album::class);
    }
}
