<?php

namespace App\Http\Controllers;

use App\Models\Book;
use Illuminate\Http\Request;




class BookController extends Controller
{
    /**
     * Показує список всіх книг (наш dashboard).
     */
    public function index()
    {
        // Отримуємо всі книги, але також одразу завантажуємо
        // пов'язану модель 'author', щоб уникнути N+1 проблеми.
        // .latest() - сортує від нових до старих
        // .paginate(15) - розбиває на сторінки по 15 книг
        $books = Book::with('author')->latest()->paginate(15);
        $books = \App\Models\Book::with('author')->latest()->paginate(15);

        // Передаємо книги у шаблон 'dashboard',
        // який ми створимо на наступному кроці
        return view('dashboard', [
            'books' => $books,
        ]);
    }

    /**
     * Показує одну конкретну книгу.
     */
    // Laravel автоматично знайде книгу за ID з URL
    public function show(Book $book) 
    {
        // Передаємо знайдену книгу у шаблон 'books.show'
        // (ми його скоро створимо)
        return view('books.show', [
            'book' => $book,
        ]);
    }
}
