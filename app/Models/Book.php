<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Book extends Model
{
    public function author()
    {
    // Одна книга належить одному автору
    return $this->belongsTo(Author::class);
    }
    /** @use HasFactory<\Database\Factories\BookFactory> */
    use HasFactory;
}
