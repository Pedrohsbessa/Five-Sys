<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Photo extends Model
{
    use HasFactory;

    protected $fillable = ['title', 'album_id'/* outros campos para a imagem */];

    public function album()
    {
        return $this->belongsTo(Album::class);
    }
}
