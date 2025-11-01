<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Author;

class AuthorController extends Controller
{
    /**
     * Показує сторінку одного автора та його книги.
     */
    public function show(Author $author)
    {
        // Laravel вже знайшов нам автора.
        // Тепер ми завантажуємо всі його книги (використовуючи зв'язок 'books',
        // який ми визначили в моделі Author)
        $author->load('books');

        // Передаємо автора (разом з його книгами) у шаблон
        return view('authors.show', [
            'author' => $author,
        ]);
    }
}
