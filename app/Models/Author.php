<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Author extends Model
{
    public function books()
    {
    // Один автор має багато книг
        return $this->hasMany(Book::class);
    }
    /** @use HasFactory<\Database\Factories\AuthorFactory> */
    use HasFactory;
}
