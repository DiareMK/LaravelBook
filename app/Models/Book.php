<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Book extends Model
{
    use HasFactory;
    // Не забудь додати publisher_id у fillable
    protected $fillable = ['title', 'description', 'author_id', 'publisher_id'];

    public function author()
    {
        return $this->belongsTo(Author::class);
    }

    public function publisher()
    {
        return $this->belongsTo(Publisher::class);
    }

    // Це зв'язок через допоміжну таблицю book_genre
    public function genres()
    {
        return $this->belongsToMany(Genre::class);
    }
}
